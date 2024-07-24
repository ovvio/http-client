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
     * @var null|string $body
     */
    private null|string $body;

    /**
     * @var string[][] $headers
     */
    private array $headers;

    /**
     * @param string[][] $headers
     */
    public function __construct(
        ResponseStatusCode $statusCode,
        null|string $body = null,
        array $headers = [],
    ) {
        $this->setStatusCode($statusCode);
        $this->setBody($body);
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
     * Sets the response body.
     *
     * @return $this
     */
    final public function setBody(null|string $body): self
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @see ResponseInterface
     */
    public function getBody(): null|string
    {
        return $this->body;
    }

    /**
     * @see ResponseInterface
     */
    public function toArray(): null|array
    {
        $body = $this->getBody();

        if (null === $body) {
            return null;
        }

        $serializer = SerializerFactory::create();

        return $serializer->jsonToArray($body);
    }
}
