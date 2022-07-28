<?php 
    require_once __DIR__ . '/app/socket.php';
    use \MyApp\Socket;
    // new Socket();
?>

<html>
    <head>
        <title>Menu</title>
        <style>
            input, button { padding: 10px; }
        </style>
    </head>
    <body>
        <h1>Choose friend</h1>
        <?php var_dump( Socket::$id_List);?>


        <!-- <input type="text" id="message" />
        <button onclick="transmitMessage()">Send</button> -->
        <script>
            // Create a new WebSocket.
            var socket  = new WebSocket('ws://localhost:8080');

            // // Define the 
            // var message = document.getElementById('message');
            // // var friend = document.getElementById('friend');

            // function transmitMessage() {
            //     socket.send( message.value );
            // }

            // socket.onmessage = function(e) {
            //     alert( e.data );
            // }
        </script>
    </body>
</html>