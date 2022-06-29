require('@popperjs/core');
require('bootstrap');
require('../../vendor/alighasemzadeh/livewire-bootstrap-modal/resources/js/modals');

import Echo from "laravel-echo"

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: 'key',
    wsHost: window.location.hostname,
    wsPort: 6001,
    forceTLS: false,
    disableStats: true,
    httpHost: window.location.hostname,
    httpPort: 6001,
});
