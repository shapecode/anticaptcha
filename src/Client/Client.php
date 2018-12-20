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

    /** @var string */
    protected $userAgent;

    /** @var Guzzle */
    protected $guzzle;

    /**
     * @param $clientKey
     * @param $userAgent
     */
    public function __construct($clientKey, $userAgent = null)
    {
        $this->clientKey = $clientKey;
        $this->userAgent = $userAgent;
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
                    'User-Agent'   => $this->getUserAgent(),
                ]
            ]);

            $this->guzzle = $guzzle;
        }

        return $this->guzzle;
    }

    /**
     * @return string
     */
    public function getUserAgent()
    {
        if ($this->userAgent === null) {
            return 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.67 Safari/537.36';
        }

        return $this->userAgent;
    }
}
