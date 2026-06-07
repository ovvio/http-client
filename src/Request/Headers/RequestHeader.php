<?php

declare(strict_types=1);

namespace Ovvio\Component\Http\HttpClient\Request\Headers;

final class RequestHeader implements RequestHeaderInterface
{
    public function __construct(
        /**
         * @var non-empty-string $name
         */
        private string $name,
        /**
         * @var string $value
         */
        private string $value,
    ) {}

    /**
     * @see RequestHeaderInterface
     */
    #[\NoDiscard]
    #[\Override]
    public function getHeaderName(): string
    {
        return $this->name;
    }

    /**
     * @see RequestHeaderInterface
     */
    #[\NoDiscard]
    #[\Override]
    public function getHeaderValue(): string
    {
        return $this->value;
    }
}
