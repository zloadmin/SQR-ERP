<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css"
          integrity="sha512-P5MgMn1jBN01asBgU0z60Qk4QxiXo86+wlFahKrsQf37c9cro517WzVSPPV1tDKzhku2iJ2FVgL67wG03SGnNA=="
          crossorigin="anonymous"/>
    <script src="//{{ Request::getHost() }}:6001/socket.io/socket.io.js"></script>
</head>
<body>
<div class="container mt-3">
    <p>This test page. </p>




    <p><strong>You have to use &quot;socket.io-client&quot;: &quot;2.3.0&quot; or less. Issues
            https://github.com/tlaverdure/laravel-echo-server/issues/550</strong></p>
    <p>We have two channel. For client "chat.session_uuid.{session_uuid}" , and private for operator
        "operator.outlet_id.{outlet_id}"</p>
    <p>Source code</p>

    <div><pre><code class="language-javascrip">import Echo from "laravel-echo"

window.io = require('socket.io-client');

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001',
    // auth: {headers: {'Authorization': 'Bearer ' + window.manager_token}}
});


window.Echo.channel('test-socket')
    .listen('.App\\Events\\TestSocket', (e) => {
        console.log('TestSocket WORK!!!! ');
        console.log(e);
    });

</code></pre>
    </div>

</div>
</body>
<script
    src="https://code.jquery.com/jquery-3.4.1.js"
    integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
    crossorigin="anonymous"></script>

<script>


    function testSocket() {
        $.ajax
        ({
                dataType: "json",
                method: 'post',
                url: '/test-socket'
            }
        );
    }


    $(document).ready(function () {
        setTimeout(function () {
            testSocket();
        }, 500);

    })

</script>
<script type="text/javascript" src="/js/socket.js?v={{ rand(1,999999) }}"></script>

</html>
