<?php

namespace app\core;

/**
 * Class BaseController
 * @package app\core
 */
abstract class BaseController
{
    /** @var array $request - requested params */
    protected $request;

    /**
     * BaseController constructor.
     * Creates an instance of the Controller and assign request data
     *
     * @param array $request
     */
    public function __construct(array $request)
    {
        $this->request = $request;
    }

    /**
     * Execute Controller::$method (@see config.php)
     *
     * @param string $method - method name
     * @return array|mixed - $method result
     * @throws \Exception - sometimes (check config.php file)
     */
    public function execute($method)
    {
        if (!method_exists($this, $method)) {
            throw new \Exception('Invalid config');
        }

        return call_user_func([$this, $method]);
    }
}
