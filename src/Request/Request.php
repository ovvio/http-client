<?php

declare(strict_types=1);

namespace Ovvio\Component\Http\HttpClient\Request;

use Ovvio\Component\Http\HttpClient\Request\Enum\RequestMethodEnum;

/**
 * HTTP request
 */
final class Request implements RequestInterface
{
    /**
     * @var null|array $data
     */
    private null|array $data = null;

    /**
     * @var null|array $query
     */
    private null|array $query = null;

    /**
     * @var string[][] $headers
     */
    private array $headers = [];

    /**
     * @var null|int $timeout
     */
    private null|int $timeout = null;

    /**
     * @var null|int $connectionTimeout
     */
    private null|int $connectionTimeout = null;


    /**
     * @var null|string $rawData
     */
    private null|string $rawData = null;

    /**
     * @var null|string $caFile
     */
    private null|string $caFile = null;

    /**
     * @var null|string $caPath
     */
    private null|string $caPath = null;

    /**
     * @var null|array{username:string, password?: string} $authBasic
     */
    private null|array $authBasic = null;

    public function __construct(
        private readonly string $url,
        private readonly RequestMethodEnum $method = RequestMethodEnum::GET,
    ) {
    }

    /**
     * @see RequestInterface
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @see RequestInterface
     */
    public function getMethod(): RequestMethodEnum
    {
        return $this->method;
    }

    /**
     * @param null|array $data
     *
     * @return $this
     */
    public function setData(null|array $data): self
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @see RequestInterface
     */
    public function getData(): null|array
    {
        return $this->data;
    }

    /**
     * @param null|array $query
     *
     * @return $this
     */
    public function setQuery(null|array $query): self
    {
        $this->query = $query;

        return $this;
    }

    /**
     * @see RequestInterface
     */
    public function getQuery(): null|array
    {
        return $this->query;
    }

    /**
     * @param null|string[][] $headers
     *
     * @return $this
     */
    public function setHeaders(null|array $headers): self
    {
        $this->headers = $headers ?? [];

        return $this;
    }

    /**
     * @see RequestInterface
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param null|int $timeout
     *
     * @return $this
     */
    public function setTimeout(null|int $timeout): self
    {
        $this->timeout = $timeout;

        return $this;
    }

    /**
     * @see RequestInterface
     */
    public function getTimeout(): null|int
    {
        return $this->timeout;
    }

    /**
     * @param null|int $connectionTimeout
     *
     * @return $this
     */
    public function setConnectionTimeout(null|int $connectionTimeout): self
    {
        $this->connectionTimeout = $connectionTimeout;

        return $this;
    }

    /**
     * @see RequestInterface
     */
    public function getConnectionTimeout(): null|int
    {
        return $this->connectionTimeout;
    }

    /**
     * @param null|string $rawData
     *
     * @return $this
     */
    public function setRawData(null|string $rawData): self
    {
        $this->rawData = $rawData;

        return $this;
    }

    /**
     * @see RequestInterface
     */
    public function getRawData(): null|string
    {
        return $this->rawData;
    }

    /**
     * @param null|string $caFile
     *
     * @return $this
     */
    public function setCaFile(null|string $caFile): self
    {
        $this->caFile = $caFile;

        return $this;
    }

    /**
     * @see RequestInterface
     */
    public function getCaFile(): null|string
    {
        return $this->caFile;
    }

    /**
     * @param null|string $caFile
     *
     * @return $this
     */
    public function setCaPath(null|string $caPath): self
    {
        $this->caPath = $caPath;

        return $this;
    }

    /**
     * @see RequestInterface
     */
    public function getCaPath(): null|string
    {
        return $this->caPath;
    }

    /**
     * @param null|array{username:string, password?: string} $authBasic
     *
     * @return $this
     */
    public function setAuthBasic(null|array $authBasic): self
    {
        $this->authBasic = $authBasic;

        return $this;
    }

    /**
     * @see RequestInterface
     */
    public function getAuthBasic(): null|array
    {
        return $this->authBasic;
    }
}
