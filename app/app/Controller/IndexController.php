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
use function Hyperf\Stringable\str;

#[AutoController]
class IndexController extends AbstractController
{

    #[GetMapping(path: '/home')]
    public function home()
    {

        try {
            \Hyperf\Coroutine\go(function () {
                sleep(100);
                echo 'Gaaa';
            });
            \Hyperf\Coroutine\go(function () {
                sleep(100);
                echo 'aeaeaea';
            });
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return [
            'message' => 'GAAAA'
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
