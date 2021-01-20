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
            $table->string('wing_name');
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
            'wing_name' => 'admin',
            'password' => '123456789'
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
