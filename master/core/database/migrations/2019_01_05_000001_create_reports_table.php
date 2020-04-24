<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{

  public function up()
  {
    Schema::create('reports', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->integer('customer_id')->nullable();
      $table->text('report')->nullable();
      $table->softDeletes();
      $table->timestamps();
    });
  }


  public function down()
  {
    Schema::dropIfExists('reports');
  }
}