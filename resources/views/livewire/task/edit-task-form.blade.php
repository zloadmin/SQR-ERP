<div class="row">
    <div class="col-md-9">
        @if(auth()->user()->canShowActions($task))
            <livewire:task.edit-form.actions :task="$task" :editable="auth()->user()->canEditActions($task)" />
        @endif
        @if(auth()->user()->canShowOrderDetails($task))
            <livewire:task.edit-form.order-details :task="$task" :editable="auth()->user()->canEditOrderDetails($task)" />
        @endif
        @if(auth()->user()->canShowDeliveryDetails($task))
            <livewire:task.edit-form.delivery-details :task="$task" :editable="auth()->user()->canEditDeliveryDetails($task)" />
        @endif
        @if(auth()->user()->canShowSQRCard($task))
            <livewire:task.edit-form.sqr-card :task="$task" :editable="auth()->user()->canEditSQRCard($task)" />
        @endif
    </div>
    <div class="col-md-3">
        <livewire:task.edit-form.sla :task="$task"/>
        @if(auth()->user()->canShowLog($task))
            <livewire:task.edit-form.log :task="$task" :editable="auth()->user()->canEditLog($task)" />
        @endif
    </div>
</div>
