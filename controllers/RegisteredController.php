<?php

namespace Controllers;

use MVC\Router;
use Classes\Pagination;
use Models\Bundle;
use Models\Registration;
use Models\User;

class RegisteredController {
    public static function index(Router $router) {
        if (!is_admin()) {
            header('location: /login');
        }

        $current_page = $_GET['page'];
        $current_page = filter_var($current_page, FILTER_VALIDATE_INT);
        if (!$current_page || $current_page < 1) {
            header('location: /admin/registered?page=1');
        }

        $per_page_registers = 10;
        $total_registers = Registration::count();

        $pagination = new Pagination($current_page, $per_page_registers, $total_registers);
        if ($pagination->pages_total() < $current_page) {
            header('location: /admin/registered?page=1');
        }

        $registrations = Registration::paginate($per_page_registers, $pagination->offset());
        foreach ($registrations as $registration) {
            $registration->user = User::find('id', $registration->user_id);
            $registration->bundle = Bundle::find('id', $registration->bundle_id);
        }

        $router->render('admin/registered/index', [
            'title' => 'Registered Users',
            'registrations' => $registrations,
            'pagination' => $pagination->create_pagination()
        ]);
    }
}

?>