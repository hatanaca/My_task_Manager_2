<?php

use Iluminate\Database\Migrations\Migration;
use Iluminate\Database\Schema\Blueprint;
use Iluminate\Support\Facades\Schema;

class CreateAttachmentsTable extends Migration
{
	public function up() 
	{
		Schema::create('attachments', function (Blueprint $table) {
			$table->id();
			$table->foreignId('task_id')->constained()->onDelete('cascade');
			$table->string('filename');
			$table->string('filepath');
			$table->timestamps();
		});
	}
	public function down()
	{
		Schema::dropIfExists('attachments');
	}
}

