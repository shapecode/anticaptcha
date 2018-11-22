<?php

namespace Shapecode\AntiCaptcha;

use Shapecode\AntiCaptcha\Captcha\CaptchaInterface;
use Shapecode\AntiCaptcha\Client\ClientInterface;
use Shapecode\AntiCaptcha\Model\Result;
use Shapecode\AntiCaptcha\Model\Task;

/**
 * Class AntiCaptcha
 *
 * @package Shapecode\AntiCaptcha
 * @author  Nikita Loges
 */
class AntiCaptcha implements AntiCaptchaInterface
{

    /** @var string */
    protected $errorMessage;

    /** @var ClientInterface */
    protected $client;

    /**
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param CaptchaInterface $captcha
     *
     * @return bool|Task
     */
    public function createTask(CaptchaInterface $captcha)
    {
        $submitResult = $this->client->request('createTask', [
            'task' => $captcha->getPostData()
        ]);

        if ($submitResult === false) {
            return false;
        }

        if ($submitResult->errorId === 0) {
            return new Task($submitResult->taskId);
        }

        $this->errorMessage = $submitResult->errorDescription;

        return false;
    }

    /**
     * @param Task $task
     * @param int  $maxSeconds
     * @param int  $currentSecond
     *
     * @return bool|Result
     */
    public function getResult(Task $task)
    {
        $data = [
            'taskId' => $task->getId()
        ];

        $run = true;
        $now = new \DateTime();

        do {
            $postResult = $this->client->request('getTaskResult', $data);

            if ($postResult !== false) {
                if ($postResult->errorId === 0 && $postResult->status === 'ready') {
                    return new Result($task, $postResult);
                }

                $this->errorMessage = $postResult->errorDescription;

                return false;
            }

            $current = new \DateTime();
            $seconds = $current->getTimestamp() - $now->getTimestamp();

            if ($seconds > 60) {
                $run = false;
            }

            sleep(1);
        } while ($run === true);

        return false;
    }

    /**
     * @return bool
     */
    public function getBalance()
    {
        $result = $this->client->request('getBalance');

        if ($result === false) {
            return false;
        }

        if ($result->errorId === 0) {
            return $result->balance;
        }

        return false;
    }

    /**
     * @return mixed
     */
    public function getErrorMessage()
    {
        return $this->errorMessage;
    }

}