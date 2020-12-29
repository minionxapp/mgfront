<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_activities', function (Blueprint $table) {
            $table->id();
            $table->string("kd_activity")->nullable();
            $table->string("nm_activity")->nullable();
            $table->string("desc_activity")->nullable();
            $table->string("status")->nullable();
            $table->string("kd_project")->nullable();
            $table->string("nm_project")->nullable();
            $table->string("descripsi")->nullable();
            $table->string("divisi")->nullable();
            $table->string("departement")->nullable();
            $table->string('file1')->nullable();
            $table->string('file1_desc')->nullable();
            $table->string('file2')->nullable();
            $table->string('file2_desc')->nullable();
            $table->string('file3')->nullable();
            $table->string('file3_desc')->nullable();
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
        Schema::dropIfExists('project_activities');
    }
}
