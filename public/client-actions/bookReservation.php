<?php
session_start();
include_once "../../dbconnection/dbconnec.php";

if(isset($_POST["date"]) && !empty($_POST["date"])){

$_SESSION["reservation_date"] = $_POST["date"];

if(isset($_SESSION["user_id"])){

    if(isset($_SESSION["reservation_date"])){

        $date_input = strtotime($_SESSION["reservation_date"]);
        $date = date('y-m-d',$date_input);
        $client_id = $_SESSION["user_id"];
        $lawyer_id = $_SESSION["lawyer_id"];

        echo  "$date <br> $client_id<br>$lawyer_id";

        $sql = $connect -> prepare("INSERT INTO reservations (user_id,reservation_date,lawyer_id) VALUES(?,?,?)");
        $sql -> bind_param("isi",$client_id,$date,$lawyer_id);

        unset($_POST["date"]);

        if($sql -> execute()){
            echo "done";
        }
        else echo "error".'<br>' .$sql->error;

        $sql -> close();
        $connect -> close();
        
    }
    
}
}



?>