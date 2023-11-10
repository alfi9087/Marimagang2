<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;

class Bidang extends Model implements Authenticatable
{
    use HasFactory,AuthenticableTrait;

    protected $table = 'bidangs';
    protected $guarded = ['id'];
    protected $fillable = [
        'nama',
        'email',
        'password',
    ];
}
