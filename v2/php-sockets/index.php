<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<html>
    <head>
        <style>
            input, button { padding: 10px; }
        </style>
    </head>
    <body>

        <h1>Choose friend</h1>
        <div class="friend-list"></div>
        <input type="text" id="message" />
        <button onclick="transmitMessage()">Send</button>
        <script>
            // Create a new WebSocket.
            var socket  = new WebSocket('ws://localhost:8080');

            // Define the 
            var message = document.getElementById('message');

            function transmitMessage() {
                socket.send( message.value );
            }

            socket.onmessage = function(e) {
                console.log( e.data );
            }
        </script>
    </body>
</html>