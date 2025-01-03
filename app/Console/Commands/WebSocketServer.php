<?php

// app/Console/Commands/WebSocketServer.php
namespace App\Console\Commands;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB; // Pour exécuter des requêtes SQL avec Laravel
use React\EventLoop\Loop;
use React\EventLoop\LoopInterface;

class WebSocketServer implements MessageComponentInterface
{

    protected $clients;
    protected LoopInterface $loop;
    private array $timers;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
        $this->timers = []; // Initialisation de la propriété timers
        $this->loop = Loop::get();
    }

    /*  
    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);
        echo "New connection! ({$conn->resourceId})\n";
    } 
    */

    // Lorsque la connexion est établie
    public function onOpen(ConnectionInterface $conn)
    {
        // Ajouter le client à la liste des connexions
        $this->clients->attach($conn);
        echo "New connection! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        $data = json_decode($msg, true);
        $tirageID = $data['tirageID'];
        $code_salle = $data['code_salle'];
        $token = $data['token'];
        $type = $data['type'];
        if (isset($type)) {
            echo "Type en cours d'exécution ===> ({$type})\n";
            switch ($type) {
                case 'pari-types':
                    $this->repAlgoList($from, $code_salle);
                    break;
                case 'stat-page':
                    $this->fnStatPage($from, $code_salle);
                    break;
                case 'algoD':
                    $this->algoD($from, $code_salle, $tirageID);
                    echo "Mon tirage ===> ({$tirageID})\n";
                    break;
                case 'dernierstirages':
                    $this->dernierstirages($from, $code_salle);
                    break;
                case 'bouleslesplustirees':
                    $this->bouleslesplustirees($from, $code_salle);
                    break;
                case 'bouleslesmoinstirees':
                    $this->bouleslesmoinstirees($from, $code_salle);
                    break;
                case 'derniersmultiplicateurs':
                    $this->derniersmultiplicateurs($from, $code_salle);
                    break;
                case 'cycleMouvement':
                    $this->cycleMouvement($from, $code_salle);
                    break;
                case 'salleSynchUpdate':
                    $this->salleSynchUpdate($from, $code_salle);
                    break;
                case 'synchro':
                    $this->synchro($from, $code_salle);
                    break;
                case 'repAlgoList':
                    $this->repAlgoList($from, $code_salle);
                    break;
                case 'jeuxAcces':
                    $this->jeuxAcces($from, $token);
                    break;

                default:
                    # code...
                    break;
            }
            // Synchronisez l'état de la salle avec le code reçu
            $this->syncSalleState($from, $code_salle);
        }
    }

    private function fnStatPage(ConnectionInterface $conn, $code_salle)
    {
        try {
            $result1 = DB::select('CALL psRepAlgo_List(?)', [$code_salle]);
            $result2 = DB::select('CALL psList_DerniersTirage(?)', [$code_salle]);
            $result3 = DB::select('CALL psList_BoulesLesPlusTirees(?)', [$code_salle]);
            $result4 = DB::select('CALL psList_BoulesLesMoinsTirees(?)', [$code_salle]);
            $result5 = DB::select('CALL psList_DerniersMultiplicateurs(?)', [$code_salle]);
            $conn->send(json_encode(['rep_algo' => $result1,
                                     'derniers_tirages' => $result2,
                                     'lesplus_tirees' => $result3,
                                     'lesmoins_tirees' => $result4,
                                     'derniers_mult' => $result5,]));
        } catch (\Exception $e) {
            $conn->send(json_encode(['error' => $e->getMessage()]));
        }
    }

    private function algoD(ConnectionInterface $conn, $code_salle, $tirageID)
    {
        try {
            $results = DB::select('CALL psAlgorithmeDistribution(?,?)', [$code_salle, $tirageID]);
            $conn->send(json_encode($results));
        } catch (\Exception $e) {
            $conn->send(json_encode(['error' => $e->getMessage()]));
        }
    }

    private function dernierstirages(ConnectionInterface $conn, $code_salle)
    {
        try {
            $results = DB::select('CALL psList_DerniersTirage(?)', [$code_salle]);
            $conn->send(json_encode($results));
        } catch (\Exception $e) {
            $conn->send(json_encode(['error' => $e->getMessage()]));
        }
    }

    private function bouleslesplustirees(ConnectionInterface $conn, $code_salle)
    {
        try {
            $results = DB::select('CALL psList_BoulesLesPlusTirees(?)', [$code_salle]);
            $conn->send(json_encode($results));
        } catch (\Exception $e) {
            $conn->send(json_encode(['error' => $e->getMessage()]));
        }
    }

    private function bouleslesmoinstirees(ConnectionInterface $conn, $code_salle)
    {
        try {
            $results = DB::select('CALL psList_BoulesLesMoinsTirees(?)', [$code_salle]);
            $conn->send(json_encode($results));
        } catch (\Exception $e) {
            $conn->send(json_encode(['error' => $e->getMessage()]));
        }
    }

    private function derniersmultiplicateurs(ConnectionInterface $conn, $code_salle)
    {
        try {
            $results = DB::select('CALL psList_DerniersMultiplicateurs(?)', [$code_salle]);
            $conn->send(json_encode($results));
        } catch (\Exception $e) {
            $conn->send(json_encode(['error' => $e->getMessage()]));
        }
    }

    private function cycleMouvement(ConnectionInterface $conn, $code_salle)
    {
        try {
            $results = DB::select('CALL psCycle_Mouvement(?)', [$code_salle]);
            $conn->send(json_encode($results));
        } catch (\Exception $e) {
            $conn->send(json_encode(['error' => $e->getMessage()]));
        }
    }

    private function salleSynchUpdate(ConnectionInterface $conn, $code_salle)
    {
        try {
            $results = DB::select('CALL psSalleSync_Update(?)', [$code_salle]);
            $conn->send(json_encode($results));
        } catch (\Exception $e) {
            $conn->send(json_encode(['error' => $e->getMessage()]));
        }
    }

    private function synchro(ConnectionInterface $conn, $code_salle)
    {
        try {
            $results = DB::select('CALL psSalleSync_Select(?)', [$code_salle]);
            $conn->send(json_encode($results));
        } catch (\Exception $e) {
            $conn->send(json_encode(['error' => $e->getMessage()]));
        }
    }

    private function repAlgoList(ConnectionInterface $conn, $code_salle)
    {
        try {
            $results = DB::select('CALL psRepAlgo_List(?)', [$code_salle]);
            $conn->send(json_encode($results));
        } catch (\Exception $e) {
            $conn->send(json_encode(['error' => $e->getMessage()]));
        }
    }
    
    private function jeuxAcces(ConnectionInterface $conn, $token)
    {
        try {
            $results = DB::select('CALL psJeux_Acces(?)', [$token]);
            echo "Resultat ===> ".json_encode($results)."\n";
            $conn->send(json_encode($results));
        } catch (\Exception $e) {
            $conn->send(json_encode(['error' => $e->getMessage()]));
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        // Enlevez le timer lorsque la connexion est fermée
        if (isset($this->timers[$conn->resourceId])) {
            $this->loop->cancelTimer($this->timers[$conn->resourceId]);
            unset($this->timers[$conn->resourceId]);
        }
        $this->clients->detach($conn);
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }


    // Méthode pour exécuter la procédure stockée et envoyer les résultats
    private function syncSalleState(ConnectionInterface $conn, $code_salle)
    {
        try {
            // Exécuter la procédure stockée et obtenir les résultats
            $results = DB::select('CALL psSalleSync_Select(?)', [$code_salle]);

            // Envoyer les résultats au client connecté
            $conn->send(json_encode($results));
        } catch (\Exception $e) {
            // En cas d'erreur, envoyer le message d'erreur
            $conn->send(json_encode(['error' => $e->getMessage()]));
        }
    }
}
