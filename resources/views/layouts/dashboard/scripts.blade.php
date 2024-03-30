@include('layouts.dashboard.zoom')
<!-- Alpine v3 -->
<script defer src="/js/alpine.js"></script>
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
    function cleanSummerNote() {
        $('#summernote').summernote('code', '');
    }
    function initSummerNote() {
        $("#summernote").summernote({
            disableGrammar: true,
            lineHeight: 10,
            toolbar: false,
            placeholder: 'Type text... Start @ for PM',
            backColor: 'red',
            foreColor: 'red',
            backgroundColor: '#f1f3fa',
            callbacks: {
                onChange: function (contents, $editable) {
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
        }
    }


    document.addEventListener("DOMContentLoaded", () => {
        Livewire.hook('component.initialized', (component) => {
            if(component.name === 'task.edit-form.log') {
                initSummerNoteOnce();
            }
        });
        Livewire.on('messageCreated', () => {
            cleanSummerNote();
        })
    });

</script>
@include('layouts.dashboard.zoom-scripts')
