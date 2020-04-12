<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CustomersTable extends Migration
{

	public function up()
	{
		Schema::create('customers', function (Blueprint $table) {
		$table->increments('id');
		$table->string('name')->nullable();
		$table->string('email')->nullable();
		$table->string('password')->nullable();
		$table->string('phone')->nullable();
		$table->string('photo')->nullable();
		$table->string('invite_code')->nullable();
		$table->tinyinteger('status')->default(0);
		$table->timestamps();
		$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('customers');
	}
}
