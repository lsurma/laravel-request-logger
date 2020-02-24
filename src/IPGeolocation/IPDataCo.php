<?php

namespace LSurma\LaravelRequestLogger\IPGeolocation;

use Illuminate\Cache\Repository as CacheRepository;

/**
 * ipdata.co IP geolocation service provider
 */
class IPDataCo
{
    public function __construct(CacheRepository $cache, array $config = [])
    {
    }


    // public function get()
    // {
    //     if($fresh) {
    //         return $fresh();
    //     } else {
            
    //     }
    // }

    // protected function getData(ip, prec)


    // protected function getFreshData(ip, prec)

    // protected function callAPI()
}