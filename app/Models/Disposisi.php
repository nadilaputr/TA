<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disposisi extends Model
{
    use HasFactory;

    protected $table = "disposisi";
    protected $fillable = [
        'catatan',
        'sifat',
        'id_bidang',
        'id_surat',
        'id_user',
    ];

    public function surat_masuk()
    {
        return $this->belongsTo(SuratMasuk::class, 'id_surat');
    }

    public function bidang()
    {
        return $this->belongsTo(Bidang::class, 'id_bidang');
    }
}
