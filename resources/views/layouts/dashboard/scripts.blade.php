@include('layouts.dashboard.zoom')
{{--<script src="/js/jquery.js"></script>--}}
{{--<script src="/js/bootstrap.bundle.js"></script>--}}

<!-- Alpine v3 -->
<script defer src="/js/alpine.js"></script>

{{--    <script src="/js/metisMenu.js"></script>--}}
{{--    <script src="/js/jquery.slimscroll.js"></script>--}}
{{--    <script src="/js/jquery.toast.js"></script>--}}
{{--    <script src="/js/jquery.mask.min.js"></script>--}}
{{--    <script src="/js/select2.js"></script>--}}
{{--    <script src="/js/moment.js"></script>--}}
{{--    <script src="/js/hyper.js"></script>--}}
{{--<script src="/js/functions.js"></script>--}}
{{--<script src="/js/app.js"></script>--}}
{{--<script src="/js/laravel-echo.js"></script>--}}
{{--    <script src="/js/jquery.datetimepicker.full.min.js"></script>--}}
{{--    <script>--}}
{{--        $.ajaxSetup({--}}
{{--            headers: {--}}
{{--                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--            }--}}
{{--        });--}}
{{--    </script>--}}
{{--    @include('layouts.dashboard.notifications')--}}
{{--@livewireScripts--}}
<!--livewire:modals-->
{{--<livewire:modals/>--}}
<!--livewire:modals-->
{{--@livewire('livewire-ui-modal')--}}
{{--@stack('scripts')--}}

<livewire:modals/>

<livewire:scripts/>

<script src="//{{ Request::getHost() }}:6001/socket.io/socket.io.js"></script>
<script type="text/javascript" src="/js/app.js"></script>
<style>
    body {
        -webkit-text-size-adjust: none;
    }
</style>
<script>
    let current_zoom = 100;
    let current_zoom_scale = 1.0;

    function zoomOut() {
        // setZoom(getCurrentZoom() - 10);
        setZoomScale(getCurrentZoomScale() - 0.1);
    }

    function zoomIn() {
        // setZoom(getCurrentZoom() + 10);
        setZoomScale(getCurrentZoomScale() + 0.1);
    }

    function getCurrentZoom() {
        let zoom = document.body.style.zoom;
        return zoom ? parseInt(zoom) : 100;
    }

    function getCurrentZoomScale() {
        return current_zoom_scale;
    }

    function setZoom(zoom) {
        console.log('Set zoom is ' + zoom);
        document.body.style.zoom = zoom + '%';
    }

    function setZoomScale(scale) {
        // let scale = 'scale(' + zoom + ')';
        console.log(scale);
        document.body.style.transform = "scale(" + scale + ")";
        document.body.style.transformOrigin = "top left";
        document.body.style.width = (100 / scale) + "%";
        document.body.style.height = (100 / scale) + "%";
        // document.body.style.webkitTransform =         // Chrome, Opera, Safari
        //     document.body.style.msTransform =           // IE 9
        //         document.body.style.transform = scale;
        // console.log(scale);
        // document.body.style.webkitTransform = scale;
        // document.body.style.MozTransform = scale;
        // document.body.style.OTransform = scale;
        // document.body.style.msTransform = scale;
        // document.body.style.transform = scale;
        // console.log('Set zoom is ' + zoom);
        // document.body.style.zoom = zoom + '%';
    }
</script>
{{--<script src="jquery.js"></script>--}}
{{--<script src="/js/autocomplete.js"></script>--}}
{{--<script src="/js/rangy-core.js"></script>--}}
{{--<script src="/js/caret-position.js"></script>--}}
{{--<script src="/js/bootstrap-tagautocomplete.js"></script>--}}
