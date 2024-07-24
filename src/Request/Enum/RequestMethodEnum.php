<?php

declare(strict_types=1);

namespace Ovvio\Component\HttpClient\Request\Enum;

use Ovvio\Component\HttpClient\Enum\EnumInterface;

/**
 * Request method
 */

enum RequestMethodEnum: string implements EnumInterface
{
    case GET = 'GET';
    case POST = 'POST';
    case PATCH = 'PATCH';
    case DEL = 'DELETE';
    case PUT = 'PUT';
}
