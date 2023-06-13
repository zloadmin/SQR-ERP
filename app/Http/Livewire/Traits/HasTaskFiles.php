<?php
declare(strict_types=1);


namespace App\Http\Livewire\Traits;


use App\Models\Task;
use App\Models\TaskFile;
use Faker\Core\File;
use Illuminate\Support\Collection;

trait HasTaskFiles
{
    public array $delete_ids = [];
    public function addToDelete(int $id)
    {
        $this->delete_ids[$id] = $id;
    }
    public function deleteExistFile(string $var_name, int $id)
    {
        $collection = $this->getExistFileCollection($var_name);
        if($collection) {
            $this->{$var_name} = $collection->filter(function($file) use ($id) {
                return $file->id != $id;
            });
            $this->addToDelete($id);
        }
    }
    private function getExistFileCollection(string $var_name) : Collection
    {
        if(isset($this->{$var_name}) && in_array($var_name, TaskFile::EXIST_ALL_FIELDS)) {
            return $this->{$var_name};
        }
    }
    public function deleteFile(string $var_name, int $key)
    {
        if(isset($this->{$var_name}[$key]) && in_array($var_name, TaskFile::ALL_FIELDS)) {
            unset($this->{$var_name}[$key]);
        }
    }
    public function deleteExistFiles() {
        TaskFile::whereIn('id', $this->delete_ids)->delete();
    }
    public function storeFiles(Task $task, $fields = null)
    {
        $fields = $fields ?? TaskFile::MAIN_FIELDS;
        foreach ($fields as $field) {
            foreach ($this->{$field} as $file) {
                $task->files()->create([
                    'type' => $field,
                    'path' => $file->store('tasks/'  . $field ),
                    'original_name' => $file->getClientOriginalName(),
                    'size' => $file->getSize(),
                    'user_id' => auth()->id()
                ]);
            }
        }
    }

}
