<?php
require_once 'auth.php';
session_start();

$auth = new Auth();
$auth->logout();

// Redirigir al login
header('Location: login.php');
exit; 