<?php

require __DIR__ . '/vendor/autoload.php';

use Ratchet\Server\IoServer;
use App\WebSockets\WebSocketServer;

$server = IoServer::factory(
    new WebSocketServer(),
    8080
);

$server->run();
