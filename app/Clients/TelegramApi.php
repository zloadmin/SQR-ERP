<?php
declare(strict_types=1);


namespace App\Clients;


use Illuminate\Support\Facades\Http;

class TelegramApi
{

    public string $url;
    public string $login;
    public string $password;

    public function __construct()
    {
        $this->url = config('services.telegram_api.url');
        $this->login = config('services.telegram_api.login');
        $this->password = config('services.telegram_api.password');
    }

    private static function createInstance(): self
    {
        return new self();
    }

    private function sendMessageRequest(string $recipient, string $message)
    {
        return Http::withBasicAuth($this->login, $this->password)
            ->post($this->url, compact('recipient', 'message'))
            ->json();
    }

    public static function sendMessage(string $recipient, string $message)
    {
        return self::createInstance()->sendMessageRequest($recipient, $message);
    }

}
