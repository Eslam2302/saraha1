<?php 

include 'connection.php';
include 'includes/functions/functions.php';
include 'includes/templates/header.php';

if (!isset($_SESSION['username'])) { include 'includes/templates/nav.php';}
if (isset($_SESSION['username'])) { include 'includes/templates/signnav.php';}
