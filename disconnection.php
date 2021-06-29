<?php
session_start(); // initialise la session
session_unset(); // désactive la session
session_destroy(); // détruit la session
setcookie('log', '', time()-3444, '/', null, false , true);
header('Location: index.php');
?>