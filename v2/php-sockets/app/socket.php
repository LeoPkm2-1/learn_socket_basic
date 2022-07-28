<?php

    namespace MyApp;
    require_once __DIR__ . '/../vendor/autoload.php';


    use Ratchet\MessageComponentInterface;
    use Ratchet\ConnectionInterface;

    class Socket implements MessageComponentInterface {

        public function __construct()
        {
            $this->clients = new \SplObjectStorage;
            $this->id_list=[];
        }
    
        public function onOpen(ConnectionInterface $conn) {
    
            // Store the new connection in $this->clients
            $this->clients->attach($conn);
            array_push($this->id_list,$conn->resourceId);
            echo "New connection! ({$conn->resourceId})\n";
            print_r($this->id_list);
        }

        public function onMessage(ConnectionInterface $from, $msg)
        {
            foreach ($this->clients as $client) {
                
                if($from->resourceId== $client->resourceId){
                    continue;
                }
                
                $client->send("Client $from->resourceId said $msg");
            }
        }

        public function onClose(ConnectionInterface $conn)
        {
            // The connection is closed, remove it, as we can no longer send it messages
            $this->clients->detach($conn);

            echo "Connection {$conn->resourceId} has disconnected\n";
            $this->remVal($conn->resourceId,$this->id_list);
            print_r($this->id_list);
            $conn->close();

        }

        public function onError(ConnectionInterface $conn, \Exception $e)
        {
            echo "An error has occurred: {$e->getMessage()}\n";
            $this->remVal($conn->resourceId,$this->id_list);
            $conn->close();
        }

        public function remVal($val,&$arr){
            while(array_search($val,$arr)!==false){
                $index =array_search($val,$arr);
                array_splice($arr, $index, 1);
            }
        }


    }