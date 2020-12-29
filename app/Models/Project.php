<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'kd_project','nm_project','descripsi','divisi','departement','jenis','nm_divisi','nm_departement'
    ];
    
}
