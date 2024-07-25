<?php

declare(strict_types=1);

namespace Ovvio\Component\Http\HttpClient\Response;

/**
 * HTTP response.
 */
interface ResponseInterface
{
    /**
     * Gets the HTTP status code of the response.
     */
    public function getStatusCode(): Enum\ResponseStatusCodeEnum;

    /**
     * Gets the HTTP headers of the response.
     *
     * @return string[][] The headers of the response keyed by header names in lowercase
     */
    public function getHeaders(): array;

    /**
     * Gets the response body as a string.
     */
    public function getContent(): string;

    /**
     * Gets the response body decoded as array, typically from a JSON payload.
     *
     * @return null|array<array-key, mixed>
     */
    public function toArray(): null|array;
}
