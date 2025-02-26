<?php

use Illuminate\Database\Migrations\Migration;
use illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
//Importing standard functions
//migrations has two functions up and down
//migrations is like git, you can revert changes with the functions 
//abstraction of databe syntax

class CreateActivityLogsTable extends Migration
{
	public function up()
	{
		Schema::create('activity_logs', function (Blueprint $table) {
			$table->id();
			$table->string('action');
			$table->string('model');
			$table->unsignedBigInteger('model_id');
			$table->text('description')->nullable();
			$table->timestamps();
		});
	}
	public function down() 
	{
		Schema::dropIfExists('activity_logs');
	}// :: é usado para acessar o métodos e propriedades estaticas
}
	

