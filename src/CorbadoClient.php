<?php

namespace Corbado;

use GuzzleHttp\Psr7\Response;

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

    public function handle_webhook(?\Psr\Http\Message\RequestInterface $request, bool $exit = true)
    {
        $verified = $this->verify_webhook($request);

        if ($verified) {
            
        } else {
            if ($request) {
                return new Response(401, [
                    'WWW-Authentication' => 'Basic realm="Webhook"'
                ], 'Unauthorized');
            }
    
            header('WWW-Authenticate: Basic realm="Webhook"');
            header('HTTP/1.0 401 Unauthorized');
            echo 'Unauthorized.';
    
            if ($exit) {
                exit(0);
            }
        }
    }


}