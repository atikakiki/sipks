<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPengajuan extends Model
{
    use HasFactory;
    protected $table = 'detail_pengajuan';
    protected $primaryKey = 'id_detail';

    public $timestamps = false;
}
