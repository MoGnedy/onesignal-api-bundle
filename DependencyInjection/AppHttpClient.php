<?php

namespace App\Bundle\OneSignalNotificationsBundle\DependencyInjection;

use GuzzleHttp\Client as GuzzleClient;
use Http\Adapter\Guzzle6\Client as GuzzleAdapter;
use Http\Message\MessageFactory\GuzzleMessageFactory;
use Http\Client\Common\HttpMethodsClient;
use Http\Client\Exception;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;


class AppHttpClient extends HttpMethodsClient
{


    private $httpClient;

    private $requestFactory;

    public function __construct(GuzzleAdapter $httpClient = null, GuzzleMessageFactory $requestFactory = null)
    {
        if (!($httpClient instanceof GuzzleAdapter)) :
            $guzzle = new GuzzleClient([]);
            $this->httpClient = new GuzzleAdapter($guzzle);
        endif;
        if (!($requestFactory instanceof GuzzleMessageFactory)) :
            $this->requestFactory = new GuzzleMessageFactory();
        endif;
    }


    /**
     * Sends a GET request.
     *
     * @param string|UriInterface $uri
     * @param array               $headers
     *
     * @throws Exception
     *
     * @return ResponseInterface
     */
    public function get($uri, array $headers = [])
    {
        return $this->send('GET', $uri, $headers, null);
    }

    /**
     * Sends an HEAD request.
     *
     * @param string|UriInterface $uri
     * @param array               $headers
     *
     * @throws Exception
     *
     * @return ResponseInterface
     */
    public function head($uri, array $headers = [])
    {
        return $this->send('HEAD', $uri, $headers, null);
    }

    /**
     * Sends a TRACE request.
     *
     * @param string|UriInterface $uri
     * @param array               $headers
     *
     * @throws Exception
     *
     * @return ResponseInterface
     */
    public function trace($uri, array $headers = [])
    {
        return $this->send('TRACE', $uri, $headers, null);
    }

    /**
     * Sends a POST request.
     *
     * @param string|UriInterface         $uri
     * @param array                       $headers
     * @param string|StreamInterface|null $body
     *
     * @throws Exception
     *
     * @return ResponseInterface
     */
    public function post($uri, array $headers = [], $body = null)
    {
        return $this->send('POST', $uri, $headers, $body);
    }

    /**
     * Sends a PUT request.
     *
     * @param string|UriInterface         $uri
     * @param array                       $headers
     * @param string|StreamInterface|null $body
     *
     * @throws Exception
     *
     * @return ResponseInterface
     */
    public function put($uri, array $headers = [], $body = null)
    {
        return $this->send('PUT', $uri, $headers, $body);
    }

    /**
     * Sends a PATCH request.
     *
     * @param string|UriInterface         $uri
     * @param array                       $headers
     * @param string|StreamInterface|null $body
     *
     * @throws Exception
     *
     * @return ResponseInterface
     */
    public function patch($uri, array $headers = [], $body = null)
    {
        return $this->send('PATCH', $uri, $headers, $body);
    }

    /**
     * Sends a DELETE request.
     *
     * @param string|UriInterface         $uri
     * @param array                       $headers
     * @param string|StreamInterface|null $body
     *
     * @throws Exception
     *
     * @return ResponseInterface
     */
    public function delete($uri, array $headers = [], $body = null)
    {
        return $this->send('DELETE', $uri, $headers, $body);
    }

    /**
     * Sends an OPTIONS request.
     *
     * @param string|UriInterface         $uri
     * @param array                       $headers
     * @param string|StreamInterface|null $body
     *
     * @throws Exception
     *
     * @return ResponseInterface
     */
    public function options($uri, array $headers = [], $body = null)
    {
        return $this->send('OPTIONS', $uri, $headers, $body);
    }

    /**
     * Sends a request with any HTTP method.
     *
     * @param string                      $method  HTTP method to use
     * @param string|UriInterface         $uri
     * @param array                       $headers
     * @param string|StreamInterface|null $body
     *
     * @throws Exception
     *
     * @return ResponseInterface
     */
    public function send($method, $uri, array $headers = [], $body = null)
    {
        return $this->sendRequest($this->requestFactory->createRequest(
            $method,
            $uri,
            $headers,
            $body
        ));
    }

    /**
     * Forward to the underlying HttpClient.
     *
     * {@inheritdoc}
     */
    public function sendRequest(RequestInterface $request)
    {
        return $this->httpClient->sendRequest($request);
    }
}
