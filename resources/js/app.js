import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT,
    wssPort: import.meta.env.VITE_REVERB_PORT,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
});
console.log("Hello")
window.Echo.channel('message')
    .listen('NewMessageEvent', (data) => {

        console.log(data)
        const chatContainer = document.querySelector(".chat-container");
        if (!chatContainer) return console.error("Chat container not found!");
        let format_date = formatDate(data.created_at);

        const loggedInUserId = document.querySelector('meta[name="user-id"]').getAttribute("content");

        const messageDiv = document.createElement("div");
        messageDiv.classList.add("message");

        // Check if the message sender is the logged-in user
        if (data.user_id == loggedInUserId) {
            console.log("logged in user")
            messageDiv.classList.add("message-sent");
            messageDiv.innerHTML = `<div class="message-text">${data.message}</div> 
            <div class="message-time">${format_date}</div>`;
        } else {
            console.log("not Logged in usersss")
            messageDiv.classList.add("message-received");
            messageDiv.innerHTML = `<div class="user-name">${data.user_name}</div> <div class="message-text">${data.message}</div> 
            <div class="message-time">${format_date}</div>
            
`;
        }



        chatContainer.appendChild(messageDiv);
        chatContainer.scrollTop = chatContainer.scrollHeight;

    });


window.Echo.channel('test')
    .listen('TestEvent', (data) => {
        console.log(data)

    });

// function formatDate(m) {
// let date = new Date(m); // Convert the string to a Date object

//     const day = String(date.getDate()).padStart(2, '0');
//     const month = String(date.getMonth() + 1).padStart(2, '0'); // Month is 0-indexed
//     const year = String(date.getFullYear()).slice(-2); // Get last two digits of year
//     const hours = String(date.getHours()).padStart(2, '0');
//     const minutes = String(date.getMinutes()).padStart(2, '0');
//     const seconds = String(date.getSeconds()).padStart(2, '0');
//     return `${day}/${month}/${year} ${hours}:${minutes}:${seconds}`;
// }

function formatDate(new_date) {
    let date = new Date(new_date);
    const options = {
        day: '2-digit',
        month: '2-digit',
        year: '2-digit',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: false // Use 24-hour format
    };

    const datePart = date.toLocaleDateString('en-GB', { day: '2-digit', month: '2-digit', year: '2-digit' });
    const timePart = date.toLocaleTimeString('en-GB', { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false });
    return `${datePart} ${timePart}`;
}