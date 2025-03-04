<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace App\Controller;


use Hyperf\HttpServer\Annotation\AutoController;
use Hyperf\HttpServer\Annotation\GetMapping;
use Swoole\Exception;
use Symfony\Component\HttpFoundation\File\File;

use function Hyperf\Coroutine\go;
use function Hyperf\Stringable\str;
use Hyperf\Coroutine\Coroutine;
use Hyperf\Coroutine\Parallel;

#[AutoController]
class IndexController extends AbstractController
{

//    #[GetMapping(path: '/home')]
    public function home()
    {
        $parallel=new Parallel();
        Coroutine::create(function (){
            go(function() {
                echo "Mensaje 1";
            });
            go(function() {
                echo "Mensajito 2";
            });
        });

        return [
            'message' => 'hola awd '
        ];
    }

    public function index()
    {
        $user = $this->request->input('user', 'Hyperf');
        $method = $this->request->getMethod();

        return [
            'method' => $method,
            'message' => "Hello {$user}.",
        ];
    }
}
