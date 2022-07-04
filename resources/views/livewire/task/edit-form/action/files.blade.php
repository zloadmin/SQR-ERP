<h5 class="mt-0 mb-2 font-16">Files</h5>
<ul class="list-group ">
    @isset($qr_arrache)
        @include('livewire.task.edit-form.action.file', ['file' => $qr_arrache, 'name' => 'QR\'s'])
    @endisset
    @isset($design_attache)
        @include('livewire.task.edit-form.action.file', ['file' => $design_attache, 'name' => 'Design'])
    @endisset
</ul>
