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
            $table->increments('id');
			$table->string('username', 16);
			$table->string('password', 100);
			$table->string('hoVaTen', 128);
			$table->date('ngaySinh')->nullable();
			$table->string('email');
			$table->string('soDienThoai')->nullable();
			$table->string('gioiTinh')->nullable(); //1 nam 2 nu 3 khac
            $table->string('diaChi')->nullable();
            $table->string('key', 128);
            $table->string('address', 128);
			$table->integer('Role'); //1 admin 2 user
            $table->integer('Active'); //1 đã active 0 chưa active
          
			$table->rememberToken();
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
}
