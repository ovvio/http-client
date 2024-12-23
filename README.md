# HTTP client

Provides powerful methods to fetch HTTP resources synchronously or asynchronously

## Technical Requirements & Installation

[PHP 8.4](https://www.php.net/releases/8.4/en.php) - [Installation and Configuration](https://www.php.net/manual/en/install.php)

[Composer (System Requirements)](https://getcomposer.org/doc/00-intro.md#system-requirements)

To install run this:

```bash
composer require ovvio/http-client
```

## Example

```php

...

use Ovvio\Component\Http\HttpClient\HttpClientInterface;
use Ovvio\Component\Http\HttpClient\Request\Enum\RequestMethod;
use Ovvio\Component\Http\HttpClient\Response\Enum\ResponseStatusCode;

...

    public function __construct(
        private readonly HttpClientInterface $httpClient,
    ) {
    }

...

    public function foo(FooDtoInterface $fooDto): void
    {

        ...

        /** @var string $url URL */
        $url = 'https://ovvio.pro';
        $requestMethod = RequestMethod::GET;

        $request = RequestFactory::create(
            url: $url,
            method: $requestMethod,
        );

        $response = $this->httpClient->request($request);
        if ($response->getStatusCode() !== ResponseStatusCode::HTTP_OK) {
            // do something
        }

        ...

    }

...

```
