<?php
session_start();
include_once "../../dbconnection/dbconnec.php";

if(isset($_SESSION["user_id"])){
    if(isset($_POST["reservation_date"])){
        $sql = mysqli_prepare($connect,"INSERT TO resevations (user_id,resevation_date,lawyer_id) VALUES(?,?,?)");
        // $sql -> bind_param("i,d,i",);
    }
    
}



?>