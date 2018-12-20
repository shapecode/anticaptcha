<?php

namespace Shapecode\AntiCaptcha\Captcha;

/**
 * Class NoCaptcha
 *
 * @package Shapecode\AntiCaptcha\Captcha
 * @author  Nikita Loges
 */
class NoCaptcha extends AbstractProxyCaptcha
{

    /**
     * @inheritdoc
     */
    protected function getType()
    {
        return 'NoCaptchaTask';
    }
}
