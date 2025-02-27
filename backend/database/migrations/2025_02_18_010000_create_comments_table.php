<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schemaz\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration 
{
	public function up() 
	{
		Schema::create('comments', function (Blueprint $table) {
			$table->id();
			$table->foreingId('task_id')->constrained()->onDelete('cascade');
			$table->foreingId('user_id')->constrained()->onDelete('cascade');
			$table->text('content');
			$table->timestamps();
		});
	}
	public function down() 
	{
		Schema::dropIfExists('comments');
	}
}
