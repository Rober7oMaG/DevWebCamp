<?php

namespace Models;

class User extends ActiveRecord {
    protected static $table = 'users';
    protected static $db_columns = ['id', 'name', 'last_name', 'email', 'password', 'confirmed', 'token', 'admin'];
    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->last_name = $args['last_name'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->password2 = $args['password2'] ?? '';
        $this->confirmed = $args['confirmed'] ?? 0;
        $this->token = $args['token'] ?? '';
        $this->admin = $args['admin'] ?? 0;
    }

    public function validateLogin() : array {
        if (!$this->email) {
            self::$alerts['error'][] = "Email is obligatory.";
        } else if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alerts['error'][] = "Invalid email.";
        }

        if (!$this->password) {
            self::$alerts['error'][] = "Password is obligatory.";
        }

        return self::$alerts;
    }

    public function validateNewAccount() : array {
        if (!$this->name) {
            self::$alerts['error'][] = "Name is obligatory.";
        }

        if (!$this->email) {
            self::$alerts['error'][] = "Email is obligatory.";
        } else if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alerts['error'][] = "Invalid email.";
        }

        if (!$this->password) {
            self::$alerts['error'][] = "Password is obligatory.";
        } else if (strlen($this->password) < 6) {
            self::$alerts['error'][] = "Password must contain at least 6 characters.";
        }

        if ($this->password !== $this->password2) {
            self::$alerts['error'][] = "Passwords don't match.";
        }

        return self::$alerts;
    }

    public function validateEmail() : array {
        if (!$this->email) {
            self::$alerts['error'][] = "Email is obligatory.";
        } else if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$alerts['error'][] = "Invalid email.";
        }

        return self::$alerts;
    }

    public function validatePassword() : array {
        if (!$this->password) {
            self::$alerts['error'][] = "Password is obligatory.";
        } else if (strlen($this->password) < 6) {
            self::$alerts['error'][] = "Password must contain at least 6 characters.";
        }

        if ($this->password !== $this->password2) {
            self::$alerts['error'][] = "Passwords don't match.";
        }

        return self::$alerts;
    }

    public function validateNewPassword() : array {
        if (!$this->current_password) {
            self::$alerts['error'][] = "Current password is obligatory.";
        }

        if (!$this->new_password) {
            self::$alerts['error'][] = "New password is obligatory.";
        } else if (strlen($this->new_password) < 6) {
            self::$alerts['error'][] = "Password must contain at least 6 characters.";
        }

        return self::$alerts;
    }

    public function checkPassword() : bool {
        return password_verify($this->current_password, $this->password);
    }

    public function hashPassword() : void {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function generateToken() : void {
        $this->token = uniqid();
    }
}