<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin =User::create(['name'=>'admin','user_id'=>'admin','last_name'=>'Suadmin',
        'email'=>'admin@gmail.com','divisi'=>'00001','nama_divisi'=>'Corpu',
        'departemen'=>'10001','nama_departemen'=>'Akademi Digital',
        'password'=>bcrypt('12345678')]);
        $admin->assignRole('admin');
        $admin->assignRole('user');
        // $user =User::create(['name'=>'user role','user_id'=>'user','last_name'=>'Suuser','email'=>'user@gmail.com','password'=>bcrypt('12345678')]);
        // $user->assignRole('user');
    }
}
