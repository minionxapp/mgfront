<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string("kd_project")->nullable();
            $table->string("nm_project")->nullable();
            $table->string("descripsi")->nullable();
            $table->string("divisi")->nullable();
            $table->string("departement")->nullable();
            $table->string("jenis")->nullable();
            $table->string('nm_divisi')->nullable();
            $table->string('nm_departement')->nullable();
            // $table->string()->nullable();
            // $table->string()->nullable();
            $table->timestamps();            
            $table->string('create_by')->nullable();
            $table->string('update_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
