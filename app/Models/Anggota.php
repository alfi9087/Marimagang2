<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $table = 'anggota';
    protected $guarded = ['id'];
    protected $fillable = [
        'nama',
        'nim',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
