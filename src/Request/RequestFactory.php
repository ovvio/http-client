<?php

declare(strict_types=1);

namespace Ovvio\Component\Http\HttpClient\Request;

use LogicException;
use Ovvio\Component\Http\HttpClient\Request\Enum\RequestMethod;

use function is_array;

/**
 * HTTP request factory
 */
final class RequestFactory
{
    /**
     * Create Request
     *
     * @param string $url URL
     * @param RequestMethod $method URL
     * @param null|string|array $body Request body
     * @param string[][] $headers An associative array of the HTTP headers added before making the request.
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
     * @throws LogicException
     */
    public static function create(
        string $url,
        RequestMethod $method,
        null|string|array $body = null,
        null|array $query = null,
        array $headers = [],
        null|int $timeout = null,
        null|int $connectionTimeout = null,
        null|string $caFile = null,
        null|string $caPath = null,
        null|array $authBasic = null,
        bool $isJson = false,
    ): RequestInterface {
        $request = new Request(url: $url, method: $method, isJson: $isJson);

        if (is_array($body)) {
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
                throw new LogicException('"' . $caFile . '" it is not a file.', 0);
            }
        }
        $request->setCaFile($caFile);

        if (null !== $caPath) {
            if (false === \is_dir($caPath)) {
                throw new LogicException('"' . $caPath . '" it is not a directory.', 0);
            }
        }
        $request->setCaPath($caPath);

        if (null !== $authBasic) {
            if (false === isset($authBasic['username'])) {
                throw new LogicException(
                    'The required "username" parameter is missing for  basic authentication',
                    0
                );
            }
        }
        $request->setAuthBasic($authBasic);

        return $request;
    }
}
