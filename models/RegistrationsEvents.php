<?php

namespace Models;

class RegistrationsEvents extends ActiveRecord {
    protected static $table = 'registrations_events';
    protected static $db_columns = ['id', 'event_id', 'registration_id'];

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->event_id = $args['event_id'] ?? '';
        $this->registration_id = $args['registration_id'] ?? '';
    }
}