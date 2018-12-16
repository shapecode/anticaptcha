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
     * @inheritdoc
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
     * @inheritdoc
     */
    public function getResult(Task $task, $wait = 60)
    {
        ini_set('max_execution_time', $wait + 10);

        $data = [
            'taskId' => $task->getId()
        ];

        $run = true;
        $now = new \DateTime();

        do {
            $result = $this->client->request('getTaskResult', $data);

            if ($result !== false) {
                if ($result->errorId === 0 && $result->status === 'ready') {
                    return new Result($task, $result);
                }

                if ($result->errorId !== 0) {
                    $this->errorMessage = $result->errorDescription;

                    return false;
                }
            }

            $current = new \DateTime();
            $seconds = $current->getTimestamp() - $now->getTimestamp();

            if ($seconds > $wait) {
                $run = false;
            }

            sleep(1);
        } while ($run === true);

        return false;
    }

    /**
     * @inheritdoc
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