<div class="row">
    <div class="col-12">
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                {{--        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>--}}
                <strong>Error - </strong> {{ session('error') }}
            </div>
        @endif
        @if(session('status'))
            <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                {{--        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>--}}
                <strong>Success - </strong> {{ session('status') }}
            </div>
        @endif
        @if(session('warning'))
            <div class="alert alert-secondary alert-dismissible bg-secondary text-light border-0 fade show" role="alert">
                {{--        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>--}}
                <strong>Warning - </strong> {{ session('warning') }}
            </div>
        @endif

    </div>
</div>
