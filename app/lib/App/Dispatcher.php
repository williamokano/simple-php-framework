<?php

namespace App;

use App\Request;
use App\View;
use App\Controller;
use App\Exception\ControllerNotFoundException;
use App\Exception\ActionNotFoundException;

/**
 *
 */
class Dispatcher
{
    private $request;
    private $controllerName;
    private $methodName;
    private $controller;
    private $arguments = array();

    /**
     * [__construct description]
     * @param Request $request [description]
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->controller = null;
    }

    /**
     * [dispatch description]
     * @return [type] [description]
     */
    public function dispatch()
    {
        if (empty($this->controllerName)) {
            throw new ControllerNotFoundException("Could not found controller {$this->controllerName}");
        } else {
        ob_clean();
            $view = new View();
            $view->setTemplate(sprintf("%s.%s", $this->controllerName, $this->methodName));

            $controllerFullName = "\\Controllers\\" . $this->controllerName . "Controller";

            /*
            $this->controller = new $controllerFullName($view);
            $this->controller->{$this->methodName}();
            */
            if (!method_exists($controllerFullName, $this->methodName))
                throw new ActionNotFoundException("Action {$this->methodName} in controller {$controllerFullName} was not found");

            $reflectionMethod = new \ReflectionMethod($controllerFullName, $this->methodName);
            $reflectionMethod->invokeArgs(new $controllerFullName($view), $this->arguments);

            $view->render();
            $output = ob_get_clean();
            $this->request->sendHeaders();
            echo $output;
        }
    }

    /**
     * [getControllerName description]
     * @return [type] [description]
     */
    public function getControllerName()
    {
        return $this->controllerName;
    }

    /**
     * [getMethodName description]
     * @return [type] [description]
     */
    public function getMethodName()
    {
        return $this->methodName;
    }

    /**
     * [getRequest description]
     * @return [type] [description]
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * [getArguments description]
     * @return [type] [description]
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * [setControllerName description]
     * @param [type] $name [description]
     * @return [type] [description]
     */
    public function setControllerName($name)
    {
        $this->controllerName = $name;
        return $this; //Method chainning
    }

    /**
     * [setMethodName description]
     * @param [type] $name [description]
     * @return [type] [description]
     */
    public function setMethodName($name)
    {
        $this->methodName = $name;
        return $this; //Method chainning
    }

    /**
     * [setArguments description]
     * @param array $arguments [description]
     * @return [type] [description]
     */
    public function setArguments(array $arguments)
    {
        $this->arguments = $arguments;
        return $this; //Method chainning
    }
}
