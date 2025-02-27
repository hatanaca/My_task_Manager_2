<?php 

namespace Tests\Feature;

use illuminate\Foundation\Testing\RefreshDatabase;
//in that context use is importing the class
use Tests\TestCase;
use app\Models\Task;

class TaskTest extends TestCase
{
	use RefreshDatabase;
	//in this context 'use' is taking properties and methods from RefreshDatabase
	//without herance
	public function test_create_task()
	{
		$data = [
			'title' => 'Test Task',
			'desciption' => 'Test description',
			'completed' => false
		];
		
		$response

