<?php

namespace Shapecode\AntiCaptcha\Captcha;

/**
 * Class AbstractCaptcha
 *
 * @package Shapecode\AntiCaptcha\Captcha
 * @author  Nikita Loges
 */
abstract class AbstractCaptcha implements CaptchaInterface
{

    /** @var string */
    protected $websiteUrl;

    /** @var string */
    protected $websitePublicKey;

    /**
     * @param        $websiteUrl
     * @param        $websitePublicKey
     */
    public function __construct($websiteUrl, $websitePublicKey)
    {
        $this->websiteUrl = $websiteUrl;
        $this->websitePublicKey = $websitePublicKey;
    }

    /**
     * @inheritdoc
     */
    public function getPostData()
    {
        $data = [
            'type'             => $this->getType(),
            'websiteURL'       => $this->websiteUrl,
            'websitePublicKey' => $this->websitePublicKey,
        ];

        return $data;
    }

    /**
     * @return string
     */
    abstract protected function getType();
}
