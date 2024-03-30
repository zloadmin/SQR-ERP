<h5 class="mt-0 mb-2 font-16">Files</h5>
<ul class="list-group ">
    @isset($qr_arrache)
        @include('livewire.task.edit-form.action.blocks.file', ['file' => $qr_arrache, 'name' => 'QR\'s'])
    @endisset
    @isset($design_file)
        @include('livewire.task.edit-form.action.blocks.file', ['file' => $design_file, 'name' => 'Design'])
    @endisset
    @isset($content_attache)
        @include('livewire.task.edit-form.action.blocks.file', ['file' => $content_attache, 'name' => 'Content'])
    @endisset
    @isset($print_file_attache)
        @include('livewire.task.edit-form.action.blocks.file', ['file' => $print_file_attache, 'name' => 'Print File'])
    @endisset
{{--    @isset($image_of_printed_cards_attache)--}}
{{--        @include('livewire.task.edit-form.action.blocks.file', ['file' => $image_of_printed_cards_attache, 'name' => 'Image Of Printed Cards'])--}}
{{--    @endisset--}}
    @isset($delivery_slip_attache)
        @include('livewire.task.edit-form.action.blocks.file', ['file' => $delivery_slip_attache, 'name' => 'Delivery Slip'])
    @endisset
</ul>
