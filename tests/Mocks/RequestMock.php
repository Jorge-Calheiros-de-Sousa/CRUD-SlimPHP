<?php

namespace Tests\Mocks;

use Psr\Http\Message\StreamInterface;
use Slim\Psr7\Environment;
use Slim\Psr7\Headers;
use Slim\Psr7\Interfaces\HeadersInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Stream;
use Slim\Psr7\Uri;

/**
 * @see https://discourse.slimframework.com/t/mock-slim-endpoint-post-requests-with-phpunit/973/8
 * @see https://schibsted.com/blog/unit-testing-with-streams-in-php/
 */
class RequestMock
{
    private string $method;
    private Uri $uri;
    private HeadersInterface $headers;
    private array $serverParams;
    private StreamInterface $body;
    private $file;

    public function __construct(string $method = '', string $link = '', string $fixtureFile)
    {
        $env = Environment::mock();
        $this->file = fopen($fixtureFile, 'r+');

        $this->method = $method;
        $this->uri = new Uri('http', $link);
        $this->headers = new Headers([]);
        $this->serverParams = $env;
        $this->body = new Stream($this->file);
    }

    public function getInstance()
    {
        $request = new Request(
            $this->method,
            $this->uri,
            $this->headers,
            [],
            $this->serverParams,
            $this->body,
            []
        );

        return $request->withParsedBody((array) json_decode(stream_get_contents($this->file)));
    }
}