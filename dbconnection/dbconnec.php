<?php


$server = "localhost";
$dbname = "syscabinetdb";
$username = "root";
$password = "karim@mysql@25";

$connect = mysqli_connect($server,$username,$password,$dbname);

if ($connect -> connect_error){
    die("connection failed" . $connect -> connect_error);
}
