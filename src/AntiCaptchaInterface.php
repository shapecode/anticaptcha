<?php

namespace Shapecode\AntiCaptcha;

use Shapecode\AntiCaptcha\Captcha\CaptchaInterface;
use Shapecode\AntiCaptcha\Model\Result;
use Shapecode\AntiCaptcha\Model\Task;

/**
 * Interface AntiCaptchaInterface
 *
 * @package Shapecode\AntiCaptcha
 * @author  Nikita Loges
 */
interface AntiCaptchaInterface
{

    /**
     * @param CaptchaInterface $captcha
     *
     * @return bool|Task
     */
    public function createTask(CaptchaInterface $captcha);

    /**
     * @param Task $task
     *
     * @return bool|Result
     */
    public function getResult(Task $task);

    /**
     * @param Task $task
     * @param int  $wait
     *
     * @return bool|Result
     */
    public function getResultWithWait(Task $task, $wait = 60);

    /**
     * @return bool
     */
    public function getBalance();
}