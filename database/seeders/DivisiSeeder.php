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
        Divisi::create(['kode'=>'00000','nama'=>'Kantor Pusat','nik_kadiv'=>'00000','nama_kadiv'=>'Kantor Pusat']);
        Divisi::create(['kode'=>'00001','nama'=>'Kantor Wilayah I','nik_kadiv'=>'','nama_kadiv'=>'Kantor Wilayah I']);
        Divisi::create(['kode'=>'00002','nama'=>'Kantor Wilayah II','nik_kadiv'=>'','nama_kadiv'=>'Kantor Wilayah II']);
        Divisi::create(['kode'=>'00003','nama'=>'Kantor Wilayah III','nik_kadiv'=>'','nama_kadiv'=>'Kantor Wilayah III']);
        Divisi::create(['kode'=>'00004','nama'=>'Kantor Wilayah IV','nik_kadiv'=>'','nama_kadiv'=>'Kantor Wilayah IV']);
        Divisi::create(['kode'=>'00005','nama'=>'Kantor Wilayah V','nik_kadiv'=>'','nama_kadiv'=>'Kantor Wilayah V']);
        Divisi::create(['kode'=>'00006','nama'=>'Kantor Wilayah VI','nik_kadiv'=>'','nama_kadiv'=>'Kantor Wilayah VI']);
        Divisi::create(['kode'=>'00007','nama'=>'Kantor Wilayah VII','nik_kadiv'=>'','nama_kadiv'=>'Kantor Wilayah VII']);
        Divisi::create(['kode'=>'00008','nama'=>'Kantor Wilayah VIII','nik_kadiv'=>'','nama_kadiv'=>'Kantor Wilayah VIII']);
        Divisi::create(['kode'=>'00009','nama'=>'Kantor Wilayah IX','nik_kadiv'=>'','nama_kadiv'=>'Kantor Wilayah IX']);
        Divisi::create(['kode'=>'00010','nama'=>'Kantor Wilayah X','nik_kadiv'=>'','nama_kadiv'=>'Kantor Wilayah X']);
        Divisi::create(['kode'=>'00011','nama'=>'Kantor Wilayah XI','nik_kadiv'=>'','nama_kadiv'=>'Kantor Wilayah XI']);
        Divisi::create(['kode'=>'00012','nama'=>'Kantor Wilayah XII','nik_kadiv'=>'','nama_kadiv'=>'Kantor Wilayah XII']);
  
        // Divisi::create(['kode'=>'00001','nama'=>'Corpu','nik_kadiv'=>'P00001','nama_kadiv'=>'Rofiq']);
    }
}
