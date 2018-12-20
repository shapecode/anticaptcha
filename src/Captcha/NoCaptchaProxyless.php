<?php

namespace Shapecode\AntiCaptcha\Captcha;

/**
 * Class NoCaptchaProxyless
 *
 * @package Shapecode\AntiCaptcha\Captcha
 * @author  Nikita Loges
 */
class NoCaptchaProxyless extends AbstractCaptcha
{

    /**
     * @inheritdoc
     */
    protected function getType()
    {
        return 'NoCaptchaTaskProxyless';
    }
}
