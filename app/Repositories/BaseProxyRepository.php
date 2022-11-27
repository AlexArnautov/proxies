<?php

namespace App\Repositories;

use App\Services\ProxyProviderInterface;
use Illuminate\Support\Collection;

abstract class BaseProxyRepository
{
    public function __construct(
        private readonly ProxyProviderInterface $proxyProvider
    ) {
    }

    public function all(): Collection
    {
        return $this->proxyProvider->getProxies();
    }
}
