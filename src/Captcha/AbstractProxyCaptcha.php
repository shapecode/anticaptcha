<?php

namespace Shapecode\AntiCaptcha\Captcha;

/**
 * Class AbstractProxyCaptcha
 *
 * @package Shapecode\AntiCaptcha\Captcha
 * @author  Nikita Loges
 */
abstract class AbstractProxyCaptcha extends AbstractCaptcha
{

    /** @var string */
    protected $proxyType;

    /** @var string */
    protected $proxyAddress;

    /** @var int */
    protected $proxyPort;

    /** @var string|null */
    protected $proxyLogin;

    /** @var string|null */
    protected $proxyPassword;

    /** @var string */
    protected $userAgent = '';

    /** @var string */
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
    public function __construct($websiteUrl, $websitePublicKey, $proxyType, $proxyAddress, $proxyPort, $userAgent = null, $proxyLogin = null, $proxyPassword = null, $cookies = null)
    {
        parent::__construct($websiteUrl, $websitePublicKey);

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
        $data = parent::getPostData();

        $data['proxyType'] = $this->proxyType;
        $data['proxyAddress'] = $this->proxyAddress;
        $data['proxyPort'] = $this->proxyPort;

        if ($this->userAgent !== null) {
            $data['userAgent'] = $this->userAgent;
        }

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

    /**
     * @param string|null $userAgent
     */
    public function setUserAgent($userAgent)
    {
        $this->userAgent = $userAgent;
    }

    /**
     * @param null $proxyLogin
     */
    public function setProxyLogin($proxyLogin)
    {
        $this->proxyLogin = $proxyLogin;
    }

    /**
     * @param null $proxyPassword
     */
    public function setProxyPassword($proxyPassword)
    {
        $this->proxyPassword = $proxyPassword;
    }
}
