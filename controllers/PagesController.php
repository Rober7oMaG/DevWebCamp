<?php

namespace Controllers;

use Models\Day;
use MVC\Router;
use Models\Hour;
use Models\Event;
use Models\Speaker;
use Models\Category;
use Models\Registration;

class PagesController {
    public static function index(Router $router) {
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

        // Get block count
        $speakers_count = Speaker::count();
        $conferences_count = Event::count('category_id', 1);
        $workshops_count = Event::count('category_id', 2);
        $registered_count = Registration::count();

        $speakers = Speaker::all();

        $router->render('pages/index', [
            'title' => 'Home',
            'events' => $formatted_events,
            'speakers_count' => $speakers_count,
            'conferences_count' => $conferences_count,
            'workshops_count' => $workshops_count,
            'registered_count' => $registered_count,
            'speakers' => $speakers
        ]);
    }

    public static function about(Router $router) {
        $router->render('pages/about', [
            'title' => 'About DevWebCamp'
        ]);
    }

    public static function bundles(Router $router) {
        $router->render('pages/bundles', [
            'title' => 'DevWebCamp Bundles'
        ]);
    }

    public static function events(Router $router) {
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

        $router->render('pages/events', [
            'title' => 'Conferences & Workshops',
            'events' => $formatted_events
        ]);
    }

    public static function error(Router $router) {
        $router->render('pages/error', [
            'title' => 'Page not Found',
        ]);
    }
}