<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\SSHClient;
use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Hyperf\Logger\Logger;
use Hyperf\Logger\LoggerFactory;
use Psr\Log\LoggerInterface;
use Swoole\Process;


#[AutoController]
class CheckhealthController
{
    private LoggerInterface $logger;

    public function __construct(LoggerFactory $loggerFactory)
    {
        $this->logger = $loggerFactory->get('app');
    }

    public function index(RequestInterface $request, ResponseInterface $response)
    {

        $process_docker= new \Symfony\Component\Process\Process(['docker','service','ls']);
        $process_docker->run();
        $host = getenv('SSH_HOST');
        $port = 22;
        $username = getenv('SSH_USER');
        $password = getenv('SSH_PASSWORD');
        $client=new SSHClient($host, $port, $username, $password);
        $client->connect();
        $this->logger->error($process_docker->getOutput());
        return 'gaaawdwa';
    }
}
