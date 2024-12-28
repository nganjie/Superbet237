<?php

namespace App\WebSockets;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Illuminate\Support\Facades\DB;

class WebSocketServer implements MessageComponentInterface
{
    protected $clients;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $conn->httpRequest->headers->set('Access-Control-Allow-Origin', 'http://localhost:4200');
        $this->clients->attach($conn);
        echo "Nouveau client connecté : ({$conn->resourceId})\n";
    }

    
    public function onMessage(ConnectionInterface $from, $msg)
    {
        // Suppose que le message contienne un mot clé pour la procédure  
        $keyword = json_decode($msg)->keyword ?? '';

        try {
            // Appeler la procédure stockée  
            $result = DB::select('CALL nom_de_votre_procedure(?)', [$keyword]);

            // Envoyer le résultat au client  
            $from->send(json_encode($result));
        } catch (\Exception $e) {
            echo "Erreur de la base de données : " . $e->getMessage();
            $from->send(json_encode(['error' => 'Database error: ' . $e->getMessage()]));
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        // Supprimer la connexion lors de la déconnexion  
        $this->clients->detach($conn);
        echo "Client déconnecté : ({$conn->resourceId})\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "Une erreur a été lancée : {$e->getMessage()}\n";
        $conn->close();
    }
}
