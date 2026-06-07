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
    #[\NoDiscard]
    public function getStatusCode(): Enum\HttpResponseStatusCodeEnum;

    /**
     * Gets the HTTP headers of the response.
     *
     * @return string[][] The headers of the response keyed by header names in lowercase
     */
    #[\NoDiscard]
    public function getHeaders(): array;

    /**
     * Gets the response body as a string.
     */
    #[\NoDiscard]
    public function getRawBody(): ?string;

    /**
     * Gets the response body decoded as array, typically from a JSON payload.
     *
     * @return null|array<array-key, mixed>
     */
    #[\NoDiscard]
    public function getBody(): ?array;
}
