<?php

declare(strict_types=1);

namespace App\Controller;

use HttpResponse;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Hyperf\Logger\LoggerFactory;
use Psr\Log\LoggerInterface;
use Symfony\Component\Filesystem\Filesystem;


#[Controller]
class LogController
{
    private LoggerInterface $logger;

    public function __construct(readonly LoggerFactory $loggerFactory)
    {
        $this->logger = $loggerFactory->get('app');
    }

    #[GetMapping(path: '')]
    public function index(RequestInterface $request, ResponseInterface $response)
    {
        $log_dir = BASE_PATH . '/runtime/logs/hyperf.log';

        if (!file_exists($log_dir)) {
            return $response->raw('Log file does not exist.');
        }

        $stream = function () use ($log_dir) {
            ob_start();
            $file = fopen($log_dir, 'r');

            while (!feof($file)) {
                $line = fgets($file);
                if ($line !== false) {
                    echo $line;
                    ob_flush();
                    flush();
                }
                usleep(100000);
            }

            fclose($file);
            ob_end_flush(); // Cerrar el buffer al finalizar
        };

        $response->raw('\n');
        return $response->withHeader('Content-Type', 'text/plain')
            ->withHeader('Transfer-Encoding', 'chunked')
            ->withHeader('Connection', 'keep-alive')
            ->withBody(new SwooleStream($stream()));
    }

}
