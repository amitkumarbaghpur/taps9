<?php
session_start();
unset($_SESSION['msg']);
unset($_SESSION['error']);
header('location:'.$_GET['page']);
?>