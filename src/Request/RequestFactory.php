<?php

declare(strict_types=1);

namespace Ovvio\Component\Http\HttpClient\Request;

use Ovvio\Component\Http\HttpClient\Request\Enum\RequestMethod;
use Ovvio\Component\Http\HttpClient\Response\Enum\HttpResponseStatusCodeEnum;

/**
 * HTTP request factory
 */
final class RequestFactory
{
    /**
     * Create Request
     *
     * @param \Uri\Rfc3986\Uri $url URL
     * @param Enum\RequestMethodEnum $method URL
     * @param null|string|array $body Request body
     * @param array<non-empty-string, string> $headers An associative array of the HTTP headers added before making the request.
     *                            This value must use the format ['header-name' => 'value0, value1, ...'].
     * @param null|int $timeout Time, in seconds, to wait for a response.
     * @param null|array{username:string, password?: string} $authBasic The username and password used to create the
     *                                                                  Authorization HTTP header used in
     *                                                                  HTTP Basic authentication.
     * @param null|array $query An associative array of the query string values added to the URL before making the
     *                          request. This value must use the format ['parameter-name' => parameter-value, ...].
     *
     * @param bool $isJson Is it JSON?
     *
     * @throws \Ovvio\Component\Http\HttpClient\Exception\HttpException
     */
    #[\NoDiscard]
    public static function create(
        \Uri\Rfc3986\Uri $url,
        Enum\RequestMethodEnum $method,
        string|array|null $body = null,
        ?array $query = null,
        array $headers = [],
        ?int $timeout = null,
        ?int $connectionTimeout = null,
        ?string $caFile = null,
        ?string $caPath = null,
        ?array $authBasic = null,
        bool $isJson = false,
    ): RequestInterface {
        $request = new Request(url: $url, method: $method, isJson: $isJson);

        if (true === \is_array($body)) {
            $request->setBody($body);
        } else {
            $request->setRawBody($body);
        }
        $request->setQuery($query);

        $request->setHeaders($headers);
        $request->setTimeout($timeout);
        $request->setConnectionTimeout($connectionTimeout);

        if (null !== $caFile) {
            if (false === \is_file($caFile)) {
                throw new \Ovvio\Component\Http\HttpClient\Exception\HttpException(
                    statusCode: HttpResponseStatusCodeEnum::InternalServerError,
                    message: \sprintf('"%s" it is not a file.', $caFile),
                );
            }
        }
        $request->setCaFile($caFile);

        if (null !== $caPath) {
            if (false === \is_dir($caPath)) {
                throw new \Ovvio\Component\Http\HttpClient\Exception\HttpException(
                    statusCode: HttpResponseStatusCodeEnum::InternalServerError,
                    message: \sprintf('"%s" it is not a directory.', $caPath),
                );
            }
        }
        $request->setCaPath($caPath);

        if (null !== $authBasic) {
            if (false === isset($authBasic['username'])) {
                throw new \Ovvio\Component\Http\HttpClient\Exception\HttpException(
                    statusCode: HttpResponseStatusCodeEnum::Unauthorized,
                    message: 'The required "username" parameter is missing for basic authentication'
                );
            }
        }
        $request->setAuthBasic($authBasic);

        return $request;
    }
}
