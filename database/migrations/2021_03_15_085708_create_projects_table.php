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
            $table->unsignedBigInteger('clientid')->nullable();
            $table->foreign('clientid')->references('id')->on('clients')->onDelete('set null');
            $table->longText('projectInchargeId');
            $table->longText('developers')->nullable();
            $table->unsignedBigInteger('wingid')->nullable();
            $table->foreign('wingid')->references('id')->on('wings')->onDelete('set null');
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
