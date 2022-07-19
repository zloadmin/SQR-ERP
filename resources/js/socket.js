import Echo from "laravel-echo"

window.io = require('socket.io-client');

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001',
    // auth: {headers: {'Authorization': 'Bearer ' + window.manager_token}}
});


window.Echo.channel('sqr-erp-redis-test-socket')
    .listen('.App\\Events\\TestSocket', (e) => {
        console.log('TestSocket WORK!!!! ');
        console.log(e);
    });

