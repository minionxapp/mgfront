<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Divisi;

class DivisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Divisi::create(['kode'=>'00000','nama'=>'Kantor Pusat','nik_kadiv'=>'00000','nama_kadiv'=>'Kadiv']);
        Divisi::create(['kode'=>'00001','nama'=>'Corpu','nik_kadiv'=>'P00001','nama_kadiv'=>'Rofiq']);
    }
}
