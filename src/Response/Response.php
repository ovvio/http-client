<?php

declare(strict_types=1);

namespace Ovvio\Component\Http\HttpClient\Response;

use Ovvio\Component\Http\HttpClient\Response\Enum\ResponseStatusCode;
use Ovvio\Component\Serializer\SerializerFactory;

/**
 * HTTP response
 */
final class Response implements ResponseInterface
{
    /**
     * @var ResponseStatusCode $statusCode
     */
    private ResponseStatusCode $statusCode;

    /**
     * @var string $content
     */
    private string $content;

    /**
     * @var string[][] $headers
     */
    private array $headers;

    /**
     * @param string[][] $headers
     */
    public function __construct(
        null|string $content = '',
        ResponseStatusCode $statusCode = ResponseStatusCode::HTTP_OK,
        array $headers = [],
    ) {
        $this->setContent($content);
        $this->setStatusCode($statusCode);
        $this->headers = $headers;
    }

    /**
     * Sets the response status code.
     *
     * @return $this
     */
    public function setStatusCode(ResponseStatusCode $statusCode): self
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * @see ResponseInterface
     */
    public function getStatusCode(): ResponseStatusCode
    {
        return $this->statusCode;
    }

    /**
     * @see ResponseInterface
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * Sets the response content.
     *
     * @return $this
     */
    public function setContent(null|string $content): static
    {
        $this->content = $content ?? '';

        return $this;
    }

    /**
     * @see ResponseInterface
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @see ResponseInterface
     */
    public function toArray(): null|array
    {
        $serializer = SerializerFactory::create();

        return $serializer->jsonToArray($this->content);
    }
}
