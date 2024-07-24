<?php

declare(strict_types=1);

namespace Ovvio\Component\HttpClient;

use Symfony\Contracts\HttpClient\HttpClientInterface as SymfonyHttpClientInterface;
use Throwable;

use function key_exists;

/**
 * Provides flexible methods for requesting HTTP resources.
 */
final class HttpClientService implements HttpClientInterface
{
    public function __construct(
        private readonly SymfonyHttpClientInterface $symfonyHttpClient,
    ) {
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

        if (Request\Enum\RequestMethodEnum::POST === $request->getMethod()) {
            $jsonData = $request->getData();
            if (null !== $jsonData) {
                $options['json'] = $jsonData;
            } else {
                $rawData = $request->getRawData();
                if (null !== $rawData) {
                    $options['body'] = $rawData;
                }
            }
        }

        // https://symfony.com/doc/current/reference/configuration/framework.html#query
        $query = $request->getQuery();
        if (null !== $query) {
            $options['query'] = $query;
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
            if (key_exists('password', $authBasic)) {
                $authBasicOption = ':' . $authBasic['password'];
            }

            $options['auth_basic'] = $authBasicOption;
        }

        try {
            $response = $this->symfonyHttpClient->request($method, $url, $options);
        } catch (Throwable $th) {
            throw new Exception\HttpException();
            // throw $th;
        }

        return Response\ResponseFactory::create(
            content: $response->getContent(),
            statusCode: Response\Enum\ResponseStatusCodeEnum::from($response->getStatusCode()),
            headers: $response->getHeaders(),
        );
    }
}
