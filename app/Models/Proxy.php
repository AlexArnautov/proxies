<?php

namespace App\Models;

use Illuminate\Contracts\Support\Arrayable;
use JetBrains\PhpStorm\ArrayShape;

class Proxy implements Arrayable
{
    public static array $possibleFormats =
        [
            'ip:port@login:password',
            'ip:port',
            'ip',
            'ip@login:password'
        ];

    /**
     * @param string $ip
     * @param int $port
     * @param string $login
     * @param string $password
     */
    public function __construct(
        private readonly string $ip,
        private readonly int $port,
        private readonly string $login,
        private readonly string $password
    ) {
    }

    public function getIp(): string
    {
        return $this->ip;
    }

    public function getPort(): int
    {
        return $this->port;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    #[ArrayShape(['ip' => "string", 'port' => "int", 'login' => "string", 'password' => "string"])]
    public function toArray(): array
    {
        return [
            'ip' => $this->ip,
            'port' => $this->port,
            'login' => $this->login,
            'password' => $this->password,
        ];
    }
}
