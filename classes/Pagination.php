<?php

namespace Classes;

class Pagination {
    public $current_page;
    public $per_page_registers;
    public $total_registers;

    public function __construct($current_page = 1, $per_page_registers = 10, $total_registers = 0) {
        $this->current_page = (int) $current_page;
        $this->per_page_registers = (int) $per_page_registers;
        $this->total_registers = (int) $total_registers;
    }

    public function offset() {
        return $this->per_page_registers * ($this->current_page - 1);
    }

    public function pages_total() {
        return ceil($this->total_registers / $this->per_page_registers);
    }

    public function previous_page() {
        $previous_page = $this->current_page - 1;
        return ($previous_page > 0) ? $previous_page : false;
    }

    public function next_page() {
        $next_page = $this->current_page + 1;
        return ($next_page <= $this->pages_total()) ? $next_page : false;
    }

    public function previous_link() {
        $html = '';

        if ($this->previous_page()) {
            $html .= "<a href=\"?page={$this->next_page()}\" class=\"pagination__link pagination__link--text\">&laquo; Back</a>";
        }

        return $html;
    }

    public function next_link() {
        $html = '';

        if ($this->next_page()) {
            $html .= "<a href=\"?page={$this->next_page()}\" class=\"pagination__link pagination__link--text\">Next &raquo;</a>";
        }

        return $html;
    }

    public function pages_numbers() {
        $html = '';

        for ($i = 1; $i <= $this->pages_total(); $i++) {
            if ($i === $this->current_page) {
                $html .= "<span class=\"pagination__link pagination__link--current\">{$i}</span>";
            } else {
                $html .= "<a class=\"pagination__link pagination__link--number\" href=\"?page={$i}\">{$i}</a>";
            }
        }

        return $html;
    }

    public function create_pagination() {
        $html = '';

        if ($this->total_registers > 1) {
            $html .= '<div class="pagination">';
            $html .= $this->previous_link();
            $html .= $this->pages_numbers();
            $html .= $this->next_link();
            $html .= '</div>';
        }

        return $html;
    }
}