<?php

use App\Services\UserService;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->timestamps();
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->integer('role')->default(4);
            $table->string('username')->unique();
            $table->string('avatar')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->date('birth_date');
            $table->boolean('notifications')->default(true);
            $table->boolean('post_comments')->default(true);
        });

        // Create defaults accounts
        $service = new UserService;
        $service->createStarterAccounts();
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
