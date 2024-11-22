<?php

namespace Kepsondiaz\WaveHttpClient\Facades;


use Illuminate\Support\Facades\Facade;

class WaveHttpClient extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'WaveHttpClient';
    }
}
