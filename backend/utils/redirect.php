<?php
function redirect($location)
{
    header('Location: ' . URLROOT . '/' . $location);
}
