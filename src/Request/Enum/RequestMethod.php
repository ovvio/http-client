<?php

declare(strict_types=1);

namespace Ovvio\Component\Http\HttpClient\Request\Enum;

use Ovvio\Component\Http\HttpClient\Enum\EnumInterface;

/**
 * Request method
 */
enum RequestMethod: string implements EnumInterface
{
    case GET = 'GET';
    case POST = 'POST';
    case PATCH = 'PATCH';
    case DEL = 'DELETE';
    case PUT = 'PUT';
}
