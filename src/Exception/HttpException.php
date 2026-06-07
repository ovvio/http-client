<?php

declare(strict_types=1);

namespace Ovvio\Component\Http\HttpClient\Exception;

use Ovvio\Component\Http\HttpClient\Response\Enum\HttpResponseStatusCodeEnum;

/**
 * HTTP exception
 */
final class HttpException extends \RuntimeException
{
    /**
     * @var HttpResponseStatusCodeEnum $statusCode HTTP response status codes
     */
    private readonly HttpResponseStatusCodeEnum $statusCode;

    public function __construct(
        /**
         * @var int|HttpResponseStatusCodeEnum $statusCode HTTP response status codes
         */
        int|HttpResponseStatusCodeEnum $statusCode = HttpResponseStatusCodeEnum::InternalServerError,
        string $message = 'HTTP exception',
        private array $headers = [],
        int $code = 0,
        ?\Throwable $previous = null,
    ) {
        if (true === $statusCode instanceof HttpResponseStatusCodeEnum) {
            $this->statusCode = $statusCode;
        } else {
            $this->statusCode = HttpResponseStatusCodeEnum::from($statusCode);
        }

        parent::__construct(
            message: $message,
            code: $code,
            previous: $previous,
        );
    }

    /**
     * Get the value of statusCode
     */
    public function getStatusCode(): HttpResponseStatusCodeEnum
    {
        return $this->statusCode;
    }

    /**
     * Get headers
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }
}
