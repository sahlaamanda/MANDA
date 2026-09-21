<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    /**
     * LIST PENJUALAN
     */
    public function index(SearchRequest $request)
    {
        $user = Auth::user();
        $keyword = $request->input('search');

        $sales = Penjualan::query()
            ->when($user->role->name === 'kasir', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->when($keyword, function ($query) use ($keyword) {
                $query->whereHas('user', function ($q) use ($keyword) {
                    $q->where('name', 'like', '%' . $keyword . '%');
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('penjualan.index', compact('sales'));
    }


    /**
     * POS PAGE (CREATE)
     */
    public function create()
    {
        $sale = Penjualan::firstOrCreate(
            [
                'user_id' => Auth::id(),
                'status'  => 'OPEN'
            ],
            [
                'total_pembayaran'  => 0,
                'metode_pembayaran' => 'CASH'
            ]
        );

        $products = Produk::orderBy('nama')->get();
        $mode = 'create';

        return view('penjualan.pos', compact('sale', 'products', 'mode'));
    }


    /**
     * POS PAGE (EDIT)
     */
    public function edit(Penjualan $penjualan)
    {
        $sale = $penjualan;

        abort_if($sale->status === 'COMPLETED', 403);

        $sale->load('itemPenjualan');
        $products = Produk::orderBy('nama')->get();
        $mode = 'edit';

        return view('penjualan.pos', compact('sale', 'products', 'mode'));
    }


    /**
     * DETAIL PENJUALAN
     */
    public function show(Penjualan $penjualan)
    {
        $sale = $penjualan->load(
            'user',
            'itemPenjualan.produk'
        );

        return view('penjualan.show', compact('sale'));
    }


    /**
     * CETAK STRUK PENJUALAN
     */
    public function struk(Penjualan $penjualan)
    {
        $sale = $penjualan->load(
            'user',
            'itemPenjualan.produk'
        );

        return view('penjualan.struk', compact('sale'));
    }


    /**
     * ADD TO CART
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:produk,id',
            'quantity'   => 'required|integer|min:1'
        ]);

        $sale = Penjualan::where('user_id', Auth::id())
            ->where('status', 'OPEN')
            ->firstOrFail();

        $product = Produk::findOrFail($request->product_id);


        DB::transaction(function () use ($sale, $product, $request) {

            $item = $sale->itemPenjualan()
                ->where('produk_id', $product->id)
                ->first();


            if ($item) {

                $item->increment(
                    'kuantitas',
                    $request->quantity
                );

            } else {

                $item = $sale->itemPenjualan()->create([
                    'produk_id'    => $product->id,
                    'kuantitas'    => $request->quantity,
                    'harga_satuan' => $product->harga_jual,
                    'subtotal'     => $request->quantity * $product->harga_jual
                ]);

            }


            $item->subtotal =
                $item->kuantitas * $item->harga_satuan;

            $item->save();


            $sale->load('itemPenjualan');

            $sale->update([
                'total_pembayaran' =>
                    $sale->itemPenjualan->sum('subtotal')
            ]);

        });


        return back()->with(
            'success',
            'Produk berhasil ditambahkan'
        );
    }


    /**
     * UPDATE QTY / CHECKOUT
     */
    public function update(Request $request, $id)
    {
        $sale = Penjualan::findOrFail($id);


        /*
        |--------------------------------------------------------------------------
        | CHECKOUT
        |--------------------------------------------------------------------------
        */
        if ($request->has('payment_method')) {

            $request->validate([
                'payment_method' => 'required|string|in:CASH,QRIS',
                'jumlah_bayar'   => 'required_if:payment_method,CASH|nullable|integer|min:0',
            ]);

            $sale->load('itemPenjualan');

            $subtotal = $sale->itemPenjualan->sum('subtotal');
            $total = Penjualan::totalDenganDiskon($subtotal);

            $jumlahBayar = null;
            $kembalian = null;

            if ($request->payment_method === 'CASH') {

                $jumlahBayar = (int) $request->jumlah_bayar;

                // Validasi ulang di server, jangan percaya JS
                if ($jumlahBayar < $total) {
                    return back()
                        ->withErrors(['jumlah_bayar' => 'Jumlah bayar tidak boleh kurang dari total pembayaran.'])
                        ->withInput();
                }

                $kembalian = $jumlahBayar - $total;
            }

            $sale->update([
                'metode_pembayaran' => $request->payment_method,
                'total_pembayaran'  => $total,
                'jumlah_bayar'      => $jumlahBayar,
                'kembalian'         => $kembalian,
                'status'            => 'COMPLETED'
            ]);

            // FIX: jangan pakai back() di sini.
            // Setelah status berubah jadi COMPLETED, halaman edit
            // (yang jadi referer/URL sebelumnya) akan otomatis 403
            // karena method edit() memblokir status COMPLETED.
            // Redirect ke halaman detail/show transaksi ini saja.
            return redirect()
                ->route('admin.penjualan.show', $sale->id)
                ->with(
                    'success',
                    'Produk berhasil dichekout'
                );
        }



        /*
        |--------------------------------------------------------------------------
        | UPDATE QUANTITY
        |--------------------------------------------------------------------------
        */
        if ($request->has('quantity')) {

            $request->validate([
                'quantity' => 'required|integer|min:1'
            ]);

            foreach ($sale->itemPenjualan as $item) {
                $item->update([
                    'kuantitas' => $request->quantity,
                    'subtotal' => $request->quantity * $item->harga_satuan
                ]);
            }

            $sale->update([
                'total_pembayaran' => Penjualan::totalDenganDiskon(
                    $sale->itemPenjualan->sum('subtotal')
                )
            ]);
        }


        return back()->with(
            'success',
            'Data berhasil diperbarui'
        );
    }



    /**
     * DELETE TRANSACTION
     */
    public function destroy(Penjualan $penjualan)
    {
        $this->authorize('delete', $penjualan);


        if ($penjualan->status !== 'OPEN') {

            return redirect()
                ->route('admin.penjualan.index')
                ->with(
                    'errors',
                    'Transaksi sudah selesai tidak bisa dibatalkan'
                );
        }



        DB::transaction(function () use ($penjualan) {


            foreach ($penjualan->itemPenjualan as $item) {

                $item->produk->increment(
                    'stok',
                    $item->kuantitas
                );

            }


            $penjualan->itemPenjualan()->delete();

            $penjualan->delete();

        });



        return redirect()
            ->route('admin.penjualan.index')
            ->with(
                'success',
                'Transaksi berhasil dibatalkan'
            );
    }
}