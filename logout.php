<?php
session_start();
session_destroy();
header("Location: asmC2/login.php");
exit();
