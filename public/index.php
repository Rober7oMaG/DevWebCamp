<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\EventsAPI;
use Controllers\SpeakersAPI;
use Controllers\AuthController;
use Controllers\GiftsController;
use Controllers\PagesController;
use Controllers\EventsController;
use Controllers\RegistrationController;
use Controllers\SpeakersController;
use Controllers\DashboardController;
use Controllers\GiftsAPI;
use Controllers\RegisteredController;

$router = new Router();

// Login
$router->get('/login', [AuthController::class, 'login']);
$router->post('/login', [AuthController::class, 'login']);
$router->post('/logout', [AuthController::class, 'logout']);

// Register
$router->get('/register', [AuthController::class, 'register']);
$router->post('/register', [AuthController::class, 'register']);

// Forgot Password
$router->get('/forgot', [AuthController::class, 'forgot']);
$router->post('/forgot', [AuthController::class, 'forgot']);

// Reset Password
$router->get('/reset', [AuthController::class, 'reset']);
$router->post('/reset', [AuthController::class, 'reset']);

// Confirm Account
$router->get('/message', [AuthController::class, 'message']);
$router->get('/confirm-account', [AuthController::class, 'confirm']);

// Admin
$router->get('/admin/dashboard', [DashboardController::class, 'index']);

$router->get('/admin/speakers', [SpeakersController::class, 'index']);
$router->get('/admin/speakers/create', [SpeakersController::class, 'create']);
$router->post('/admin/speakers/create', [SpeakersController::class, 'create']);
$router->get('/admin/speakers/update', [SpeakersController::class, 'update']);
$router->post('/admin/speakers/update', [SpeakersController::class, 'update']);
$router->post('/admin/speakers/delete', [SpeakersController::class, 'delete']);

$router->get('/admin/events', [EventsController::class, 'index']);
$router->get('/admin/events/create', [EventsController::class, 'create']);
$router->post('/admin/events/create', [EventsController::class, 'create']);
$router->get('/admin/events/update', [EventsController::class, 'update']);
$router->post('/admin/events/update', [EventsController::class, 'update']);
$router->post('/admin/events/delete', [EventsController::class, 'delete']);

// API
$router->get('/api/events-schedule', [EventsAPI::class, 'index']);
$router->get('/api/speakers', [SpeakersAPI::class, 'index']);
$router->get('/api/speaker', [SpeakersAPI::class, 'get_speaker']);
$router->get('/api/gifts', [GiftsAPI::class, 'index']);

$router->get('/admin/registered', [RegisteredController::class, 'index']);

$router->get('/admin/gifts', [GiftsController::class, 'index']);

// Users registrations
$router->get('/finish-registration', [RegistrationController::class, 'create']);
$router->post('/finish-registration/free', [RegistrationController::class, 'free']);
$router->post('/finish-registration/pay', [RegistrationController::class, 'pay']);
$router->get('/finish-registration/conferences', [RegistrationController::class, 'conferences']);
$router->post('/finish-registration/conferences', [RegistrationController::class, 'conferences']);

// Virtual ticket
$router->get('/ticket', [RegistrationController::class, 'ticket']);

// Public Area
$router->get('/', [PagesController::class, 'index']);
$router->get('/about', [PagesController::class, 'about']);
$router->get('/bundles', [PagesController::class, 'bundles']);
$router->get('/events', [PagesController::class, 'events']);
$router->get('/404', [PagesController::class, 'error']);


$router->checkRoutes();