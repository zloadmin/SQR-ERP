<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css"
          integrity="sha512-P5MgMn1jBN01asBgU0z60Qk4QxiXo86+wlFahKrsQf37c9cro517WzVSPPV1tDKzhku2iJ2FVgL67wG03SGnNA=="
          crossorigin="anonymous"/>
    <script src="//petapidev.ratsysdev.com:6001/socket.io/socket.io.js"></script>
</head>
<body>

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
        }, 2000);

    })

</script>
<script type="text/javascript" src="/js/socket.js?v={{ rand(1,999999) }}"></script>

</html>
