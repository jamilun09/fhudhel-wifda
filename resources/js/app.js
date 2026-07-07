/**
 * =================================================================
 * WEDDING API COMMAND CENTER - CORE JAVASCRIPT
 * =================================================================
 */

// 1. Memanggil Axios untuk HTTP Request
import axios from 'axios';
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// 2. Memanggil Laravel Echo & Pusher untuk menangkap sinyal Real-Time
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';
window.Pusher = Pusher;

// Mengatur antena ke server awan Pusher.com
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true
});

console.log(
    '%c🚀 Wedding API Real-Time System (Pusher Cloud) %cOnline & Ready!', 
    'background: #C9A24B; color: #0B1220; padding: 4px 8px; border-radius: 4px; font-weight: bold;', 
    'color: #4ade80; font-weight: bold; margin-left: 8px;'
);
