<div class="row mb-4">
    @include('livewire.files-block.main_block', ['var_name' => 'design_attachments', 'exist_var_name' => 'exist_design_attachments', 'title' => 'Design Attachments'])
    @include('livewire.files-block.main_block', ['var_name' => 'card_details_attachments', 'exist_var_name' => 'exist_card_details_attachments', 'title' => 'Card details attachments'])
    @include('livewire.files-block.main_block', ['var_name' => 'qr_attachments', 'exist_var_name' => 'exist_qr_attachments', 'title' => 'QR Attachments'])
</div>
<div class="row mb-4">
    @include('livewire.files-block.main_block', ['var_name' => 'content_attachments', 'exist_var_name' => 'exist_content_attachments', 'title' => 'Approval content'])
    @include('livewire.files-block.main_block', ['var_name' => 'printing_file_attachments', 'exist_var_name' => 'exist_printing_file_attachments', 'title' => 'Print file'])
    @include('livewire.files-block.main_block', ['var_name' => 'image_of_printed_cards_attachments', 'exist_var_name' => 'exist_image_of_printed_cards_attachments', 'title' => 'Printed card'])
</div>
<div class="row mb-4">
    <div class="col-md-12">
        <!--- Google attachments Field --->
        <div class="form-group">
            <label for="google_attachments_text">Google attachments</label>
            <textarea class="form-control @error('google_attachments_text') is-invalid @enderror" wire:model="google_attachments_text" rows="10"></textarea>
            @error('google_attachments_text')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
</div>
