<?php

namespace Kepsondiaz\WaveHttpClient\Provider;

use Kepsondiaz\WaveHttpClient\WaveHttpClient;


class WaveHttpClientServiceProvider
{
    public function register()
    {
        $this->app->singleton('WaveHttpClient', function () {
            return new WaveHttpClient();
        });
    }
}