<?php
session_start();
//$userid= $_SESSION['userid'];
$conn=mysqli_connect('localhost','root','Ae@8c-uIYculfdl*','hospital_queue');
if(!$conn){
    die("connection failled"
    .mysqli_connect_error());
}
?>