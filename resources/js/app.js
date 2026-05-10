import './bootstrap';

import Echo from 'laravel-echo';

import Pusher from 'pusher-js';

window.Pusher = Pusher;

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

window.Echo.channel('driver-notifications')
    .listen('.match.created', (e) => {

        console.log(e);

        let container = document.getElementById('notifications');

        let notif = document.createElement('div');
        notif.className = "bg-green-500 text-white p-3 rounded shadow";
        notif.innerText = "🚗 New Match Available!";

        container.appendChild(notif);

        setTimeout(() => {
            notif.remove();
        }, 5000);

    });

    window.Echo.channel('driver-notifications')
    .listen('.match.accepted', (e) => {

        console.log('Accepted:', e);

        let container = document.getElementById('notifications');

        let notif = document.createElement('div');

        notif.classList =
            "bg-blue-500 text-white p-3 rounded shadow";

        notif.innerText =
            "✅ الراكب وافق على الرحلة";

        container.appendChild(notif);

        setTimeout(() => {
            notif.remove();
        }, 5000);

    });
