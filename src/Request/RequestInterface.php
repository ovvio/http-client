<?php

declare(strict_types=1);

namespace Ovvio\Component\HttpClient\Request;

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
     * @return Enum\RequestMethodEnum
     */
    public function getMethod(): Enum\RequestMethodEnum;

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
     * Get headers
     *
     * @return string[][]
     */
    public function getHeaders(): array;

    /**
     * Get data
     *
     * @return null|array
     */
    public function getData(): null|array;


    /**
     * Get timeout
     *
     * @return null|int
     */
    public function getTimeout(): null|int;

    /**
     * Get connection timeout
     *
     * @return null|int
     */
    public function getConnectionTimeout(): null|int;

    /**
     * Get raw data
     *
     * @return null|string
     */
    public function getRawData(): null|string;

    /**
     * Get CA file
     *
     * @return null|string
     */
    public function getCaFile(): null|string;

    /**
     * Get CA path
     *
     * @return null|string
     */
    public function getCaPath(): null|string;

    /**
     * Get HTTP Basic authentication (RFC 7617)
     *
     * @return null|array{username:string, password?: string}
     */
    public function getAuthBasic(): null|array;
}
