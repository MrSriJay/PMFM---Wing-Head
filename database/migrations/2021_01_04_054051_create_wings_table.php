<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wings', function (Blueprint $table) {
            $table->id();
            $table->string('wing_name');
            $table->timestamps();
        });

        DB::table('wings')->insert([
            'wing_name' => 'HQ',
        ]);

        DB::table('wings')->insert([
            'wing_name' => 'Radio & Electronic Wing',
        ]);

        DB::table('wings')->insert([
            'wing_name' => 'Electrical & Mechanical Wing',
        ]);

        DB::table('wings')->insert([
            'wing_name' => 'IT/ GIS Wing',
        ]);

        DB::table('wings')->insert([
            'wing_name' => 'Cyber Wing',
        ]);

        DB::table('wings')->insert([
            'wing_name' => 'Aeronautical Wing',
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wings');
    }
}
