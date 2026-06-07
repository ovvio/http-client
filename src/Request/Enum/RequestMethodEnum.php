<?php

declare(strict_types=1);

namespace Ovvio\Component\Http\HttpClient\Request\Enum;

/**
 * Request method
 */
enum RequestMethodEnum: string
{
    case GET = 'GET';
    case POST = 'POST';
    case PATCH = 'PATCH';
    case DEL = 'DELETE';
    case PUT = 'PUT';
}
