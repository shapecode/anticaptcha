<?php

namespace Shapecode\AntiCaptcha\Model;

/**
 * Class Task
 *
 * @package Shapecode\AntiCaptcha\Model
 * @author  Nikita Loges
 */
class Task
{

    /** @var string */
    protected $id;

    /**
     * @param string $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }
}
