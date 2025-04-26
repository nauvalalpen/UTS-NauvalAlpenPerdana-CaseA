<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Donasi extends Model
{
    //
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nama_donatur',
        'email',
        'nominal',
        'metode_pembayaran',
        'tanggal_donasi',
        'status',
    ];

    protected $casts = [
        'tanggal_donasi' => 'date',
        'nominal' => 'decimal:2',
    ];

    protected $dates = ['deleted_at'];
}
