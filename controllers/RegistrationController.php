<?php

namespace Controllers;

use Models\Day;
use MVC\Router;
use Models\Hour;
use Models\User;
use Models\Event;
use Models\Bundle;
use Models\Speaker;
use Models\Category;
use Models\Gift;
use Models\Registration;
use Models\RegistrationsEvents;

class RegistrationController {
    public static function create(Router $router) {
        if (!is_auth()) {
            header('location: /');
            return;
        }

        // Check if user is already registered
        $registration = Registration::find('user_id', $_SESSION['id']);

        if (isset($registration) && ($registration->bundle_id === '3' || $registration->bundle_id === '2')) {
            header('location: /ticket?id=' . urlencode($registration->token));
            return;
        }

        if (isset($registration) && $registration->bundle_id === '1') {
            header('location: /finish-registration/conferences');
            return;
        }

        $router->render('registration/create', [
            'title' => 'Finish Registration'
        ]);
    }

    public static function free() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!is_auth()) {
                header('location: /login');
                return;
            }

            // Check if user is already registered
            $registration = Registration::find('user_id', $_SESSION['id']);
            if (isset($registration) && $registration->bundle_id === '3') {
                header('location: /ticket?id=' . urlencode($registration->token));
                return;
            }

            $token = substr(md5(uniqid(rand(), true)), 0, 8);

            // Create registration
            $data = [
                'bundle_id' => 3,
                'payment_id' => '',
                'token' => $token,
                'user_id' => $_SESSION['id']
            ];

            $registration = new Registration($data);
            $result = $registration->save();
            if ($result) {
                header('location: /ticket?id=' . urlencode($registration->token));
                return;
            }
        }
    }

    public static function pay() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!is_auth()) {
                header('location: /login');
                return;
            }

            if (empty($_POST)) {
                echo json_encode([]);
                return;
            }

            // Create registration
            $data = $_POST;
            $data['token'] = substr(md5(uniqid(rand(), true)), 0, 8);
            $data['user_id'] = $_SESSION['id'];

            try {
                $registration = new Registration($data);
                $result = $registration->save();
                echo json_encode($result);
            } catch (\Throwable $th) {
                echo json_encode([
                    'result' => 'Error'
                ]);
            }
        }
    }

    public static function ticket(Router $router) {
        //Validate URL
        $id = $_GET['id'];
        if (!$id || !strlen($id) === 8) {
            header('location: /');
            return;
        }

        $registration = Registration::find('token', $id);
        if (!$registration) {
            header('location: /');
            return;
        }

        // Fill reference tables
        $registration->user = User::find('id', $registration->user_id);
        $registration->bundle = Bundle::find('id', $registration->bundle_id);

        $router->render('registration/ticket', [
            'title' => 'DevWebCamp Attendance',
            'registration' => $registration 
        ]);
    }

    public static function conferences(Router $router) {
        if (!is_auth()) {
            header('location: /login');
            return;
        }

        $user_id = $_SESSION['id'];
        $registration = Registration::find('user_id', $user_id);

        if (isset($registration) && $registration->bundle_id === "2") {
            header('location: /ticket?id=' . urlencode($registration->token));
            return;
        }

        if ($registration->bundle_id !== "1") {
            header('location: /');
            return;
        }

        // Redirect to virtual ticket in case the registration is finished
        if (isset($registration->gift_id) && $registration->bundle_id === "1") {
            header('location: /ticket?id=' . urlencode($registration->token));
            return;
        }

        $events = Event::sort('hour_id', 'ASC');
        $formatted_events = [];

        foreach ($events as $event) {
            $event->category = Category::find('id', $event->category_id);
            $event->day = Day::find('id', $event->day_id);
            $event->hour = Hour::find('id', $event->hour_id);
            $event->speaker = Speaker::find('id', $event->speaker_id);
            
            if ($event->day_id === '1' && $event->category_id === '1') {
                $formatted_events['conferences_friday'][] = $event;
            }

            if ($event->day_id === '2' && $event->category_id === '1') {
                $formatted_events['conferences_saturday'][] = $event;
            }

            if ($event->day_id === '1' && $event->category_id === '2') {
                $formatted_events['workshops_friday'][] = $event;
            }

            if ($event->day_id === '2' && $event->category_id === '2') {
                $formatted_events['workshops_saturday'][] = $event;
            }
        }

        $gifts = Gift::all();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!is_auth()) {
                header('location: /login');
                return;
            }

            $events = explode(',', $_POST['events']);
            if (empty($events)) {
                echo json_encode(['result' => false]);
                return;
            }

            // Get user's registration
            $registration = Registration::find('user_id', $_SESSION['id']);
            if (!isset($registration) || $registration->bundle_id !== '1') {
                echo json_encode(['result' => false]);
                return;
            }

            $events_array = [];

            // Validate selected events avalability
            foreach ($events as $event_id) {
                $event = Event::find('id', $event_id);

                // Check if event exists
                if (!isset($event) || $event->available === '0') {
                    echo json_encode(['result' => false]);
                    return;
                }

                $events_array[] = $event;
            }

            foreach ($events_array as $event) {
                $event->available -= 1;
                $event->save();

                // Save registration
                $data = [
                    'event_id' => (int) $event->id,
                    'registration_id' => (int) $registration->id
                ];

                $user_registration = new RegistrationsEvents($data);
                $user_registration->save();
            }

            $registration->synchronizeObject(['gift_id' => $_POST['gift_id']]);
            $result = $registration->save();

            if ($result) {
                echo json_encode([
                    'result' => $result,
                    'token' => $registration->token
                ]);
            } else {
                echo json_encode(['result' => false]);
                return;
            }

            return;
        }
        
        $router->render('registration/conferences', [
            'title' => 'Select Conferences and Workshops',
            'events' => $formatted_events,
            'gifts' => $gifts
        ]);
    }
}

?>