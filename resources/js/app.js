// import {Autocomplete} from "./autocomplete";

// import {Autocomplete} from "./autocomplete";

require('@popperjs/core');
require('bootstrap');
require('../../vendor/alighasemzadeh/livewire-bootstrap-modal/resources/js/modals');
// require('./autocomplete')

import Echo from "laravel-echo"
window.io = require('socket.io-client');
window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001',
    // auth: {headers: {'Authorization': 'Bearer ' + window.manager_token}}
});
// let field = document.getElementById('chat-message-input')
// const ac = new Autocomplete(field, {
//     data: [{label: "I'm a label", value: 42}],
//     maximumItems: 5,
//     onSelectItem: ({label, value}) => {
//         console.log("user selected:", label, value);
//     }
// });

//
// window.Pusher = require('pusher-js');
//
// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'key',
//     wsHost: window.location.hostname,
//     wsPort: 6001,
//     forceTLS: true,
//     enabledTransports: ["ws", "wss"],
//     disableStats: true,
//     httpHost: window.location.hostname,
//     httpPort: 6001,
// });
