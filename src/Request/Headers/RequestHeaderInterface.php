<?php

declare(strict_types=1);

namespace Ovvio\Component\Http\HttpClient\Request\Headers;

interface RequestHeaderInterface
{
    /**
     * Get header name.
     *
     * @return non-empty-string
     */
    #[\NoDiscard]
    public function getHeaderName(): string;

    /**
     * Get header value.
     *
     * @return string
     */
    #[\NoDiscard]
    public function getHeaderValue(): string;
}
