<?php

namespace Controllers;

use MVC\Router;

class GiftsController {
    public static function index(Router $router) {
        $router->render('admin/gifts/index', [
            'title' => 'Gifts'
        ]);
    }
}

?>