<?php
session_start();
$_SESSION['EMailAddress'] = NULL;

echo "<script>location.replace('index.html')</script>";
?>