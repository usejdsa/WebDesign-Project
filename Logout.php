<?php
session_start();

session_unset();
session_destroy();

setcookie('remember_me_user', '', time() - 3600, '/');

header('Location: Sign-in.php');
exit;
?>
