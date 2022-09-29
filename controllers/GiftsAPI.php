<?php

namespace Controllers;

use Models\Gift;
use Models\Registration;

class GiftsAPI {
    public static function index() {
        if(!is_admin()) {
            echo json_encode([]);
            return;
        }

        $gifts = Gift::all();

        foreach ($gifts as $gift) {
            $gift->total = Registration::countArray(['gift_id' => $gift->id, 'bundle_id' => "1"]);
        }

        echo json_encode($gifts);
        return;
    }
}