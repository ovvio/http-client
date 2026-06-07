<?php

declare(strict_types=1);

namespace Ovvio\Component\Http\HttpClient\Response;

/**
 * HTTP response
 */
final class Response implements ResponseInterface
{
    /**
     * @param string[][] $headers
     */
    public function __construct(
        /**
         * @var Enum\HttpResponseStatusCodeEnum $statusCode HTTP response status code
         */
        private Enum\HttpResponseStatusCodeEnum $statusCode,

        /**
         * @var null|string $rawBody
         */
        private ?string $rawBody,

        /**
         * @var string[][] $headers
         */
        private array $headers,

        /**
         * @var null|array<array-key, mixed> $body
         */
        private ?array $body = null,
    ) {}

    /**
     * Sets the response status code.
     */
    public function setStatusCode(Enum\HttpResponseStatusCodeEnum $statusCode): self
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * @see ResponseInterface
     */
    #[\Override]
    #[\NoDiscard]
    public function getStatusCode(): Enum\HttpResponseStatusCodeEnum
    {
        return $this->statusCode;
    }

    /**
     * @see ResponseInterface
     */
    #[\Override]
    #[\NoDiscard]
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * Sets the response rawBody.
     */
    final public function setRawBody(?string $rawBody): self
    {
        $this->rawBody = $rawBody;

        return $this;
    }

    /**
     * @see ResponseInterface
     */
    #[\Override]
    #[\NoDiscard]
    public function getRawBody(): ?string
    {
        return $this->rawBody;
    }

    /**
     * Sets the response body.
     */
    final public function setBody(?array $body): self
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @see ResponseInterface
     */
    #[\Override]
    #[\NoDiscard]
    public function getBody(): ?array
    {
        return $this->body;
    }
}
