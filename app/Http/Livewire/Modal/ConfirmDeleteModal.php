<?php

namespace App\Http\Livewire\Modal;

use Livewire\Component;

class ConfirmDeleteModal extends Component
{
    public int $delete_id;
    public function render()
    {
        return view('livewire.modal.confirm-delete-modal');
    }
}
