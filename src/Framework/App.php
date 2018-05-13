<?php
namespace Framework;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Psr7\Response;

class App
{

    public function run(ServerRequestInterface $request): ResponseInterface
    {
        
        $uri = $request->getUri()->getPath();
        $len = strlen($uri)-1;
        if (!empty($uri) && $uri[$len]==="/") {
            return  (new Response() )
             ->withStatus(301)
             ->withHeader('Location', substr($uri, 0, -1));
            
        }
        if ($uri ==="/blog") {
            return new Response(200, [], '<h1>Bienvenu sur le blog</h1>');
        }
        return new Response(404, [], '<h1>Erreur 404</h1>');
        
    }
}
