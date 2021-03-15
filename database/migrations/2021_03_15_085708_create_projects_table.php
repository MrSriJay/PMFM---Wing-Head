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
            $table->string('pgt_number');
            $table->string('title');
            $table->longText('description');
            $table->string('files')->nullable();
            $table->string('project_icon')->nullable();
            $table->longText('clientid');
            $table->longText('projectInchargeId');
            $table->longText('developers')->nullable();
            $table->longText('wingid');
            $table->date('startdate');
            $table->date('enddate');
            $table->string('addedBy');
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('projects');
    }
}
