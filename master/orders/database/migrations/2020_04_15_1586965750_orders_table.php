<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OrdersTable extends Migration
{

	public function up()
	{
		Schema::create('orders', function (Blueprint $table) {
		$table->increments('id');
		$table->integer('customer_id')->nullable();
		$table->integer('product_id')->nullable();
		$table->integer('unique_code')->nullable();
		$table->text('transfer_confirmation')->nullable();
		$table->text('download_link')->nullable();
		$table->string('invoice')->nullable();
		$table->string('total')->nullable();
		$table->datetime('timeout')->nullable();
		$table->tinyinteger('status')->default(0);
		$table->timestamps();
		$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}
