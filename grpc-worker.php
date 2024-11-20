<?php

use GRPC\Pinger\PingerInterface;
use Spiral\RoadRunner\GRPC\Server;
use Spiral\RoadRunner\Worker;
use Symfony\Component\HttpClient\HttpClient;
use App\Service\Pinger;

require __DIR__ . '/vendor/autoload.php';

$server = new Server();

$server->registerService(PingerInterface::class, new Pinger(HttpClient::create()));

$server->serve(Worker::create());