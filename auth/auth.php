<?php

function isAuthentified($role){
        if(isset($_SESSION['user_id']) && isset($_SESSION['role'])){
            return $_SESSION['role'] == $role;
        }
        else if($role === "guest"){
            return true;
        }
    
        return false;
}

?>