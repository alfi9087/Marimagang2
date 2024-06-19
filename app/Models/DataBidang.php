<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataBidang extends Model
{
    use HasFactory;

    protected $table = 'databidang';
    protected $fillable = [
        'nama',
        'thumbnail',
        'photo',
        'deskripsi',
        'kuota',
        'status'
    ];

    public function skill()
    {
        return $this->hasMany(Skill::class, 'databidang_id');
    }

    public function pengajuan()
    {
        return $this->hasOne(Pengajuan::class, 'databidang_id');
    }

    public function bidang()
    {
        return $this->belongsTo(Bidang::class, 'bidang_id');
    }
}
