<?php 

    require_once __DIR__ . '/app/socket.php';
    require dirname(__FILE__) . '/vendor/autoload.php';

    use Ratchet\Server\IoServer;
    use Ratchet\Http\HttpServer;
    use Ratchet\WebSocket\WsServer;
    use MyApp\Socket;


    $server = IoServer::factory(
        new HttpServer(
            new WsServer(
                new Socket()
            )
        ),
        8080
    );

    $server->run();
?>