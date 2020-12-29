<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('image_link')->nullable();
            
            $table->string('user_id')->unique();
            $table->string('last_name')->nullable();
            $table->string('phone1')->nullable();
            $table->string('departemen')->nullable();
            $table->string('nama_departemen')->nullable();
            $table->string('unit_kerja')->nullable();
            $table->string('nama_divisi')->nullable();
            $table->string('grade')->nullable();
            $table->string('picture')->nullable();
            $table->string('divisi')->nullable();
            $table->string('bank')->nullable();
            $table->string('norek')->nullable();
            $table->string('foto')->nullable();
            $table->string('create_by')->nullable();
            $table->string('update_by')->nullable();
            // $table->string('')->nullable();
            // $table->string('')->nullable();
            // $table->string('')->nullable();
            // $table->string('')->nullable();
            // $table->string('')->nullable();
            // $table->string('')->nullable();
            // $table->string('')->nullable();
            // $table->string('')->nullable();
            // $table->string('')->nullable();
            // $table->string('')->nullable();
            // $table->string('')->nullable();
            // $table->string('')->nullable();
            // $table->string('')->nullable();
            // $table->string('')->nullable();
            
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
