<?php
session_start();
unset($_SESSION['authTrue']);
header("Location: login.php");
?>