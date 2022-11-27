<?php

namespace App\Providers;

use App\Repositories\RandomProxyRepository;
use App\Services\ProxyProviderInterface;
use App\Services\RandomProxyProvider;
use Illuminate\Support\ServiceProvider;

class ProxyServiceProvider extends ServiceProvider
{
    /**
     * Register any proxy services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->when(RandomProxyRepository::class)
            ->needs(ProxyProviderInterface::class)
            ->give(function () {
                return $this->app->make(RandomProxyProvider::class);
            });

        //bindings for other proxies
    }
}
