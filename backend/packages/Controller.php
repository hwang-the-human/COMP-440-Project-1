<?php
class Controller
{
    public function model($model)
    {
        require_once '../backend/models/' . $model . '.php';

        return new $model();
    }

    public function view($view, $data = [])
    {
        if (file_exists('../backend/views/' . $view . '.php')) {
            require_once '../backend/views/' . $view . '.php';
        } else {
            die('View does not exist');
        }
    }
}
