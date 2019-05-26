<?php
session_start();
if(!(isset($_SESSION["username"]) or isset($_SESSION["registration_no"])) ){
    echo"<center><font color='red'><h1>Unauthorized to access this file<h1><center>";
echo"<script>function redirect(){
window.location='../index.php';
}setInterval(redirect,1000);</script>";
exit(); }
?>