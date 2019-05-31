<?php

    namespace App;

    use Ratchet\MessageComponentInterface;
    use Ratchet\ConnectionInterface;

    $ds = DIRECTORY_SEPARATOR;
    $baseDir = realpath(dirname(__FILE__).$ds.'..'.$ds.'..'.$ds.'..');
    include_once($baseDir.'/vendor/autoload.php');

    class ChatListenner implements MessageComponentInterface {
        protected $connections;
        protected $clients;

        public function __construct() {
            $this->connections = array();
            $this->clients = array();
        }

        public function onOpen(ConnectionInterface $conn) {
            $this->connections[$conn->resourceId] = $conn;
        }

        public function onMessage(ConnectionInterface $from, $mensagemJSON) {
            $mensagem = json_decode($mensagemJSON);

            if ($mensagem->tipo == 'registro') {
                $this->clients[$from->resourceId] = $mensagem->usuario;
            } else if ($mensagem->tipo == 'mensagem' || $mensagem->tipo == 'escrevendo') {
                foreach ($this->clients as $resourceId => $client) {
                    if ($mensagem->chat == $client) {
                        $this->connections[$resourceId]->send($mensagem);
                    }
                }
            }
        }

        public function onClose(ConnectionInterface $conn) {
            unset($this->connections[$conn->resourceId]);
            unset($this->clients[$conn->resourceId]);
        }

        public function onError(ConnectionInterface $conn, \Exception $e) {
            $conn->close();
        }
    }

?>