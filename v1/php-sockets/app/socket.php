<?php 

    namespace MyApp;
    require_once __DIR__ . '/../vendor/autoload.php';

    use Ratchet\MessageComponentInterface;
    use Ratchet\ConnectionInterface;

    class Socket implements MessageComponentInterface {

        // const teemp = new \SplObjectStorage;
        public static $clients ='';
        public static $id_List = [];
        
        public function __construct()
        {
            self::$clients = new \SplObjectStorage;
            // $this->clients = new \SplObjectStorage;
        }

        public function onOpen(\Ratchet\ConnectionInterface $conn)
        {
           self::$clients->attach($conn);
            echo "New connection! ({$conn->resourceId})\n";
            array_push(self::$id_List,$conn->resourceId);
            var_dump(
                self::$id_List
            );
            // echo self::$clients->count()."\n";
            // var_dump(self::$clients);
        }

        public function onMessage(\Ratchet\ConnectionInterface $from, $msg)
        {
            // var_dump($msg);
            
            foreach (self::$clients as $client) {
                if( $from->resourceId == $client->resourceId ){
                    // continue;
                    $client->send("Client $from->resourceId said $msg");
                }
            }
        }

        public function onClose(\Ratchet\ConnectionInterface $conn)
        {
            self::$clients->detach($conn);
            echo "Connection {$conn->resourceId} has disconnected\n";
            $conn->close();
        }

        public function onError(\Ratchet\ConnectionInterface $conn, \Exception $e)
        {
            echo "An error has occurred: {$e->getMessage()}\n";
            $conn->close();
        }


        

    }

