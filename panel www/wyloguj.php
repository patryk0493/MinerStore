<?php
session_start();
ob_start();
$_SESSION['logged_in'] = "0";
$_SESSION['admin'] = "0";
header("Location: index.php");
ob_flush();
?>