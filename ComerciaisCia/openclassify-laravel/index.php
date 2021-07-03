<?php

if(!file_exists('vendor/autoload.php')){
    echo '<h3 align="center">Precisa executar antes:<br><br>composer install</h3>';
    exit();
}else{
    echo 'Acesse executando: php artisan serve';
}
