<?php

declare(strict_types=1);

namespace Ovvio\Component\HttpClient\Request;

use Ovvio\Component\HttpClient\Request\Enum\RequestMethodEnum;

use function is_array;

/**
 * HTTP request factory
 */
final class RequestFactory
{
    /**
     * @param string[][] $headers
     * @param null|int $timeout
     * @param null|array{username:string, password?: string} $authBasic
     */
    public static function create(
        string $url,
        RequestMethodEnum $method,
        null|string|array $data,
        null|array $query = null,
        array $headers = [],
        null|int $timeout = null,
        null|int $connectionTimeout = null,
        null|string $caFile = null,
        null|string $caPath = null,
        null|array $authBasic = null,
    ): Request {
        $request = new Request($url, $method);

        if (is_array($data)) {
            $request->setData($data);
        } else {
            $request->setRawData($data);
        }

        $request->setQuery($query);

        $request->setHeaders($headers);
        $request->setTimeout($timeout);
        $request->setConnectionTimeout($connectionTimeout);

        $request->setCaFile($caFile);
        $request->setCaPath($caPath);
        $request->setAuthBasic($authBasic);

        return $request;
    }
}
