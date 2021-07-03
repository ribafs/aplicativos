<?php

define('APP_NAME',          'PHPSTORE');
define('APP_VERSION',       '1.0.0');

define('BASE_URL',          'http://backup/Comerciais/PHPSTORE/public/');

// MYSQL
define('MYSQL_SERVER',      'localhost');
define('MYSQL_DATABASE',    'testes2');
define('MYSQL_USER',        'root');
define('MYSQL_PASS',        '');
define('MYSQL_CHARSET',     'utf8');

// AES encriptação
define('AES_KEY',           'qs8BzdLD8N7qJgqJ3qmGsuh8HMhCWqG4');
define('AES_IV',            'WSzH6HcdZAYdQ9be');

// mail
require_once 'email.php';
define('EMAIL_HOST',        'smtp.gmail.com');
define('EMAIL_FROM',        'ribafs@gmail.com');
define('EMAIL_PASS',        'zmxn1029G@');
define('EMAIL_PORT',        587);
