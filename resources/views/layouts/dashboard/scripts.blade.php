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
<script src="/js/jquery-3.5.1.min.js"></script>
<link href="/css/summernote.min.css" rel="stylesheet">
<script src="/js/summernote.min.js"></script>

<style>
    body {
        -webkit-text-size-adjust: none;
    }
</style>
<script>
    {{--let telegramUsernames = {!! \App\Models\User::getTelegramUsernamesJson() !!};--}}
    function initSummerNote() {
        $("#summernote").summernote('destroy');
        $("#summernote").summernote({
            // height: 100,
            disableGrammar: true,
            lineHeight: 10,
            toolbar: false,
            placeholder: 'Type text... Start @ for PM',
            backColor: 'red',
            foreColor: 'red',
            backgroundColor: '#f1f3fa',
            callbacks: {
                onChange: function(contents, $editable) {
                    document.getElementById('summernote_hidden').value = contents;
                    document.getElementById('summernote_hidden').dispatchEvent(new Event('input'));
                }
            },
            hint: {
                words: {!! \App\Models\User::getTelegramUsernamesJson() !!},
                match: /(.*)$/,
                search: function (keyword, callback) {
                    callback($.grep(this.words, function (item) {
                        return item.indexOf(keyword) === 0;
                    }));
                }
            }
        });
    }

    function initSummerNoteOnce() {
        let initAttr = 'data-summernote-initialized';
        let el = $("#summernote");
        if (el.length && !el.attr(initAttr)) {
            el.attr(initAttr, 1);
            initSummerNote();
        } else {
            console.log(el.length);
            console.log(el.attr(initAttr));
        }
    }
    function beforeSubmitSummer() {
        $('#summernote_hidden').text($('#summernote').summernote('code'));
    }

    document.addEventListener("DOMContentLoaded", () => {
        Livewire.hook('component.initialized', (component) => {
                initSummerNoteOnce();
        });
        Livewire.hook('message.processed', (message, component) => {
            initSummerNoteOnce();
        });
    });
    // function expandTextarea(id) {
    //     document.getElementById(id).addEventListener('keyup', function() {
    //         this.style.overflow = 'hidden';
    //         this.style.height = 0;
    //         this.style.height = this.scrollHeight + 'px';
    //     }, false);
    // }
    //
    // expandTextarea('chatMessageInput');
</script>
@include('layouts.dashboard.zoom-scripts')

{{--<script src="jquery.js"></script>--}}
{{--<script src="/js/autocomplete.js"></script>--}}
{{--<script src="/js/rangy-core.js"></script>--}}
{{--<script src="/js/caret-position.js"></script>--}}
{{--<script src="/js/bootstrap-tagautocomplete.js"></script>--}}
