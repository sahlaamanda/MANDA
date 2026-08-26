<?php

namespace App\Http\Controllers;

use App\Http\Requests\Jenis\StoreRequest;
use App\Http\Requests\Jenis\UpdateRequest;
use App\Http\Requests\SearchRequest;
use App\Models\Jenis;

class JenisController extends Controller
{
    public function index(SearchRequest $request)
    {
        $keyword = $request->input('search');

        $jenis = Jenis::query()
            ->withCount('produk')
            ->when($keyword, function ($q) use ($keyword) {
                $q->where('nama', 'like', "%{$keyword}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('jenis.index', compact('jenis'));
    }

    public function create()
    {
        return view('jenis.create');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        Jenis::create([
            'nama' => $data['nama_jenis'],
            'deskripsi' => $data['deskripsi'] ?? null,
        ]);

        return redirect()
            ->route('admin.jenis.index')
            ->with('success', 'Jenis produk berhasil ditambahkan');
    }

    public function edit(Jenis $jenis)
    {
        return view('jenis.edit', compact('jenis'));
    }

    public function update(UpdateRequest $request, Jenis $jenis)
    {
        $data = $request->validated();

        $jenis->update([
            'nama' => $data['nama_jenis'],
        ]);

        return redirect()
            ->route('admin.jenis.index')
            ->with('success', 'Jenis produk berhasil diupdate');
    }

    public function destroy(Jenis $jenis)
    {
        if ($jenis->produk()->exists()) {
            return redirect()
                ->route('admin.jenis.index')
                ->with('error', 'Jenis tidak bisa dihapus karena masih dipakai produk');
        }

        $jenis->delete();

        return redirect()
            ->route('admin.jenis.index')
            ->with('success', 'Jenis produk berhasil dihapus');
    }
}