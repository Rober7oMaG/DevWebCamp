<?php

namespace Models;

class Registration extends ActiveRecord {
    protected static $table = 'registrations';
    protected static $db_columns = ['id', 'bundle_id', 'payment_id', 'token', 'user_id', 'gift_id'];

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->bundle_id = $args['bundle_id'] ?? '';
        $this->payment_id = $args['payment_id'] ?? '';
        $this->token = $args['token'] ?? '';
        $this->user_id = $args['user_id'] ?? '';
        $this->gift_id = $args['gift_id'] ?? 1;
    }
}