<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'jenis',
        'sifat',
        'tindakan',
        'file',
    ];

    public function disposisi()
    {
        return $this->hasOne(Disposisi::class, 'id_surat');
    }

}