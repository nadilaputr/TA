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
        'tindakan_dari',
        'diteruskan_kepada',
        'status',
    ];

    public function surat_masuk()
    {
        return $this->hasOne(SuratMasuk::class);
    }

    protected $guarded = [];
}
