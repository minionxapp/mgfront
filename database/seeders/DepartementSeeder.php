<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Departement;

class DepartementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *'kode','nama','nik_kadept','nama_kadept','divisi_kode'10001
     * @return void
     */
    public function run()
    {
        Departement::create(['kode'=>'10001','nama'=>'Akademi Digital','nik_kadept'=>'P81035','nama_kadept'=>'Mugi','divisi_kode'=>'00001']);
    }
}
