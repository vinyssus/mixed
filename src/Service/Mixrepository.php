<?php

namespace App\Service;

use Psr\Cache\CacheItemInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Dotenv\Command\DebugCommand;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;



class MixRepository{

    private $githubContentClient;
    private $cache;
    // private bool $isDebug;
    //private $defauld_langue;
    
    public function __construct(
        HttpClientInterface $githubContentClient,
        CacheInterface $cache,
        #[Autowire('%kernel.debug%')]private bool $isDebug,
         #[Autowire('%kernel.default_locale%')]private String $defauld_langue
        // #[Autowire(service:'twig.command.debug')]private DebugCommand $debug_twig
         )
    {
        $this->githubContentClient = $githubContentClient;
        $this->cache = $cache;
        $this->isDebug = $isDebug;
        $this->defauld_langue = $defauld_langue;
       // $this->debug_twig = $debug_twig;
    }

    public function findAll(): array
    {
        return $this->cache->get('cache_data', function(CacheItemInterface $cacheItem){
            $cacheItem->expiresAfter($this->isDebug ? 5 : 60);
            $response = $this->githubContentClient->request('GET','/vinyssus/mixed/main/file.json');
            // $message = $this->translate->trans('Symfony is great');
            // echo $message;
            // if ($this->defauld_langue == 'en'){
            //     echo 'anglais';
            // }else{
            //     echo 'francais';
            // }
            return $response->toArray();
           });
    }
        
}