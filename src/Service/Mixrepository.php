<?php

namespace App\Service;

use Psr\Cache\CacheItemInterface;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;


class MixRepository{

    public function findAll(HttpClientInterface $httpClient,CacheInterface $cache): array
    {
        return $cache->get('cache_data', function(CacheItemInterface $cacheItem)use($httpClient){
            $cacheItem->expiresAfter(5);
            $response = $httpClient->request('GET','https://gist.githubusercontent.com/vinyssus/ab8f424657e1fc2827644589041129cc/raw/2336904b2d9a673b93a76bd718b0fb550415a771/mixed.json');
            // $message = $this->translate->trans('Symfony is great');
            // echo $message;
            return $response->toArray();
           });
    }
        
}