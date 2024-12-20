<?php
session_start();

include_once "../dbconnection/dbconnec.php";
if(isset($_GET["id"])){

  $_SESSION["lawyer_id"] = $_GET["id"];
  $id = intval($_GET["id"]);
  
  $sql = mysqli_prepare($connect,"SELECT * FROM users JOIN lawyer_info WHERE users.user_id = ? AND lawyer_info.user_id = ?");
  $sql -> bind_param("ii",$id,$id);
  $sql -> execute();
  $result = $sql->get_result(); 

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
<body>
    
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
       <img class="w-[150px] h-[150px] p-1 bg-green-600 rounded-full mx-auto" src="../public//assets/img/team2.jpg " alt="">
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
        <a href="#" class="rounded-md bg-green-600 hover:bg-green-700 text-white uppercase mx-auto px-6 py-2 my-4">book consultation</a>
   </div>
   <?php } ?>
</section>



<?php include_once "../utilities/footer.php" ?>