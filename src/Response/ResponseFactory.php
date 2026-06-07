<?php

declare(strict_types=1);

namespace Ovvio\Component\Http\HttpClient\Response;

/**
 * HTTP response factory
 */
final class ResponseFactory
{
    /**
     * @param string[][] $headers
     */
    #[\NoDiscard]
    public static function create(
        Enum\HttpResponseStatusCodeEnum $statusCode = Enum\HttpResponseStatusCodeEnum::OK,
        ?string $rawBody = null,
        array $headers = [],
        ?array $body = null,
    ): ResponseInterface {
        return new Response(statusCode: $statusCode, rawBody: $rawBody, headers: $headers, body: $body);
    }
}
