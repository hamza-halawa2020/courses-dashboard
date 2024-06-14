require('./bootstrap');


// pusher.js

// Enable pusher logging - don't include this in production
Pusher.logToConsole = true;

var pusher = new Pusher('f886ff406557eef0a4b6', {
    cluster: 'eu'
});

var channel = pusher.subscribe('new-notification');
channel.bind('my-event-notification', function(data) {
    // Handle the event here, for example, display an alert
    alert(JSON.stringify(data));
    // You can perform other actions based on the received data
});
