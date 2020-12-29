<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectActivity extends Model
{
    use HasFactory;
    protected $fillable = ["kd_activity","nm_activity","desc_activity","status","kd_project","nm_project",
    "descripsi","divisi","departement","jenis",'file1','file1_desc','file2','file2_desc','file3','file3_desc',
    'create_by','update_by'
           
          
    ];

   
}
