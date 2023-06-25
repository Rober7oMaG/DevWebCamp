<?php

function debug($variable) {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

function sanitizeHTML($html) : string {
    $sanitized = htmlspecialchars($html);

    return $sanitized;
}

function current_page($path) : bool {
    return str_contains($_SERVER['PATH_INFO'] ?? '/', $path) ? true : false;
}

function is_auth() : bool {
    if (!isset($_SESSION) && !headers_sent()) {
        session_start();
    }

    return isset($_SESSION['name']) && !empty($_SESSION);
}

function is_admin() : bool {
    if (!isset($_SESSION) && !headers_sent()) {
        session_start();
    }

    return isset($_SESSION['admin']) && !empty($_SESSION['admin']);
}

function aos_animation() : string {
    $effects = [
        'fade-up',
        'fade-down',
        'fade-left',
        'fade-right',
        'flip-left',
        'flip-right',
        'zoom-in',
        'zoom-in-up',
        'zoom-in-down',
        'zoom-out',
    ];

    $effect = array_rand($effects, 1);

    return $effects[$effect];
}