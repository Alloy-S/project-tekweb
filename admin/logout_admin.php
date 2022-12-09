<?php 
session_start();
unset($_SESSION['login_admin']);
unset($_SESSION['username_admin']);
// $_SESSION = [];
// session_unset();
// session_destroy();

setcookie("id", "", time() - 3600);
setcookie("key", "", time() - 3600);

header("Location: login_admin.php");
exit;
?>