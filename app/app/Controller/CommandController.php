<?php

declare(strict_types=1);

namespace App\Controller;

use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;

#[Controller(prefix: "/cmd")]
class CommandController extends AbstractController
{
    #[GetMapping(path: "aa")]
    public function asdasdas(RequestInterface $request, ResponseInterface $response)
    {
        return $response->raw($request);
    }

}
