<?php
 namespace Tests\Framework;

 use Framework\App;
 use GuzzleHttp\Psr7\ServerRequest;
 use PHPUnit\Framework\TestCase;
 use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Psr7\Response;

 class AppTest extends TestCase {

    public function testRedirectTrailingSlash(){
        $app= new App();
        $request = new ServerRequest('GET','/demo/');
        $response = $app->run($request);
        $this->assertContains('/demo', $response->getHeader('Location'));
        $this->assertEquals(301, $response->getStatusCode());
    }
    public function testBlog() {
        $app = new App();
        $request = new ServerRequest('GET','/blog');
        $response = $app->run($request);
        $this->assertContains('<h1>Bienvenu sur le blog</h1>', (string)$response->getBody());
        $this->assertEquals(200, $response->getStatusCode());
    }
    public function testError404() {
        $app= new App();
        $request = new ServerRequest('GET','/aze');
        $response = $app->run($request);
        $this->assertContains('<h1>Erreur 404</h1>',(string)$response->getBody());
        $this->assertEquals(404, $response->getStatusCode());
    }
 }