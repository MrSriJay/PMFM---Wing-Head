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
<<<<<<< HEAD
            $table->boolean('seen_status')->default(0);
=======
>>>>>>> 311dc482ed3416e2a621ea3bd4c0d3610de5f727
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
