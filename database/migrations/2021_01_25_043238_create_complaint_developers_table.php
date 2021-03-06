<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplaintDevelopersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaint_developers', function (Blueprint $table) {
            $table->bigInteger('complaint_id');
            $table->string('developer_id');
            $table->primary(['complaint_id', 'developer_id']);
            $table->string('assigned_by');
            $table->boolean('seen_status')->default(0);
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
        Schema::dropIfExists('complaint_developers');
    }
}
