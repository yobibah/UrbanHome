<?php

namespace controllers;

abstract class Controllers
{
    protected function render(string $view, array $data = []): void
    {
        extract($data);
        require_once VIEW_PATH . $view . '.php';
    }

    protected function redirect(string $url): void
    {
        header("Location: $url");
        exit();
    }
}

?>