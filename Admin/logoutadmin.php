<?php
require_once('../global.php');
session_destroy();
header("Location: adminlogin.php");
?>