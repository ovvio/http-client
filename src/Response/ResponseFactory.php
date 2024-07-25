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
    public static function create(
        null|string $content,
        Enum\ResponseStatusCodeEnum $statusCode,
        array $headers,
    ): Response {
        return new Response($content, $statusCode, $headers);
    }
}
