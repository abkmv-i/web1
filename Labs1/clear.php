<?php
session_start();
if (isset($_SESSION['data']))
    $_SESSION['data'] = array();
header('Location: index.html');
?>

