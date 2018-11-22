<?php

namespace Shapecode\AntiCaptcha\Captcha;

/**
 * Class FunCaptcha
 *
 * @package Shapecode\AntiCaptcha\Captcha
 * @author  Nikita Loges
 */
class FunCaptcha implements CaptchaInterface
{

    protected $websiteUrl;
    protected $websitePublicKey;
    protected $proxyType;
    protected $proxyAddress;
    protected $proxyPort;
    protected $proxyLogin;
    protected $proxyPassword;
    protected $userAgent = '';
    protected $cookies = '';

    /**
     * @param        $websiteUrl
     * @param        $websitePublicKey
     * @param string $proxyType
     * @param        $proxyAddress
     * @param        $proxyPort
     * @param        $proxyLogin
     * @param        $proxyPassword
     * @param string $userAgent
     * @param string $cookies
     */
    public function __construct($websiteUrl, $websitePublicKey, $proxyType, $proxyAddress, $proxyPort, $userAgent, $proxyLogin = null, $proxyPassword = null, $cookies = null)
    {
        $this->websiteUrl = $websiteUrl;
        $this->websitePublicKey = $websitePublicKey;
        $this->proxyType = $proxyType;
        $this->proxyAddress = $proxyAddress;
        $this->proxyPort = $proxyPort;
        $this->proxyLogin = $proxyLogin;
        $this->proxyPassword = $proxyPassword;
        $this->userAgent = $userAgent;
        $this->cookies = $cookies;
    }

    /**
     * @inheritdoc
     */
    public function getPostData()
    {
        $data = [
            'type'             => 'FunCaptchaTask',
            'websiteURL'       => $this->websiteUrl,
            'websitePublicKey' => $this->websitePublicKey,
            'proxyType'        => $this->proxyType,
            'proxyAddress'     => $this->proxyAddress,
            'proxyPort'        => $this->proxyPort,
            'userAgent'        => $this->userAgent,
        ];

        if ($this->proxyLogin !== null) {
            $data['proxyLogin'] = $this->proxyLogin;
        }

        if ($this->proxyPassword !== null) {
            $data['proxyPassword'] = $this->proxyPassword;
        }

        if ($this->proxyLogin !== null) {
            $data['cookies'] = $this->cookies;
        }

        return $data;
    }

}