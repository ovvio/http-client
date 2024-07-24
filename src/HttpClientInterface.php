<?php

declare(strict_types=1);

namespace Ovvio\Component\HttpClient;

interface HttpClientInterface
{
    /**
     * Requests an HTTP resource.
     *
     * @throws Exception\HttpException
     */
    public function request(Request\RequestInterface $request): Response\ResponseInterface;
}