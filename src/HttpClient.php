<?php

declare(strict_types=1);

namespace Ovvio\Component\Http\HttpClient;

use Throwable;

/**
 * Provides flexible methods for requesting HTTP resources.
 */
final class HttpClient implements HttpClientInterface
{
    private \Symfony\Contracts\HttpClient\HttpClientInterface $symfonyHttpClient;

    public function __construct()
    {
        $this->symfonyHttpClient = \Symfony\Component\HttpClient\HttpClient::create();
    }

    /**
     * @see HttpClientInterface
     */
    public function request(Request\RequestInterface $request): Response\ResponseInterface
    {
        $url = $request->getUrl();
        $method = $request->getMethod()->value;

        $options = [];

        // FIXME: Read https://symfony.com/doc/current/http_client.html#https-certificates
        // https://symfony.com/doc/current/reference/configuration/framework.html#verify-host
        $options['verify_host'] = false;
        // https://symfony.com/doc/current/reference/configuration/framework.html#verify-peer
        $options['verify_peer'] = false;

        // https://symfony.com/doc/current/reference/configuration/framework.html#query
        $query = $request->getQuery();
        if (null !== $query) {
            $options['query'] = $query;
        }

        if (Request\Enum\RequestMethod::POST === $request->getMethod()) {
            $body = $request->getBody();
            if (null !== $body) {
                if (true === $request->isJson()) {
                    $options['json'] = $body;
                } else {
                    $options['body'] = $body;
                }
            } else {
                $rawBody = $request->getRawBody();
                if (null !== $rawBody) {
                    $options['body'] = $rawBody;
                }
            }
        }

        // https://symfony.com/doc/current/http_client.html#headers
        $headers = $request->getHeaders();
        if (null !== $headers) {
            $options['headers'] = $headers;
        }

        // https://symfony.com/doc/current/reference/configuration/framework.html#timeout
        $timeout = $request->getTimeout();
        if (null !== $timeout) {
            $options['timeout'] = $timeout;
        }

        // https://symfony.com/doc/current/reference/configuration/framework.html#max-duration
        $connectionTimeout = $request->getConnectionTimeout();
        if (null !== $connectionTimeout) {
            $options['max_duration'] = $connectionTimeout;
        }

        // https://symfony.com/doc/current/reference/configuration/framework.html#cafile
        $caFile = $request->getCaFile();
        if (null !== $caFile) {
            $options['cafile'] = $caFile;
        }

        // https://symfony.com/doc/current/reference/configuration/framework.html#capath
        $caPath = $request->getCaPath();
        if (null !== $caPath) {
            $options['capath'] = $caPath;
        }

        // https://symfony.com/doc/current/reference/configuration/framework.html#auth-basic
        $authBasic = $request->getAuthBasic();
        if (null !== $authBasic) {
            $authBasicOption = $authBasic['username'];
            if (true === isset($authBasic['password'])) {
                $authBasicOption = ':' . $authBasic['password'];
            }

            $options['auth_basic'] = $authBasicOption;
        }

        try {
            $response = $this->symfonyHttpClient->request($method, $url, $options);
        } catch (Throwable $th) {
            throw new Exception\HttpException(message: $th->getMessage());
            // throw $th;
        }

        return Response\ResponseFactory::create(
            content: $response->getContent(),
            statusCode: Response\Enum\ResponseStatusCode::from($response->getStatusCode()),
            headers: $response->getHeaders(),
        );
    }
}
