<?php

namespace Shapecode\AntiCaptcha\Captcha;

/**
 * Interface CaptchaInterface
 *
 * @package Shapecode\AntiCaptcha\Captcha
 * @author  Nikita Loges
 */
interface CaptchaInterface
{

    /**
     * @return array
     */
    public function getPostData();
}
