<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    use HasFactory;
    protected $table = 'bidang';
    protected $fillable = [
        'bidang'
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function disposisi()
    {
        return $this->hasMany(Disposisi::class);
    }
}


