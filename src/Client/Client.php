<?php

namespace Shapecode\AntiCaptcha\Client;

use GuzzleHttp\Client as Guzzle;

/**
 * Class Client
 *
 * @package Shapecode\AntiCaptcha
 * @author  Nikita Loges
 */
class Client implements ClientInterface
{

    const HOST = 'https://api.anti-captcha.com';

    /** @var string */
    protected $clientKey;

    /** @var Guzzle */
    protected $guzzle;

    /**
     * @param string $clientKey
     */
    public function __construct($clientKey)
    {
        $this->clientKey = $clientKey;
    }

    /**
     * @inheritdoc
     */
    public function request($name, array $data = [])
    {
        $data['clientKey'] = $this->clientKey;

        $response = $this->getGuzzle()->request('POST', $name, [
            'body' => json_encode($data)
        ]);
        $content = $response->getBody()->getContents();

        return json_decode($content);
    }

    /**
     * @return Guzzle
     */
    protected function getGuzzle()
    {
        if ($this->guzzle === null) {
            $guzzle = new Guzzle([
                'base_uri' => self::HOST,
                'timeout'  => 10,
                'headers'  => [
                    'Content-Type' => 'application/json; charset=utf-8',
                    'Accept'       => 'application/json',
                ]
            ]);

            $this->guzzle = $guzzle;
        }

        return $this->guzzle;
    }
}
