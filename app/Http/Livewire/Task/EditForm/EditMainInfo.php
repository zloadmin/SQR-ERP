<?php

namespace App\Http\Livewire\Task\EditForm;

use App\Models\Stage;
use App\Models\Tag;
use App\Models\Task;
use App\Models\TaskTag;
use Illuminate\Support\Collection;
use Livewire\Component;

class EditMainInfo extends Component
{
    public Task $task;
    public Collection $tags;
    public array $selected_tags;
    public Collection $stages;

    // Fields
    public string $name;
    public int $stage_id;

    protected $rules = [
        'name' => 'nullable|max:255',
        'stage_id' => 'required|exists:stages,id',
    ];

    protected $validationAttributes = [
        'stage_id' => 'stage',
    ];

    public function mount(Task $task)
    {

        $this->task = $task;
        $this->tags = $task->tags;
        $this->selected_tags = $task->getTagsIds();
        $this->name = $task->name;
        $this->stages = Stage::all();
        $this->stage_id = $task->stage_id;
    }

    public function render()
    {

        return view('livewire.task.edit-form.modal-edit-main-info');
    }

    public function editMainInfo()
    {
        $this->validate();
        $this->updateTask();
        $this->emit('showModal', 'task.edit-task', $this->task->id);
    }

    public function updateTask()
    {
        $this->task->stage_id = $this->stage_id;
        $this->task->name = $this->name;
        $this->task->update();
        $this->task->tags()->sync($this->selected_tags);
    }


}
