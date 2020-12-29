<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestScrip extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode','nama','create_by','update_by'
    ];
}
