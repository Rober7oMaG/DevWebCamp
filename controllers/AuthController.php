<?php

namespace Controllers;

use Classes\Email;
use Models\User;
use MVC\Router;

class AuthController {
    public static function login(Router $router) {
        $alerts = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = new User($_POST);
            $alerts = $user->validateLogin();

            if (empty($alerts)) {
                $user = User::find('email', $user-> email);

                if (!$user) {
                    User::setAlert('error', "This user does not exist.");
                } else if (!$user->confirmed) {
                    User::setAlert('error', "This user is not confirmed.");
                } else {
                    // User exists and is confirmed
                    if(password_verify($_POST['password'], $user->password)) {
                        // Log in
                        session_start();

                        $_SESSION['id'] = $user->id;
                        $_SESSION['name'] = $user->name;
                        $_SESSION['last_name'] = $user->last_name;
                        $_SESSION['email'] = $user->email;
                        $_SESSION['admin'] = $user->admin ?? null;
                        
                        // Redirect
                        if ($user->admin) {
                            header('location: /admin/dashboard');
                        } else {
                            header('location: /finish-registration');
                        }
                    } else {
                        User::setAlert('error', 'Incorrect password.');
                    }
                }
            }
        }

        $alerts = User::getAlerts();
        
        $router->render('auth/login', [
            'title' => "Login",
            'alerts' => $alerts,
            'user' => $user
        ]);
    }

    public static function logout() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();

            $_SESSION = [];

            header('location: /');
        }
    }

    public static function register(Router $router) {
        $alerts = [];
        $user = new User;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user->synchronizeObject($_POST);
            
            $alerts = $user->validateNewAccount();

            if(empty($alerts)) {
                $userExists = User::find('email', $user->email);

                if($userExists) {
                    User::setAlert('error', "This user is already registered.");
                    $alerts = User::getAlerts();
                } else {
                    // Hashear el password
                    $user->hashPassword();

                    // Remove password2
                    unset($user->password2);

                    $user->generateToken();

                    // Save to database
                    $result =  $user->save();

                    // Send confirmation email
                    $email = new Email($user->email, $user->name, $user->token);
                    $email->sendConfirmation();
                    
                    // Redirect
                    if($result) {
                        header('location: /message');
                    }
                }
            }
        }

        $router->render('auth/register', [
            'title' => "Register",
            'user' => $user,
            'alerts' => $alerts
        ]);
    }

    public static function forgot(Router $router) {
        $alerts = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = new User($_POST);
            $alerts = $user->validateEmail();

            if (empty($alerts)) {
                $user = User::find('email', $user->email);
                
                if ($user) {
                    // User exists
                    if (!$user->confirmed) {
                        User::setAlert('error', "This user is not confirmed.");
                    } else {
                        // Generate new token
                        $user->generateToken();

                        // Remove password2 from object
                        unset($user->password2);

                        // Update user
                        $user->save();

                        // Send email
                        $email = new Email($user->email, $user->name, $user->token);
                        $email->sendRecovery();
                        User::setAlert('success', "Check your email inbox to reset your password.");
                    }
                } else {
                    User::setAlert('error', "This user does not exist.");
                }
            }
        }

        $alerts = User::getAlerts();

        $router->render('auth/forgot', [
            'title' => "Forgot my Password",
            'alerts' => $alerts
        ]);
    }

    public static function reset(Router $router) {
        $token = sanitizeHTML($_GET['token']);
        $error = false;

        if (!$token) {
            header('location: /');
        }

        // Verify if an user with that token exists
        $user = User::find('token', $token);

        if (empty($user)) {
            // User not found
            User::setAlert('error', "Invalid token.");
            $error = true;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Set new password
            $user->synchronizeObject($_POST);
            
            // Validate password
            $alerts = $user->validatePassword();

            if (empty($alerts)) {
                // Hash password
                $user->hashPassword();

                // Delete token
                $user->token = '';

                // Delete password2
                unset($user->password2);

                // Save to database
                $result = $user->save();

                if ($result) {
                    header('location: /login');
                }
            }
        }

        $alerts = User::getAlerts();

        $router->render('auth/reset', [
            'title' => 'Reset password',
            'alerts' => $alerts,
            'error' => $error
        ]);
    }

    public static function message(Router $router) {
        $router->render('auth/message', [
            'title' => 'Confirm your account'
        ]);
    }

    public static function confirm(Router $router) {
        $token = sanitizeHTML($_GET['token']);

        if (!$token) {
            header('location: /');
        }

        // Verify if an user with that token exists
        $user = User::find('token', $token);

        if (empty($user)) {
            // User not found
            User::setAlert('error', "Invalid token, account could not be confirmed.");
        } else {
            // Save user
            $user->confirmed = 1;
            unset($user->password2);
            $user->token = '';

            $user->save();
            User::setAlert('success', "Account confirmed successfully.");
        }

        $alerts = User::getAlerts();

        $router->render('auth/confirm', [
            'title' => "Confirm your account",
            'alerts' => $alerts
        ]);
    }
}