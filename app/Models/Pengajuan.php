<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $table = 'pengajuan';
    protected $fillable = [
        'user_id',
        'databidang_id',
        'deskripsi',
        'bukti',
        'pengantar',
        'proposal',
        'laporan',
        'suratmagang',
        'kesbangpol',
        'tanggalmulai',
        'tanggalselesai',
        'status',
        'komentar',
        'dokumentasi',
        'kesediaan'
    ];

    public function skilluser()
    {
        return $this->hasMany(SkillUser::class, 'pengajuan_id');
    }

    public function databidang()
    {
        return $this->belongsTo(DataBidang::class, 'databidang_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
