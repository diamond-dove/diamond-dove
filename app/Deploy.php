<?php


namespace App;


class Deploy
{
    protected $api_key;
    protected $email;

    public function __construct(string $api_key, string $email)
    {
        $this->api_key = $api_key;
        $this->email = $email;
    }

    public function getApiKey(): string
    {
        return $this->api_key;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
