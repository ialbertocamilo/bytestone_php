<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\SSHClient;
use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;


#[AutoController]
class CheckhealthController
{
    public function index(RequestInterface $request, ResponseInterface $response)
    {
        $host = getenv('SSH_HOST');
        $port = 22;
        $username = getenv('SSH_USER');
        $password = getenv('SSH_PASSWORD');
        $client=new SSHClient($host, $port, $username, $password);
        return $response->raw($client->connect());
    }
}
