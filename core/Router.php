<?php

namespace app;

use app\core\ApiException;

/**
 * Class Router
 *
 * Resolves query to controller
 *
 * @package app
 */
class Router
{
    /** @var array $routes - configuration of available 'modes' and corresponding controller methods */
    private $routes;

    /**
     * Router constructor.
     * Creates an instance of Router and assign available routes from config
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->routes = $config['routes'];
    }

    /**
     * Check 'mode' and execute corresponding controller method, if any
     *
     * @param array $requestData - additional params
     * @return array|mixed - returns that returns
     * @throws ApiException - invalid mode?
     * @throws \Exception - we need to go deeper (@see app\core\BaseController::execute)
     */
    public function fetch(array $requestData)
    {
        if (!isset($requestData['mode'])) {
            throw new ApiException('No mode specified. Please try again!');
        }

        $route = $requestData['mode'];

        if (empty($this->routes[$route])) {
            throw new ApiException('Invalid mode. Please try again!');
        }

        return (new Controller($requestData))->execute($this->routes[$route]);
    }
}
