<?php

namespace Controllers;

use Models\Event;
use MVC\Router;
use Models\User;
use Models\Registration;

class DashboardController {

    public static function index(Router $router) {
        // Get the latest registrations
        $registrations = Registration::get(5);
        foreach ($registrations as $registration) {
            $registration->user = User::find('id', $registration->user_id);
        }

        // Calculate income
        $virtual = Registration::count('bundle_id', 2);
        $presential = Registration::count('bundle_id', 1);

        $income = ($virtual * 46.41) + ($presential * 189.54);

        // Get events with the most and least available places
        $least_available = Event::sortLimit('available', 'ASC', 5);
        $most_available = Event::sortLimit('available', 'DESC', 5);

        $router->render('admin/dashboard/index', [
            'title' => 'Administration Panel',
            'registrations' => $registrations,
            'income' => $income,
            'least_available' => $least_available,
            'most_available' => $most_available
        ]);
    }
}

?>