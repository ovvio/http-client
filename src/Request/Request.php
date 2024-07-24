<?php

declare(strict_types=1);

namespace Ovvio\Component\Http\HttpClient\Request;

use Ovvio\Component\Http\HttpClient\Request\Enum\RequestMethod;

/**
 * HTTP request
 */
final class Request implements RequestInterface
{
    /**
     * Request body
     *
     * @var null|array $body
     */
    private null|array $body = null;

    /**
     * An associative array of the query string values added to the URL before making the request.
     * This value must use the format ['parameter-name' => parameter-value, ...].
     *
     * @var null|array $query
     */
    private null|array $query = null;

    /**
     * An associative array of the HTTP headers added before making the request.
     * This value must use the format ['header-name' => 'value0, value1, ...'].
     *
     * @var string[][] $headers
     */
    private array $headers = [];

    /**
     * Time, in seconds, to wait for a response. If the response takes longer, a TransportException is thrown.
     * Its default value is the same as the value of PHP's default_socket_timeout config option.
     *
     * @var null|int $timeout
     */
    private null|int $timeout = null;

    /**
     * @var null|int $connectionTimeout
     */
    private null|int $connectionTimeout = null;

    /**
     * Raw body
     *
     * @var null|string $rawBody
     */
    private null|string $rawBody = null;

    /**
     * The path of the certificate authority file that contains one or more certificates used to verify the other
     * servers' certificates.
     *
     * @var null|string $caFile
     */
    private null|string $caFile = null;

    /**
     * The path to a directory that contains one or more certificate authority files.
     *
     * @var null|string $caPath
     */
    private null|string $caPath = null;

    /**
     * @var null|array{username:string, password?: string} $authBasic
     */
    private null|array $authBasic = null;

    /**
     * @var bool $isJson Is it JSON?
     */
    private bool $isJson;

    /**
     * @param string $url URL
     * @param bool $isJson Is it JSON?
     */
    public function __construct(
        private readonly string $url,
        private readonly RequestMethod $method = RequestMethod::GET,
        bool $isJson = false,
    ) {
        $this->isJson = $isJson;
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
    public function getMethod(): RequestMethod
    {
        return $this->method;
    }

    /**
     * Request body
     *
     * @param null|array $body
     *
     * @return $this
     */
    public function setBody(null|array $body): self
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @see RequestInterface
     */
    public function getBody(): null|array
    {
        return $this->body;
    }

    /**
     * An associative array of the query string values added to the URL before making the request.
     * This value must use the format ['parameter-name' => parameter-value, ...].
     *
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
     * An associative array of the HTTP headers added before making the request.
     * This value must use the format ['header-name' => 'value0, value1, ...'].
     *
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
     * Time, in seconds, to wait for a response. If the response takes longer, a TransportException is thrown.
     * Its default value is the same as the value of PHP's default_socket_timeout config option.
     *
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
     * The maximum execution time, in seconds, that the request and the response are allowed to take.
     * A value lower than or equal to 0 means it is unlimited.
     *
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
     * Raw request body
     *
     * @param null|string $rawBody
     *
     * @return $this
     */
    public function setRawBody(null|string $rawBody): self
    {
        $this->rawBody = $rawBody;

        return $this;
    }

    /**
     * @see RequestInterface
     */
    public function getRawBody(): null|string
    {
        return $this->rawBody;
    }

    /**
     * The path of the certificate authority file that contains one or more certificates used to verify the other
     * servers' certificates.
     *
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
     * The path to a directory that contains one or more certificate authority files.
     *
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
     * The username and password used to create the Authorization HTTP header used in HTTP Basic authentication.
     * The value of this option must follow the format username:password.
     *
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

    /**
     * @see RequestInterface
     */
    public function isJson(): bool
    {
        return $this->isJson;
    }
}
