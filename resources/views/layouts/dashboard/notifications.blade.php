<script>
    $(document).ready(function () {
        @if (session('status'))
            showStatus('{{ session('status') }}');
        @endif
        @if (session('warning'))
            showWarning('{{ session('warning') }}');
        @endif
        @if ($errors->any())
            showWarning('{{ $errors->first() }}');
        @endif
    });
</script>