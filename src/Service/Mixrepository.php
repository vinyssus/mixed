<?php

namespace App\Service;

use Psr\Cache\CacheItemInterface;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;



class MixRepository{

    private $httpClient;
    private $cache;
    // private bool $isDebug;
    //private $defauld_langue;
    
    public function __construct(HttpClientInterface $httpClient,CacheInterface $cache, private bool $isDebug, private String $defauld_langue)
    {
        $this->httpClient = $httpClient;
        $this->cache = $cache;
        $this->isDebug = $isDebug;
        $this->defauld_langue = $defauld_langue;
    }

    public function findAll(): array
    {
        return $this->cache->get('cache_data', function(CacheItemInterface $cacheItem){
            $cacheItem->expiresAfter($this->isDebug ? 5 : 60);
            $response = $this->httpClient->request('GET','https://gist.githubusercontent.com/vinyssus/ab8f424657e1fc2827644589041129cc/raw/2336904b2d9a673b93a76bd718b0fb550415a771/mixed.json');
            // $message = $this->translate->trans('Symfony is great');
            // echo $message;
            if ($this->defauld_langue == 'en'){
                echo 'anglais';
            }else{
                echo 'francais';
            }
            return $response->toArray();
           });
    }
        
}