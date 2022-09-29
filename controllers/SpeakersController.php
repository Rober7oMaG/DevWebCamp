<?php

namespace Controllers;

use Classes\Pagination;
use MVC\Router;
use Models\Speaker;
use Intervention\Image\ImageManagerStatic as Image;

class SpeakersController {
    public static function index(Router $router) {
        if (!is_admin()) {
            header('location: /login');
        }

        $current_page = $_GET['page'];
        $current_page = filter_var($current_page, FILTER_VALIDATE_INT);
        if (!$current_page || $current_page < 1) {
            header('location: /admin/speakers?page=1');
        }

        $per_page_registers = 10;
        $total_registers = Speaker::count();

        $pagination = new Pagination($current_page, $per_page_registers, $total_registers);
        if ($pagination->pages_total() < $current_page) {
            header('location: /admin/speakers?page=1');
        }

        $speakers = Speaker::paginate($per_page_registers, $pagination->offset());

        $router->render('admin/speakers/index', [
            'title' => 'Speakers',
            'speakers' => $speakers,
            'pagination' => $pagination->create_pagination()
        ]);
    }

    public static function create(Router $router) {
        if (!is_admin()) {
            header('location: /login');
        }

        $alerts = [];
        $speaker = new Speaker;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!is_admin()) {
                header('location: /login');
            }

            if (!empty($_FILES['image']['tmp_name'])) {
                $images_folder = '../public/img/speakers';

                if (!is_dir($images_folder)) {
                    mkdir($images_folder, 0755, true);
                }

                $png_image = Image::make($_FILES['image']['tmp_name'])->fit(800, 800)->encode('png', 80);
                $webp_image = Image::make($_FILES['image']['tmp_name'])->fit(800, 800)->encode('webp', 80);

                $image_name = md5(uniqid(rand(), true));

                $_POST['image'] = $image_name;
            }

            $_POST['social'] = json_encode($_POST['social'], JSON_UNESCAPED_SLASHES);

            $speaker->synchronizeObject($_POST);

            $alerts = $speaker->validate();

            if (empty($alerts)) {
                // Save images
                $png_image->save($images_folder . '/' . $image_name . '.png');
                $webp_image->save($images_folder . '/' . $image_name . '.webp');

                // Save to database
                $result = $speaker->save();

                if ($result) {
                    header('location: /admin/speakers');
                }
            }
        }

        $router->render('admin/speakers/create', [
            'title' => 'Register Speaker',
            'alerts' => $alerts,
            'speaker' => $speaker,
            'social' => json_decode($speaker->social)
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
            header('location: /admin/speakers');
        }

        $speaker = Speaker::find('id', $id);

        if (!$speaker) {
            header('location: /admin/speakers');
        }

        $speaker->current_image = $speaker->image;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!is_admin()) {
                header('location: /login');
            }

            if (!empty($_FILES['image']['tmp_name'])) {
                $images_folder = '../public/img/speakers';

                if (!is_dir($images_folder)) {
                    mkdir($images_folder, 0755, true);
                }

                $png_image = Image::make($_FILES['image']['tmp_name'])->fit(800, 800)->encode('png', 80);
                $webp_image = Image::make($_FILES['image']['tmp_name'])->fit(800, 800)->encode('webp', 80);

                $image_name = md5(uniqid(rand(), true));

                $_POST['image'] = $image_name;
            } else {
                $_POST['image'] = $speaker->current_image;
            }

            $_POST['social'] = json_encode($_POST['social'], JSON_UNESCAPED_SLASHES);

            $speaker->synchronizeObject($_POST);

            $alerts = $speaker->validate();

            if (empty($alerts)) {
                if (isset($image_name)) {
                    // Save images
                    $png_image->save($images_folder . '/' . $image_name . '.png');
                    $webp_image->save($images_folder . '/' . $image_name . '.webp');
                }

                $result = $speaker->save();
                if ($result) {
                    header('location: /admin/speakers');
                }
            }
        }

        $router->render('admin/speakers/update', [
            'title' => 'Update Speaker',
            'alerts' => $alerts,
            'speaker' => $speaker,
            'social' => json_decode($speaker->social)
        ]);
    }

    public static function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!is_admin()) {
                header('location: /login');
            }
            
            $id = $_POST['id'];

            $speaker = Speaker::find('id', $id);
            if (!isset($speaker)) {
                header('location: /admin/speaker');
            }

            $result = $speaker->delete();
            if ($result) {
                header('location: /admin/speaker');
            }
        }
    }
}

?>