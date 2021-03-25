<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

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

            $table->string('user_id')->primary();
            $table->string('rank');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('telephone');
            $table->string('email')->unique();
            $table->string('usertype')->nullable();
            $table->unsignedBigInteger('wing_name')->nullable();
            $table->foreign('wing_name')->references('id')->on('wings')->onDelete('set null');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
           

        });

        DB::table('users')->insert([
            'user_id' => 'admin',
            'rank' => 'admin',
            'first_name' => 'admin',
            'last_name' => 'admin',
            'telephone' => 'admin',
            'email' => 'admin@gmail.com',
            'usertype' => 'admin',
            'wing_name' => '1',
            'password' => '$2y$12$UzPe.jHV.kpT4/KyRcPJ0e4RsESaT/WqwgTqTXuTOilrv7YA6bAZm'
        ]);
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
