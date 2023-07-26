<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratMasuk extends Model
{
    use HasFactory;

    protected $table = "surat_masuk";

    protected $fillable = [
        'nomor_surat',
        'tanggal_surat',
        'alamat_surat',
        'tanggal_masuk',
        'perihal',
        'status',
        'file'
    ];
}
