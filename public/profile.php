<?php
session_start();

include_once "../dbconnection/dbconnec.php";

//show lawyer info with the id logic

if(isset($_GET["id"])){

  $_SESSION["lawyer_id"] = $_GET["id"];
  $id = intval($_GET["id"]);
  
  $sql = mysqli_prepare($connect,"SELECT * FROM users JOIN lawyer_info WHERE users.user_id = ? AND lawyer_info.user_id = ?");
  $sql -> bind_param("ii",$id,$id);
  $sql -> execute();
  $result = $sql->get_result(); 
  
  $sql -> close();
  $connect -> close();
  
 }
 else header("Location: index.php");


// book reservation logic

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
    
            if($sql -> execute()){
                
            }
            else echo "error".'<br>' .$sql->error;
            
            unset($_POST["date"]);
            $sql -> close();
            $connect -> close();
            
        }
        
    }
    else{
        header("Location: ../signin.php");
    }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/assets/css/style.css?v=<?php echo time(); ?>">
    <script src="https://cdn.tailwindcss.com?v=<?php echo time(); ?>"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css?v=<?php echo time(); ?>" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>AvocatConnect</title>
</head>
<body class="relative">
    
<div class="flex justify-center">
<nav id="nav" class="flex z-20 items-center justify-around shadow-md shadow-green-600 text-white bg-black m-5 py-4 px-3 rounded-md fixed mx-10 top-0 w-full max-w-[900px]" >
        <h2 class="uppercase text-lg font-semibold tracking-wide">Avocat<span class="lowercase text-green-600">Connect</span></h2>
       <ul class="flex gap-10 items-center" id="links">
    <li class="cursor-pointer hover:text-green-600">
        <a href="../public/index.php">Home</a>
    </li>
    
    <?php if (!isset($_SESSION["user_id"])) { ?>
        <!-- Links for non-logged-in users -->
        <li class="cursor-pointer hover:text-green-600">
            <a href="../public/lawyers.php">Lawyers</a>
        </li>
        <li class="underline cursor-pointer hover:text-green-600">
            <a href="../public/signin.php">Login</a>
        </li>
        <li class="border border-md border-green-600 px-5 py-1 hover:bg-green-600 hover:text-white cursor-pointer rounded-md">
            <a href="../public/signup.php">Sign up</a>
        </li>
    <?php } else { ?>
        <!-- Links for logged-in users -->
        <?php if (isset($_SESSION["role"])) { ?>
            <?php if ($_SESSION["role"] === "lawyer") { ?>
                <li class="cursor-pointer hover:text-green-600">
                    <a href="../utilities/lawyer-dashboard.php">Dashboard</a>
                </li>
            <?php } elseif ($_SESSION["role"] === "client") { ?>
                <li class="cursor-pointer hover:text-green-600">
                    <a href="../public/lawyers.php">Lawyers</a>
                </li>
                <li class="cursor-pointer hover:text-green-600">
                    <a href="../utilities/client-dashboard.php">Dashboard</a>
                </li>
            <?php } ?>
        <?php } ?>
        <li class="underline cursor-pointer hover:text-green-600">
            <a href="../public/logout.php">Logout</a>
        </li>
    <?php } ?>
    </ul>

        <i id="open" class="cursor-pointer text-xl fa-solid fa-bars "></i>
        <i id="close" class="cursor-pointer text-xl fa-solid fa-xmark"></i>
    </nav>

</div>

<!-- user profile -->    

<section class="py-10 px-10 mt-20">
    <?php while($row = $result -> fetch_assoc()){ ?>
   <div class="flex flex-col items-center gap-2 pb-5">
       <img class="w-[150px] h-[150px] p-1 bg-green-600 rounded-full mx-auto" src="../uploads/<?php echo $row["image"]; ?> " alt="">
       <h3 class="text-md font-bold tracking-wide"><?php echo $row["firstname"].' '.$row["lastname"]; ?></h3>
       <p><?php echo $row["email"]; ?></p>
       <p><?php echo $row["contact_details"]; ?></p>
   </div>
   <!-- <div class="w-[250px] h-[1px] bg-gray-400 mx-auto"></div> -->
   <div class="flex flex-col gap-2 border-t border-1 py-5 px-10 shadow-md rounded-md">
        <p>phone number : <span class="font-semibold"><?php echo $row["phonenumber"]; ?></span></p>
        <p>speciality : <span class="font-semibold"><?php echo $row["speciality"]; ?></span></p>
        <p>experience : <span class="font-semibold"><?php echo $row["years_of_experience"]; ?> years of experience</span></p>
        <div>
        <p>biography : </p>
        <p class="font-semibold max-w-[600px]"><?php echo $row["biography"]; ?></p>
        </div>
        <button type="button" id="booking-btn" class="rounded-md bg-green-600 hover:bg-green-700 text-white uppercase mx-auto px-6 py-2 my-4">book consultation</button>
   </div>
   <?php } ?>
</section>


<!-- date modal -->


<!-- <div class="flex flex-col items-center justify-center px-6 mx-auto lg:py-0 my-10 w-full bg-red-500"> -->
      <div id="date-modal" class="hidden z-20 w-full max-w-[400px] bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700 fixed top-[30%] left-[50%] translate-x-[-50%]">
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
              <h1 class="text-xl border-b pb-3 text-center font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                  choose a date
              </h1>
            <form class="space-y-4 md:space-y-6" action="profile.php" method="post" id="signin-form">

                <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">date</label>
                <input type="date" name="date" id="date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com">
                <button type="submit" id="confirm-booking" class="w-full uppercase text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">confirm</button>
                 
            </form>
          </div>
      <!-- </div> -->
  </div>


<?php include_once "../utilities/footer.php" ?>