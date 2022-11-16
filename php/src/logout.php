<?php
session_start();
unset($_SESSION['username']);
//unset($_SESSION['videoclub']);
unset($_SESSION['error']);
header("Location:index.php");
