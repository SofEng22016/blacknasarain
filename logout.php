<?php
session_start();
session_destroy();
$msg ="You have successfully logged out.";
header("Location: index.php?msg=$msg");
?>