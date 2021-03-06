<?php
/**
 * Copyright (c) 2017  Alashov Berkeli
 * It is licensed under GNU GPL v. 2 or later. For full terms see the file LICENSE.
 */

namespace App\Datmusic;

use GuzzleHttp\Client;
use SingletonTrait;

class HttpClient
{
    use SingletonTrait;

    /**
     * @var Client Guzzle client
     */
    private $httpClient;

    /**
     * HttpClientTrait constructor.
     */
    public function __construct()
    {
        $this->httpClient = new Client([
            'base_uri' => 'https://m.vk.com',
            'cookies' => true,
            'defaults' => [
                'headers' => [
                    'User-agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_12_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.95 Safari/537.36'
                ]
            ]
        ]);
    }

    public function getClient()
    {
        return $this->httpClient;
    }
}