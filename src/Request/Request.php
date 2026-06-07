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
     * Request body
     *
     * @var null|array $body
     */
    private ?array $body = null;

    /**
     * An associative array of the query string values added to the URL before making the request.
     * This value must use the format ['parameter-name' => parameter-value, ...].
     *
     * @var null|array $query
     */
    private ?array $query = null;

    /**
     * An associative array of the HTTP headers added before making the request.
     * This value must use the format ['header-name' => 'value0, value1, ...'].
     *
     * @var array<non-empty-string, string> $headers
     */
    private array $headers = [];

    /**
     * Time, in seconds, to wait for a response. If the response takes longer, a TransportException is thrown.
     * Its default value is the same as the value of PHP's default_socket_timeout config option.
     *
     * @var null|int $timeout
     */
    private ?int $timeout = null;

    /**
     * @var null|int $connectionTimeout Connection timeout
     */
    private ?int $connectionTimeout = null;

    /**
     * Raw body
     *
     * @var null|string $rawBody Raw body
     */
    private ?string $rawBody = null;

    /**
     * The path of the certificate authority file that contains one or more certificates used to verify the other
     * servers' certificates.
     *
     * @var null|string $caFile
     */
    private ?string $caFile = null;

    /**
     * @var null|string $caPath The path to a directory that contains one or more certificate authority files.
     */
    private ?string $caPath = null;

    /**
     * @var null|array{username:string, password?: string} $authBasic HTTP Basic Authentication
     */
    private ?array $authBasic = null;

    public function __construct(
        /**
         * @var \Uri\Rfc3986\Uri $url URL
         */
        private readonly \Uri\Rfc3986\Uri $url,

        /**
         * @var RequestMethodEnum $method Request method
         */
        private readonly RequestMethodEnum $method = RequestMethodEnum::GET,

        /**
         * @var bool $isJson Is it JSON?
         */
        private bool $isJson = false,
    ) {}

    /**
     * @see RequestInterface
     */
    #[\Override]
    public function getUrl(): \Uri\Rfc3986\Uri
    {
        return $this->url;
    }

    /**
     * @see RequestInterface
     */
    #[\Override]
    public function getMethod(): RequestMethodEnum
    {
        return $this->method;
    }

    /**
     * Request body
     *
     * @param null|array $body
     */
    public function setBody(?array $body): self
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @see RequestInterface
     */
    #[\Override]
    public function getBody(): ?array
    {
        return $this->body;
    }

    /**
     * An associative array of the query string values added to the URL before making the request.
     * This value must use the format ['parameter-name' => parameter-value, ...].
     *
     * @param null|array $query
     */
    public function setQuery(?array $query): self
    {
        $this->query = $query;

        return $this;
    }

    /**
     * @see RequestInterface
     */
    #[\Override]
    public function getQuery(): ?array
    {
        return $this->query;
    }

    /**
     * An associative array of the HTTP headers added before making the request.
     * This value must use the format ['header-name' => 'value0, value1, ...'].
     *
     * @param null|array<non-empty-string, string> $headers
     */
    public function setHeaders(?array $headers): self
    {
        $this->headers = $headers ?? [];

        return $this;
    }

    /**
     * @param Headers\RequestHeaderInterface $header
     */
    public function addHeader(Headers\RequestHeaderInterface $header): self
    {
        $this->headers[$header->getHeaderName()] = $header->getHeaderValue();

        return $this;
    }

    /**
     * @see RequestInterface
     */
    #[\Override]
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * Time, in seconds, to wait for a response. If the response takes longer, a TransportException is thrown.
     * Its default value is the same as the value of PHP's default_socket_timeout config option.
     *
     * @param null|int $timeout
     */
    public function setTimeout(?int $timeout): self
    {
        $this->timeout = $timeout;

        return $this;
    }

    /**
     * @see RequestInterface
     */
    #[\Override]
    public function getTimeout(): ?int
    {
        return $this->timeout;
    }

    /**
     * The maximum execution time, in seconds, that the request and the response are allowed to take.
     * A value lower than or equal to 0 means it is unlimited.
     *
     * @param null|int $connectionTimeout
     */
    public function setConnectionTimeout(?int $connectionTimeout): self
    {
        $this->connectionTimeout = $connectionTimeout;

        return $this;
    }

    /**
     * @see RequestInterface
     */
    #[\Override]
    public function getConnectionTimeout(): ?int
    {
        return $this->connectionTimeout;
    }

    /**
     * Raw request body
     *
     * @param null|string $rawBody
     */
    public function setRawBody(?string $rawBody): self
    {
        $this->rawBody = $rawBody;

        return $this;
    }

    /**
     * @see RequestInterface
     */
    #[\Override]
    public function getRawBody(): ?string
    {
        return $this->rawBody;
    }

    /**
     * The path of the certificate authority file that contains one or more certificates used to verify the other
     * servers' certificates.
     *
     * @param null|string $caFile
     */
    public function setCaFile(?string $caFile): self
    {
        $this->caFile = $caFile;

        return $this;
    }

    /**
     * @see RequestInterface
     */
    #[\Override]
    public function getCaFile(): ?string
    {
        return $this->caFile;
    }

    /**
     * @param null|string $caPath The path to a directory that contains one or more certificate authority files.
     */
    public function setCaPath(?string $caPath): self
    {
        $this->caPath = $caPath;

        return $this;
    }

    /**
     * @see RequestInterface
     */
    #[\Override]
    public function getCaPath(): ?string
    {
        return $this->caPath;
    }

    /**
     * The username and password used to create the Authorization HTTP header used in HTTP Basic authentication.
     * The value of this option must follow the format username:password.
     *
     * @param null|array{username:string, password?: string} $authBasic
     */
    public function setAuthBasic(?array $authBasic): self
    {
        $this->authBasic = $authBasic;

        return $this;
    }

    /**
     * @see RequestInterface
     */
    #[\Override]
    public function getAuthBasic(): ?array
    {
        return $this->authBasic;
    }

    /**
     * @see RequestInterface
     */
    #[\Override]
    public function isJson(): bool
    {
        return $this->isJson;
    }
}
