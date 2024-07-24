<?php

declare(strict_types=1);

namespace Ovvio\Component\HttpClient\Exception;

use Ovvio\Component\HttpClient\Response\Enum\ResponseStatusCodeEnum;
use Ovvio\Exceptions\BaseException;
use Ovvio\Exceptions\Exceptions;
use Throwable;

class HttpException extends BaseException
{
    /**
     * @param ResponseStatusCodeEnum $statusCode HTTP response status codes
     */
    public function __construct(
        private ResponseStatusCodeEnum $statusCode = ResponseStatusCodeEnum::HTTP_INTERNAL_SERVER_ERROR,
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
     * @return ResponseStatusCodeEnum
     */
    public function getStatusCode(): ResponseStatusCodeEnum
    {
        return $this->statusCode;
    }
}
