<?php

namespace Shapecode\AntiCaptcha\Model;

/**
 * Class Result
 *
 * @package Shapecode\AntiCaptcha\Model
 * @author  Nikita Loges
 */
class Result
{

    /** @var Task */
    protected $task;

    /** @var mixed */
    protected $data;

    /**
     * @param Task  $task
     * @param mixed $data
     */
    public function __construct(Task $task, $data)
    {
        $this->task = $task;
        $this->data = $data;
    }

    /**
     * @return Task
     */
    public function getTask()
    {
        return $this->task;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return mixed
     */
    public function getSolution()
    {
        return $this->getData()->solution->token;
    }
}
