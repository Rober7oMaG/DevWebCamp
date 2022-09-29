<?php

namespace Controllers;

use Classes\Pagination;
use Models\Category;
use Models\Day;
use Models\Event;
use Models\Hour;
use Models\Speaker;
use MVC\Router;

class EventsController {
    public static function index(Router $router) {
        if (!is_admin()) {
            header('location: /login');
        }

        $current_page = $_GET['page'];
        $current_page = filter_var($current_page, FILTER_VALIDATE_INT);
        if (!$current_page || $current_page < 1) {
            header('location: /admin/events?page=1');
        }

        $per_page_registers = 10;
        $total_registers = Event::count();

        $pagination = new Pagination($current_page, $per_page_registers, $total_registers);
        if ($pagination->pages_total() < $current_page) {
            header('location: /admin/events?page=1');
        }

        $events = Event::paginate($per_page_registers, $pagination->offset());

        foreach ($events as $event) {
            $event->category = Category::find('id', $event->category_id);
            $event->day = Day::find('id', $event->day_id);
            $event->hour = Hour::find('id', $event->hour_id);
            $event->speaker = Speaker::find('id', $event->speaker_id);
        }

        $router->render('admin/events/index', [
            'title' => 'Conferences & Workshops',
            'events' => $events,
            'pagination' => $pagination->create_pagination()
        ]);
    }

    public static function create(Router $router) {
        if (!is_admin()) {
            header('location: /login');
        }
        
        $alerts = [];

        $categories = Category::all();
        $days = Day::all();
        $hours = Hour::all();

        $event = new Event();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!is_admin()) {
                header('location: /login');
            }

            $event->synchronizeObject($_POST);

            $alerts = $event->validate();

            if (empty($alerts)) {
                $result = $event->save();

                if ($result) {
                    header(('location: /admin/events'));
                }
            }
        }

        $router->render('admin/events/create', [
            'title' => 'Register Event',
            'alerts' => $alerts,
            'categories' => $categories,
            'days' => $days,
            'hours' => $hours,
            'event' => $event
        ]);
    }

    public static function update(Router $router) {
        if (!is_admin()) {
            header('location: /login');
        }

        $alerts = [];

        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if (!$id) {
            header('location: /admin/events');
        }

        $categories = Category::all();
        $days = Day::all();
        $hours = Hour::all();

        $event = Event::find('id', $id);
        if (!$event) {
            header('location: /admin/events');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!is_admin()) {
                header('location: /login');
            }

            $event->synchronizeObject($_POST);

            $alerts = $event->validate();

            if (empty($alerts)) {
                $result = $event->save();

                if ($result) {
                    header(('location: /admin/events'));
                }
            }
        }

        $router->render('admin/events/update', [
            'title' => 'Update Event',
            'alerts' => $alerts,
            'categories' => $categories,
            'days' => $days,
            'hours' => $hours,
            'event' => $event
        ]);
    }

    public static function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!is_admin()) {
                header('location: /login');
            }

            $id = $_POST['id'];

            $event = Event::find('id', $id);
            if (!isset($event)) {
                header('location: /admin/event');
            }

            $result = $event->delete();
            if ($result) {
                header('location: /admin/event');
            }
        }
    }
}

?>