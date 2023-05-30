<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\TaskFile;
use Illuminate\Http\Request;
use Zip;

class AttachmentController extends Controller
{
    public function download(string $task_uuid, string $type)
    {
        $task = Task::firstOrFailByUUID($task_uuid);
        $files = $task->attachments()->where('type', $type);
        if(!$files->count()) abort(404, 'Files not found');
        if($files->count() == 1) {
            return response()->download($files->first()->real_path);
        }

        $zip = new \ZanySoft\Zip\Zip();
        $zip_path = $this->getZipPath($type);
        $zip->create($zip_path);
        foreach ($files->get() as $file) {
            if(file_exists($file->real_path)) {
                $zip->add($file->real_path);
            }
        }

        $zip->close();

        return response()->download($zip_path);

    }
    private function getZipPath(string $type)
    {
        return storage_path(sprintf('app/task/download_attachments_zips/%s_%d.zip', $type, time()));
    }
}
