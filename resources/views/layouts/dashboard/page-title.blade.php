<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                @include('layouts.dashboard.breadcrumb')
            </div>
            <h4 class="page-title">
                {{ $title ?? '' }}
                @stack('title')
            </h4>
        </div>
    </div>
</div>
<!-- end page title -->
