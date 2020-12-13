<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoWajah extends Model
{
    use HasFactory;
    protected $fillable = ['id_akun','name','sample_wajah'];
    protected $table = 'sample_wajah';
    protected $primaryKey = 'id_wajah';

    public $timestamps = false;
}
