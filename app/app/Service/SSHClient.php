<?php
declare(strict_types=1);

namespace App\Service;


use Hyperf\Server\Exception\ServerException;
use phpseclib3\Net\SSH2;

//#[Singleton]
final class SSHClient
{
    private SSH2 $ssh;

    public function __construct(
        private readonly string $host,
        private readonly int    $port,
        private readonly string $username,
        private readonly string $password
    )
    {
        $this->ssh = new SSH2($this->host, $this->port);
        if (!$this->ssh->login($this->username, $this->password)) {
            throw new ServerException('Login Failed');
        }

        return null;
    }

    public function connect(): string
    {
//        $response = $this->ssh->exec("pwd");
        $response=  $this->ssh->exec('cd server && ls -la');
        return $response;
    }

}
