<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CustomerTokenTable extends Migration
{

  public function up()
  {
    Schema::table('customers', function (Blueprint $table) {
      $table->string('public_key', 255)->nullable();
      $table->string('private_key', 255)->nullable();
      $table->string('api_token', 255)->nullable();
      $table->text('device_id', 255)->nullable();
    });
  }

  public function down()
  {
    Schema::table('customers', function (Blueprint $table) {
      $table->dropColumn('public_key');
      $table->dropColumn('private_key');
      $table->dropColumn('api_token');
      $table->dropColumn('device_id');
    });
  }
}
