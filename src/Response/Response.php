<?php

declare(strict_types=1);

namespace Ovvio\Component\HttpClient\Response;

use Ovvio\Component\HttpClient\Response\Enum\ResponseStatusCodeEnum;
use Ovvio\Component\Serializer\SerializerFactory;

/**
 * HTTP response
 */
final class Response implements ResponseInterface
{
    /**
     * @var ResponseStatusCodeEnum $statusCode
     */
    private ResponseStatusCodeEnum $statusCode;

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
        ResponseStatusCodeEnum $statusCode = ResponseStatusCodeEnum::HTTP_OK,
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
    public function setStatusCode(ResponseStatusCodeEnum $statusCode): self
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * @see ResponseInterface
     */
    public function getStatusCode(): ResponseStatusCodeEnum
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
