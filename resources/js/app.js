import './bootstrap';

import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


// =======================
// Driver Notifications
// =======================
window.Echo.channel('driver-notifications')
    .listen('.match.created', (e) => {

        console.log(e);

        let container = document.getElementById('notifications');

        if (!container) return;

        let notif = document.createElement('div');
        notif.className = "bg-green-500 text-white p-3 rounded shadow";
        notif.innerText = "🚗 New Match Available!";

        container.appendChild(notif);

        setTimeout(() => notif.remove(), 5000);
    });


window.Echo.channel('driver-notifications')
    .listen('.match.accepted', (e) => {

        console.log('Accepted:', e);

        let container = document.getElementById('notifications');

        if (!container) return;

        let notif = document.createElement('div');

        notif.className = "bg-blue-500 text-white p-3 rounded shadow";
        notif.innerText = "✅ الراكب وافق على الرحلة";

        container.appendChild(notif);

        setTimeout(() => notif.remove(), 5000);
    });


// =======================
// Trip Chat (REAL TIME)
// =======================
window.Echo.private(`trip-chat.${window.tripId}`)
    .subscribed(() => {
        console.log('SUBSCRIBED 🔥');
    })
    .listen('.message.sent', (e) => {

        console.log('LIVE EVENT:', e);

        let box = document.getElementById('messages-' + e.trip_id);

        if (!box) return;

        let div = document.createElement('div');
        div.className = "p-2 rounded bg-gray-100";
        div.innerHTML = `<b>${e.sender}:</b> ${e.message}`;

        box.appendChild(div);
    });
