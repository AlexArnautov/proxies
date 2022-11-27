<?php

namespace App\Services;

use Illuminate\Support\Collection;

interface ProxyProviderInterface
{
    public function getProxies() : Collection;
}
