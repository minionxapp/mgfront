<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsulansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usulans', function (Blueprint $table) {
            $table->id();
            $table->string('no_srt')->nullable();
            $table->string('deskripsi')->nullable();
            $table->string('unit_usul')->nullable();
            $table->string('status')->nullable();
            $table->string('file_usul')->nullable();
            $table->string('file_usul_link')->nullable();
            $table->string('file_dispo')->nullable();
            $table->string('file_dispo_link')->nullable();
            $table->string('comment')->nullable();
            $table->date('deadline')->nullable();
            $table->string('jenis_usul')->nullable();//taining,permintaan data, dll
            $table->string('pic_usul')->nullable();
            $table->string('no_pic_usul')->nullable();//no kontak pic yang mengusulkan
            $table->string('asign_to')->nullable();//tugaskan ke dept mana
            $table->string('pic_asign_to')->nullable();
            $table->string('asign_desc')->nullable();
            // $table->string('')->nullable();
            $table->timestamps();
            $table->string('create_by')->nullable();
            $table->string('update_by')->nullable();
            $table->date('mulai')->nullable();
            $table->date('selesai')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usulans');
    }
}
