import Echo from 'laravel-echo'

window.Pusher = require('pusher-js')
window.Pusher.logToConsole = process.env.NODE_ENV === 'development'

const echoConfig = {
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    encrypted: process.env.MIX_PUSHER_ENCRYPTED === 'true',
    wsHost: process.env.MIX_PUSHER_HOST,
    wsPort: parseInt(process.env.MIX_PUSHER_PORT),
    enabledTransports: ['ws'],
    disableStats: true,
    auth: {
        headers: {
            Accept: 'application/json',
        },
    },
}

window.Echo = new Echo(echoConfig)
