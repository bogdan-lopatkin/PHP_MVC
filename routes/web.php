<?php

use Core\Router;


Router::get('', ['controller' => 'ProductController', 'action' => 'get']);
Router::post('products', ['controller' => 'ProductController', 'action' => 'store']);
Router::get('products/create', ['controller' => 'ProductController', 'action' => 'create']);
Router::get('products/{id}', ['controller' => 'ProductController', 'action' => 'show']);
Router::post('feedbacks', ['controller' => 'FeedbackController', 'action' => 'store']);

Router::dispatch($_SERVER['QUERY_STRING']);