<?php
session_start();
include_once "../../dbconnection/dbconnec.php";

if(isset($_POST["edit-dispo"])){
    global $connect;

    if(isset($_POST["startdate"])){
        if(isset($_POST["enddate"])){

            $id = $_SESSION["user_id"];

            $sdateInput = strtotime($_POST["startdate"]);
            $edateInput = strtotime($_POST["enddate"]);

            $startDate = date('y-m-d',$sdateInput);
            $endDate = date('y-m-d',$edateInput);
            // echo $id  ."<br>".$startDate ."<br>".$endDate;

            $stmt = mysqli_prepare($connect,"INSERT INTO availability (lawyer_id,start_date,end_date) VALUES(?,?,?)");
            $stmt -> bind_param('iss',$id,$startDate,$endDate);
            if($stmt -> execute()){

                echo "<script>alert('your disponibility has been updated !')</script>";
            }

            
        }
    }
}