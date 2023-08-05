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
        'asal_surat',
        'tanggal_masuk',
        'perihal',
        'catatan',
        'lampiran',
        'status',
        'sifat',
        'tindakan',
        'file',
    ];

    protected $guarded = [];
}
