<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usulan extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_srt','deskripsi','unit_usul','status','file_usul','file_usul_link','file_dispo',
        'file_dispo_link','comment','deadline','jenis_usul','pic_usul','no_pic_usul',
        'asign_to','pic_asign_to','asign_desc','create_by','update_by','mulai','selesai'       
    ];

}
