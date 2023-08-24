<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeluar extends Model
{
    use HasFactory;

    protected $table = "surat_keluar";

    protected $fillable = [
        'nomor_surat',
        'tanggal_surat',
        'sifat',
        'lampiran',
        'alamat_surat',
        'perihal',
        'tanggal_surat',
        'status',
        'catatan',
        'id_bidang',
        'file'
    ];

    public function bidang()
    {
        return $this->belongsTo(Bidang::class, 'id_bidang');
    }
}
