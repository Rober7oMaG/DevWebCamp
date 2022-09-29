<?php

namespace Controllers;

use Models\EventSchedule;
use Models\Speaker;

class SpeakersAPI {
    public static function index() {
        $speakers = Speaker::all();
        echo json_encode($speakers);
    }

    public static function get_speaker() {
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if (!$id || $id < 1) {
            echo json_encode([]);
            return;
        }

        $speaker = Speaker::find('id', $id);
        echo json_encode($speaker, JSON_UNESCAPED_SLASHES);
    }
}