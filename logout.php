<?php
session_start();
session_destroy();
unset($_SESSION["usuario"]);  // where $_SESSION["nome"] is your own variable. if you do not have one use only this as follow **session_unset();**
header("Location: login2.php");
?>