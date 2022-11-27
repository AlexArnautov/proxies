<?php

namespace App\Services;

use App\Models\Proxy;
use Exception;
use Illuminate\Support\Collection;

class RandomProxyProvider implements ProxyProviderInterface
{

    /**
     * @throws Exception
     */
    public function getProxies(): Collection
    {
        $amount = random_int(1, 20);
        $collection = new Collection();
        for ($i = 1; $i <= $amount; $i++) {
            $proxy = new Proxy(
                ip: fake()->ipv4,
                port: random_int(5000, 65536),
                login: fake()->userName,
                password: base64_encode(fake()->password)
            );
            $collection->add($proxy);
        }

        return $collection;
    }
}
