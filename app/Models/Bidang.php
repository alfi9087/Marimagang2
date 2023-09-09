<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    use HasFactory;

    protected $table = 'bidang';
    protected $guarded = ['id'];
    protected $fillable = [
        'nama',
        'thumbnail',
        'photo',
        'deskripsi',
        'status'
    ];
}
