<?php
function refuseReservation(){
    include_once "../../dbconnection/dbconnec.php";
    if(isset($_GET["id"])){
        $id = $_GET["id"];
    
        $stmt = mysqli_prepare($connect,"UPDATE reservations 
        SET status = 'refuse'
        WHERE reservation_id = ?");
        $stmt -> bind_param("i",$id);
        
        if($stmt -> execute()){
            header("Location: ../../utilities/lawyer-dashboard.php");
        }
            
    }
}

refuseReservation();

