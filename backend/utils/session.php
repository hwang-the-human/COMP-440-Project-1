<?php
session_start();

// Set and display flash messages
function setFlashMessage($name = '', $message = '', $class = 'alert alert-success')
{
    if (!empty($name)) {
        if (!empty($message) && empty($_SESSION[$name])) {
            $_SESSION[$name] = $message;
            $_SESSION[$name . 'Class'] = $class;
        } elseif (empty($message) && !empty($_SESSION[$name])) {
            $class = !empty($_SESSION[$name . 'Class']) ? $_SESSION[$name . 'Class'] : '';
            echo '<div class="' . $class . '" id="msg-flash">' . $_SESSION[$name] . '</div>';
            unset($_SESSION[$name]);
            unset($_SESSION[$name . 'Class']);
        }
    }
}

// Check if a user is authenticated
function isAuthenticated()
{
    if (isset($_SESSION['username'])) {
        return true;
    } else {
        return false;
    }
}
