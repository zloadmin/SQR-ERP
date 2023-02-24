import Echo from "laravel-echo"

window.io = require('socket.io-client');

window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: 'petapidev.ratsysdev.com:6001',
    // auth: {headers: {'Authorization': 'Bearer ' + window.manager_token}}
});


window.Echo.channel('test-socket')
    .listen('.App\\Events\\TestSocket', (e) => {
        console.log('TestSocket WORK!!!! ');
        console.log(e);
    });
// window.Echo.channel('stages.1')
//     .listen('.App\\Events\\StageTasksUpdated', (e) => {
//         console.log('StageTasksUpdated WORK!!!! ');
//         console.log(e);
//     });

