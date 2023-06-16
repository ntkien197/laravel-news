<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email', 255)->unique();
            $table->string('password',255);
            $table->string('name',255);
            $table->string('username', 255);
            $table->integer('status')->default(1);
            $table->date('birthday')->nullable();
            $table->char('phone', 14)->nullable();
            $table->integer('gender')->nullable();
            $table->string('address',255)->nullable();
            $table->text('avatar')->nullable();
            $table->text('email_verified_at')->nullable();
            $table->text('remember_token')->nullable();
            $table->text('extra')->nullable();
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
        Schema::dropIfExists('users');
    }
};
