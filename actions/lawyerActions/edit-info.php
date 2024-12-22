<?php 
session_start();

include_once "../../dbconnection/dbconnec.php";
if(isset($_POST["edit-info"])){
    
    $id = $_SESSION["user_id"];

    global $connect;

        $firstName = trim($_POST["fname"]);
        $lastName = trim($_POST["lname"]);
        $email = trim($_POST["email"]);
        $phone = trim($_POST["phone"]);

        if($_SESSION["role"] === "lawyer"){
        $biography = trim($_POST["biography"]);
        $contactDetails = trim($_POST["contact-details"]);
        $speciality = trim($_POST["speciality"]);
        $experience = trim($_POST["experience"]);
        }
        
        //image file
        if($_FILES["image"]["error"] != 4 && !empty($_FILES["image"]) ){
            $filename = $_FILES["image"]["name"];
            $fileTmpName = $_FILES["image"]["tmp_name"];
            $newFileName = uniqid() ."-" .$filename;
            move_uploaded_file($fileTmpName,"../../uploads/".$newFileName);
        }

        // Validate inputs
        $errors = [];

        if (empty($firstName)) {
            $errors[] = "First name is required.";
        }
        elseif (empty($lastName)) {
            $errors[] = "Last name is required.";
        }
        elseif (empty($email)) {
            $errors[] = "Email is required.";
        }
        
        // stop execution if an error occurs
        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo "<script>alert({$error})</script>" . "<br>";
            }
            return; // Stop further processing if validation failed
        }
        else{
            $stmt = mysqli_prepare($connect,"UPDATE users SET firstname = ? , lastname = ?, email = ?, phonenumber = ?, image = ? WHERE user_id = ?");
            $stmt -> bind_param("sssssi",$firstName,$lastName,$email,$phone,$newFileName,$id);
            $stmt -> execute();
            
            if($_SESSION["role"] === "lawyer" ){
                $stmt = mysqli_prepare($connect,"UPDATE lawyer_info SET biography = ? , years_of_experience = ?, contact_details = ?, speciality = ? WHERE user_id = ?");
                $stmt -> bind_param("sissi",$biography,$experience,$contactDetails,$speciality,$id);
                $stmt -> execute();
            }

            echo "<script>alert('your informations changed succesfully'); document.location.href = '../../utilities/{$_SESSION['role']}-dashboard.php'</script>";
            
        }



}




