<?php

declare(strict_types=1);

namespace Ovvio\Component\Http\HttpClient;

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
    #[\Override]
    public function request(Request\RequestInterface $request): Response\ResponseInterface
    {
        $url = $request->getUrl();
        $method = $request->getMethod()->value;
        $headers = $request->getHeaders();

        $options = [];
        $options['headers'] = $headers;

        // FIXME: Read https://symfony.com/doc/current/http_client.html#https-certificates
        /** @see https://symfony.com/doc/current/reference/configuration/framework.html#verify-host */
        $options['verify_host'] = false;
        /** @see https://symfony.com/doc/current/reference/configuration/framework.html#verify-peer */
        $options['verify_peer'] = false;

        /** @see https://symfony.com/doc/current/reference/configuration/framework.html#query */
        if (null !== $query = $request->getQuery()) {
            $options['query'] = $query;
        }

        if (null !== $body = $request->getBody()) {
            if (true === $request->isJson()) {
                $options['json'] = $body;
            } else {
                $options['body'] = $body;
            }
        } elseif (null !== $rawBody = $request->getRawBody()) {
            $options['body'] = $rawBody;
        }

        /** @see https://symfony.com/doc/current/http_client.html#headers */
        $headers = $request->getHeaders();
        if (true !== empty($headers)) {
            $options['headers'] = $headers;
        }

        /** @see https://symfony.com/doc/current/reference/configuration/framework.html#timeout */
        if (null !== $timeout = $request->getTimeout()) {
            $options['timeout'] = $timeout;
        }

        /** @see https://symfony.com/doc/current/reference/configuration/framework.html#max-duration */
        if (null !== $connectionTimeout = $request->getConnectionTimeout()) {
            $options['max_duration'] = $connectionTimeout;
        }

        /** @see https://symfony.com/doc/current/reference/configuration/framework.html#cafile */
        if (null !== $caFile = $request->getCaFile()) {
            $options['cafile'] = $caFile;
        }

        /** @see https://symfony.com/doc/current/reference/configuration/framework.html#capath */
        if (null !== $caPath = $request->getCaPath()) {
            $options['capath'] = $caPath;
        }

        /** @see https://symfony.com/doc/current/reference/configuration/framework.html#auth-basic */
        if (null !== $authBasic = $request->getAuthBasic()) {
            $authBasicOption = $authBasic['username'];
            if (true === isset($authBasic['password'])) {
                $authBasicOption = ':' . $authBasic['password'];
            }

            $options['auth_basic'] = $authBasicOption;
        }

        try {
            $response = $this->symfonyHttpClient->request($method, $url->toRawString(), $options);
            $responseStatusCode = Response\Enum\HttpResponseStatusCodeEnum::from($response->getStatusCode());
            $responseHeaders = $response->getHeaders(false);
            if (true === empty($responseRawBody = $response->getContent(false))) {
                $responseRawBody = null;
            };
            if (true === empty($responseBody = $response->toArray(false))) {
                $responseBody = null;
            };
        } catch (\Throwable $th) {
            throw new Exception\HttpException(
                statusCode: $responseStatusCode ?? Response\Enum\HttpResponseStatusCodeEnum::InternalServerError,
                message: $th->getMessage(),
                headers: $responseHeaders ?? [],
                code: (int) $th->getCode(),
                previous: $th->getPrevious()
            );
        }

        return Response\ResponseFactory::create(
            statusCode: $responseStatusCode,
            rawBody: $responseRawBody,
            headers: $responseHeaders,
            body: $responseBody,
        );
    }
}
