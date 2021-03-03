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
            'wing_name' => 'none',
        ]);

        DB::table('wings')->insert([
            'wing_name' => 'Radio & Electronic',
        ]);

        DB::table('wings')->insert([
            'wing_name' => 'Electrical & Mechanical',
        ]);

        DB::table('wings')->insert([
            'wing_name' => 'IT/ GIS',
        ]);

        DB::table('wings')->insert([
            'wing_name' => 'Cyber',
        ]);

        DB::table('wings')->insert([
            'wing_name' => 'Aeronautical',
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
