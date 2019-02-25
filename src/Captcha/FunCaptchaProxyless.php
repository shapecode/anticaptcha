<?php

namespace Shapecode\AntiCaptcha\Captcha;

/**
 * Class FunCaptcha
 *
 * @package Shapecode\AntiCaptcha\Captcha
 * @author  Nikita Loges
 */
class FunCaptchaProxyless extends AbstractCaptcha
{

    /**
     * @inheritdoc
     */
    protected function getType()
    {
        return 'FunCaptchaTaskProxyless';
    }

}