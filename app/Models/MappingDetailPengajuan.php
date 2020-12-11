<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MappingDetailPengajuan extends Model
{
    use HasFactory;
    protected $table = 'mapping_pengajuan_detail';
    protected $primaryKey = 'id_mapping_pengajuan_detail';

    public $timestamps = false;
}
