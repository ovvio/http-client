<?php

declare(strict_types=1);

namespace Ovvio\Component\Http\HttpClient\Request\Headers;

final class AuthorizationRequestHeader implements RequestHeaderInterface
{
    public function __construct(
        private string $value,
        private string $tokenType = 'Bearer ',
    ) {}

    /**
     * @see RequestHeaderInterface
     */
    #[\NoDiscard]
    #[\Override]
    public function getHeaderName(): string
    {
        return 'Authorization';
    }

    /**
     * @see RequestHeaderInterface
     */
    #[\NoDiscard]
    #[\Override]
    public function getHeaderValue(): string
    {
        return $this->tokenType . $this->value;
    }
}
