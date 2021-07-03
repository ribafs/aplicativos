<?php

require_once 'config.php';

if($lang == 'en'){
    require_once 'lang/en.php';
}elseif($lang == 'pt'){
    require_once 'lang/pt.php';
}

echo $hello.', ';
echo $enter_msg;


