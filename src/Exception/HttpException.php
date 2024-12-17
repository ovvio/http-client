<?php

declare(strict_types=1);

namespace Ovvio\Component\Http\HttpClient\Exception;

use Ovvio\Component\Http\HttpClient\Response\Enum\ResponseStatusCode;
use Ovvio\Exceptions\BaseException;
use Ovvio\Exceptions\Exceptions;
use Throwable;

/**
 * HTTP exception
 */
class HttpException extends BaseException
{
    /**
     * @param ResponseStatusCode $statusCode HTTP response status codes
     */
    public function __construct(
        private ResponseStatusCode $statusCode = ResponseStatusCode::HTTP_INTERNAL_SERVER_ERROR,
        string $message = 'HTTP exception',
        null|int $code = Exceptions::EXCEPTION_CODE_DEFAULT,
        null|Throwable $previous = null,
    ) {
        parent::__construct(
            message: $message,
            code: $code ?? Exceptions::EXCEPTION_CODE_DEFAULT,
            previous: $previous,
        );
    }

    /**
     * Get the value of statusCode
     *
     * @return ResponseStatusCode
     */
    public function getStatusCode(): ResponseStatusCode
    {
        return $this->statusCode;
    }
}
