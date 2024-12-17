<?php

declare(strict_types=1);

namespace Ovvio\Component\Http\HttpClient\Request;

/**
 * HTTP request.
 */
interface RequestInterface
{
    /**
     * Get URL
     *
     * @return string
     */
    public function getUrl(): string;

    /**
     * Get request method
     *
     * @return Enum\RequestMethod
     */
    public function getMethod(): Enum\RequestMethod;

    /**
     * Get query
     *
     * An associative array of the query string values added to the URL before making the request.
     * This value must use the format ['parameter-name' => parameter-value, ...].
     *
     * @return null|array
     */
    public function getQuery(): null|array;

    /**
     * An associative array of the HTTP headers added before making the request.
     * This value must use the format ['header-name' => 'value0, value1, ...'].
     *
     * @return string[][]
     */
    public function getHeaders(): array;

    /**
     * Get request body
     *
     * @return null|array
     */
    public function getBody(): null|array;

    /**
     * Time, in seconds, to wait for a response. If the response takes longer, a TransportException is thrown.
     * Its default value is the same as the value of PHP's default_socket_timeout config option.
     *
     * @return null|int
     */
    public function getTimeout(): null|int;

    /**
     * The maximum execution time, in seconds, that the request and the response are allowed to take.
     * A value lower than or equal to 0 means it is unlimited.
     *
     * @return null|int
     */
    public function getConnectionTimeout(): null|int;

    /**
     * Get raw request body
     *
     * @return null|string
     */
    public function getRawBody(): null|string;

    /**
     * The path of the certificate authority file that contains one or more certificates used to verify the other
     * servers' certificates.
     *
     * @return null|string
     */
    public function getCaFile(): null|string;

    /**
     * The path to a directory that contains one or more certificate authority files.
     *
     * @return null|string
     */
    public function getCaPath(): null|string;

    /**
     * Get HTTP Basic authentication (RFC 7617)
     * The username and password used to create the Authorization HTTP header used in HTTP Basic authentication.
     * The value of this option must follow the format username:password.
     *
     * @return null|array{username:string, password?: string}
     */
    public function getAuthBasic(): null|array;

    /**
     * Is it JSON?
     *
     * @return bool
     */
    public function isJson(): bool;
}
