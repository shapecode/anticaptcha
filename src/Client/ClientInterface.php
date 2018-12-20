<?php

namespace Shapecode\AntiCaptcha\Client;

/**
 * Interface ClientInterface
 *
 * @package Shapecode\AntiCaptcha\Client
 * @author  Nikita Loges
 */
interface ClientInterface
{

    /**
     * @param $name
     * @param $data
     *
     * @return mixed
     */
    public function request($name, array $data = []);

    /**
     * @return string
     */
    public function getUserAgent();
}
