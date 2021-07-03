<?php
session_start();

session_destroy();
header('Location: index.php');
//https://www.daniweb.com/programming/web-development/threads/451735/logout-code
?>
