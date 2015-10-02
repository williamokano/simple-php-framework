<?php
namespace App;

use App\Router;
use App\Request;
use App\Dispatcher;

class Application
{
    private $request;
    public function __construct()
    {
        $this->request = new Request($_SERVER);
        $this->request->setHeader("content-type", "text/html; charset=utf-8");
    }

    public function run()
    {
        $dispatcher = Router::getDispatcher($this->request);
        $dispatcher->dispatch();
    }
}
