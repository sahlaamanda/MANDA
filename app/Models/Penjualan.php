<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\ItemPenjualan;

class Penjualan extends Model
{
    use HasFactory;

    public const DISKON_PERSEN = 15;

    protected $table = 'penjualan';

    protected $fillable = [
        'user_id',
        'total_pembayaran',
        'metode_pembayaran',
        'jumlah_bayar',
        'kembalian',
        'status',
    ];

    public static function totalDenganDiskon(int $subtotal): int
    {
        return (int) round($subtotal * (100 - self::DISKON_PERSEN) / 100);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function itemPenjualan()
    {
        return $this->hasMany(ItemPenjualan::class);
    }
}