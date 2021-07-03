<?php

if(!file_exists('vendor/autoload.php')){
    echo '<h3 align="center">Precisa executar antes:<br>composer install</h3>';
    exit();
}else{
    header('location: public/');
}
