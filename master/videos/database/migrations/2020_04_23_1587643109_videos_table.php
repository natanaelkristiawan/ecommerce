<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VideosTable extends Migration
{

	public function up()
	{
		Schema::create('videos', function (Blueprint $table) {
		$table->increments('id');
		$table->string('name')->nullable();
		$table->string('youtube')->nullable();
		$table->string('position')->nullable();
		$table->tinyinteger('status')->default(0);
		$table->timestamps();
		$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('videos');
	}
}
