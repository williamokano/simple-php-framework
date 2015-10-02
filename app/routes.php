<?php
use App\Router;

Router::get("/", "Index@index");
Router::get("/busca/:termo/:pagina", "Index@busca");
Router::get("/busca/:termo", "Index@busca");
//Router::get("/busca", "Index@busca");
