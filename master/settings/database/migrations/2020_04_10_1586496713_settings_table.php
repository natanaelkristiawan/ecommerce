<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SettingsTable extends Migration
{

	public function up()
	{
		Schema::create('settings', function (Blueprint $table) {
		$table->increments('id');
		$table->string('name')->nullable();
		$table->string('slug')->nullable();
		$table->text('default')->nullable();
		$table->text('value')->nullable();
		$table->tinyinteger('status')->default(0);
		$table->timestamps();
		$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}
