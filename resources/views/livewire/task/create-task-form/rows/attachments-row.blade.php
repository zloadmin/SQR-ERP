<div class="row mb-4">
    @include('livewire.task.create-task-form.file_block', ['var_name' => 'design_attachments', 'title' => 'Design Attachments'])
    @include('livewire.task.create-task-form.file_block', ['var_name' => 'card_details_attachments', 'title' => 'Card details attachments'])
    @include('livewire.task.create-task-form.file_block', ['var_name' => 'qr_attachments', 'title' => 'QR Attachments'])
</div>
