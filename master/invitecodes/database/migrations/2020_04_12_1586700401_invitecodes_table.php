<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InvitecodesTable extends Migration
{

	public function up()
	{
		Schema::create('invite_codes', function (Blueprint $table) {
		$table->increments('id');
		$table->string('code')->nullable();
		$table->integer('customer_id')->nullable();
		$table->tinyinteger('status')->default(0);
		$table->timestamps();
		$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('invite_codes');
	}
}
