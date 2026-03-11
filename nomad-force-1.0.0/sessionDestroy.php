<?php
session_start();
require_once 'config2.php';


logTask("Admin Logout");

session_unset();
session_destroy();


header("Location: /nomad-force-1.0.0/admin/login.php");
exit;
