<?php

namespace App\Http\Controllers;

use illuminate\Http\Request;
use App\Models\Attachment;
use Illuminate\Support\Facades\Storage;

class AttachmentController extends Controller
{
	// POST /api/tasks/{taskId}/attachments
	public function store(Request $request, $taskid)
	{//taskid vai vir da url em rotas exp...{}
		$request->validate([
			'file' => 'required|file|max:2048'
			//convert in rules to file 
		]);

		try {
			$file = $request('file');
			$path = $file->store('attachments');
			$attachment = Attachment::create([
				'task_id' => $taskId,
				'filename' => $file->getClientOriginalName(),
				'filepath' => $path
			]);
			return response()->json($attachment, 201);
		} catch (\Exception $e) {
			return response()->json(['message' => 'Error uploading file'], 505);
		}
	}
}

