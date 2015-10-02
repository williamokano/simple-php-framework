<?php

namespace App;

use App\Dispatcher;
use App\Request;
use App\Exception\RouteNotFoundException;

/**
 * Classe responsável por verificar qual conroller e método deverá
 * ser executado.
 */
class Router
{
    private static $routes = array();

    /**
     * [get description]
     * @param  string $url  Padrão a ser casado com a URL
     * @param  mixed $what String ou uma função para determinar qual ação será executada
     * @return void
     */
    public static function get($url, $what)
    {
        Router::$routes[$url] = $what;
    }

    /**
     * Remove uma rota de GET
     * @param string $url Padrão a ser casado
     */
    public static function delete($url)
    {
        unset(Router::$routes[$url]);
    }

    /**
     * [getDispatcher description]
     * @param  Request $request [description]
     * @return Dispatcher           Objeto dispatcher contendo as informações da rota
     */
    public static function getDispatcher(Request $request)
    {
        $dispatcher = new Dispatcher($request);
        $foundRoute = false;
        $controller = "";
        $method = "";
        $arguments = array();
        //Check if there is any route
        foreach (Router::$routes as $route => $controller) {
            $route = substr($route, -1) == "/" && substr($route, -2, 1) != "/" ? $route : $route . "/"; //Add trailing slash
            $requestUri = substr($request->REQUEST_URI, 1) == "/" ? $request->REQUEST_URI : $request->REQUEST_URI . "/";
            $parsedRoute = Router::parseRoute($route);

            if (preg_match($parsedRoute, $requestUri, $arguments)) {
                if (preg_match("/\\w+@\\w+/", $controller)) {
                    list($controller, $method) = explode("@", $controller);
                    $dispatcher->setControllerName($controller);
                    $dispatcher->setMethodName($method);
                    $dispatcher->setArguments(array_slice($arguments, 1));
                    $foundRoute = true;
                    break;
                }
            }
        }

        if (!$foundRoute)
            throw new RouteNotFoundException();

        return $dispatcher;
    }

    /**
     * [parseRoute description]
     * @param  [type] $route [description]
     * @return [type]        [description]
     */
    private static function parseRoute($route)
    {
        //Trata named parameter
        $parsedRoute = preg_replace("(:\\w+)", "(.+?)", $route);
        return "/" . str_replace(array("/"), "\\/", addslashes($parsedRoute)) . "/";
    }
}
