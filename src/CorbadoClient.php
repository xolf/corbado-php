<?php

namespace Corbado;

class CorbadoClient
{

    public function __construct(protected string $api_secret, protected ?string $webhook_user, protected ?string $webhook_password)
    {

    }

    public function verify_webhook(?\Psr\Http\Message\RequestInterface $request): bool
    {
        if ($request) {
            return $request->getHeader('Authorization') === 'Basic '.base64_decode($this->webhook_user.':'.$this->webhook_password);
        }

        return ($_SERVER['PHP_AUTH_USER'] ?? null) === $this->webhook_user && ($_SERVER['PHP_AUTH_PW'] ?? null) ===  $this->webhook_password;
    }


}