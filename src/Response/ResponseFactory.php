<?php

declare(strict_types=1);

namespace Ovvio\Component\Http\HttpClient\Response;

use Ovvio\Component\Http\HttpClient\Response\Enum\ResponseStatusCode;

/**
 * HTTP response factory
 */
final class ResponseFactory
{
    /**
     * @param string[][] $headers
     */
    public static function create(
        Enum\ResponseStatusCode $statusCode = ResponseStatusCode::HTTP_OK,
        null|string $body = null,
        array $headers = [],
    ): ResponseInterface {
        return new Response(statusCode: $statusCode, body: $body, headers: $headers);
    }
}
