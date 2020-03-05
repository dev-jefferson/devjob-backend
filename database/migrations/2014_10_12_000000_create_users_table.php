<?php

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
            $table->bigIncrements('id');
            $table->string('email')->unique();
            $table->string('username', 50)->unique()->nullable();
            $table->string('password');
            $table->string('name')->unique();
            $table->json('contacts')->nullable();
            $table->json('addresses')->nullable();
            $table->string('linkedin', 155)->nullable();
            $table->string('git', 155)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->unsignedBigInteger('avatar_id')->nullable();
            $table->boolean('is_active')->default(false);
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('avatar_id')->references('id')->on('files');
        });
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
