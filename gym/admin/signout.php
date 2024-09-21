<?php
session_start();
//Way 1
//Xoa tung bien Session
//unset($_SESSION["username"]);
//unset($_SESSION["fullname"]);
//unset($_SESSION["employeeID"]);
//header("location:login.php");
//Way 2
//Xoa toan bo session
session_unset();
header("location:../index.php");
