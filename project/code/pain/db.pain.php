<?php
include_once "pain\db.pain.php";
$servername="localhost";
$dBUsername="root";
$dBpassword="";
$dBName="loginsystem";
$conn=mysqli_connect($servername,$dBUsername,$dBpassword,$dBName);
if (!$conn) {
    die("connection failed".mysqli_connect_error());
}