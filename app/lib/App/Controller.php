<?php

namespace App;

use App\View;

abstract class Controller
{
    protected $view = null;
    public function __construct(View $view)
    {
        $this->view = $view;
        $this->view->set("siteTitle", "E-commerce Website");
    }
}
