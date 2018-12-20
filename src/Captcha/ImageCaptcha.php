<?php

namespace Shapecode\AntiCaptcha\Captcha;

/**
 * Class ImageCaptcha
 *
 * @package Shapecode\AntiCaptcha\Captcha
 * @author  Nikita Loges
 */
class ImageCaptcha implements CaptchaInterface
{

    protected $body;
    protected $phrase = false;
    protected $case = false;
    protected $numeric = 0;
    protected $math = false;
    protected $minLength = 0;
    protected $maxLength = 0;

    /**
     * @param      $body
     * @param bool $phrase
     * @param bool $case
     * @param int  $numeric
     * @param bool $math
     * @param int  $minLength
     * @param int  $maxLength
     */
    public function __construct($body, $phrase = false, $case = false, $numeric = 0, $math = false, $minLength = 0, $maxLength = 0)
    {
        $this->body = $body;
        $this->phrase = $phrase;
        $this->case = $case;
        $this->numeric = $numeric;
        $this->math = $math;
        $this->minLength = $minLength;
        $this->maxLength = $maxLength;
    }

    /**
     * @inheritdoc
     */
    public function getPostData()
    {
        $data = [
            'type'      => 'ImageToTextTask',
            'body'      => $this->body,
            'phrase'    => $this->phrase,
            'case'      => $this->case,
            'numeric'   => $this->numeric,
            'math'      => $this->math,
            'minLength' => $this->minLength,
            'maxLength' => $this->maxLength,
        ];

        return $data;
    }

    /**
     * @param bool $phrase
     */
    public function setPhrase($phrase)
    {
        $this->phrase = $phrase;
    }

    /**
     * @param bool $case
     */
    public function setCase($case)
    {
        $this->case = $case;
    }

    /**
     * @param bool $numeric
     */
    public function setNumeric($numeric)
    {
        $this->numeric = $numeric;
    }

    /**
     * @param int $math
     */
    public function setMath($math)
    {
        $this->math = $math;
    }

    /**
     * @param int $minLength
     */
    public function setMinLength($minLength)
    {
        $this->minLength = $minLength;
    }

    /**
     * @param int $maxLength
     */
    public function setMaxLength($maxLength)
    {
        $this->maxLength = $maxLength;
    }
}
