@if ($file && $file->approved_comment)
    <h5 class="mt-0 mb-2 font-16">Not approve</h5>
    <div class="alert alert-danger" role="alert">
{{--        <h4 class="alert-heading">Comment!</h4>--}}
        <p>{!! str_replace(PHP_EOL, "<br>", htmlspecialchars($file->approved_comment)) !!}</p>
    </div>
@endif
