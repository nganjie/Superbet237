<?php
// app/Console/Commands/StartWebSocketServer.php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Ratchet\Server\IoServer;
use App\Console\Commands\WebSocketServer;
use Illuminate\Database\ConnectionInterface;

class StartWebSocketServer extends Command {
    protected $signature = 'websocket:start';
    protected $description = 'Start the WebSocket server';

    public function __construct() {
        parent::__construct();
    }

    public function handle() {
        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new WebSocketServer()
                )
            ),
            8090
        );
        $this->info('WebSocket server started on port 8090');
        $server->run();
    }
}
