<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductsTable extends Migration
{

	public function up()
	{
		Schema::create('products', function (Blueprint $table) {
		$table->increments('id');
		$table->string('name')->nullable();
		$table->string('slug')->nullable();
		$table->string('price_idr')->nullable();
		$table->string('price_dollar')->nullable();
		$table->text('detail')->nullable();
		$table->text('file')->nullable();
		$table->tinyinteger('status')->default(0);
		$table->timestamps();
		$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('products');
	}
}
