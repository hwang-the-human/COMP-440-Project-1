<?php
require_once 'config/config.php';

require_once 'utils/redirect.php';
require_once 'utils/session.php';

spl_autoload_register(function ($className) {
    require_once 'packages/' . $className . '.php';
});
