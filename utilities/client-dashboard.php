<?php
session_start();
include "../dbconnection/dbconnec.php";
include_once "../auth/auth.php";

if(!isAuthentified("client")){
    header("location: ../public/index.php");
}

$stmt = mysqli_prepare ($connect,"SELECT * FROM users WHERE users.user_id = ?");
$stmt -> bind_param("i",$_SESSION["user_id"]);
$stmt -> execute();
$result = $stmt -> get_result();

//reservations 
$allres = mysqli_prepare ($connect,"SELECT * FROM users INNER JOIN reservations WHERE users.user_id = reservations.user_id and users.user_id = ?");
$allres -> bind_param("i",$_SESSION["user_id"]);
$allres -> execute();
$reservations = $allres -> get_result();

//get the lawyer name
// $allres = mysqli_prepare ($connect,"SELECT * FROM users INNER JOIN reservations INNER JOIN lawyer_info WHERE users.user_id = reservations.user_id and users.user_id = ?");
// $allres -> bind_param("i",$_SESSION["user_id"]);
// $allres -> execute();
// $reservations = $allres -> get_result();

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

<!-- navigation menu -->

<div class="px-10 relative flex flex-col items-center align-center w-full">
    <nav id="nav" class="flex z-20 items-center justify-around shadow-md shadow-gray-600 text-white bg-black m-5 py-4 px-3 rounded-md fixed mx-10 top-0 w-full max-w-[900px]" >
        <h2 class="uppercase text-lg font-semibold tracking-wide">Avocat<span class="lowercase text-green-600">Connect</span></h2>
        <ul class="flex gap-10 items-center" id="links">

           <li class="cursor-pointer hover:text-green-600"><a href="../public/index.php">Home</a></li>
           <li class="cursor-pointer hover:text-green-600"><a href="../public/lawyers.php">Lawyers</a></li>
           <li class="underline cursor-pointer hover:text-green-600"><a href="../public/logout.php">logout</a></li>
           
        </ul>
        <i id="open" class="cursor-pointer text-xl fa-solid fa-bars "></i>
        <i id="close" class="cursor-pointer text-xl fa-solid fa-xmark"></i>
    </nav>
</div>
<!-- ----------------------------- -->

<main class="p-20 grid bg-gray-100 grid-cols-1 lg:grid-cols-3 gap-5 pt-40">
<?php if($row1 = $result->fetch_assoc()){ ?>
<div class="lg:col-span-2">
<h1 class="text-xl uppercase">Welcome <span class="text-green-600 lowercase"><?php echo $row1["firstname"] .' '. $row1["lastname"]; ?></span></h1>
<p class="text-gray-600">welcome back to your AvocatConnect dashboard</p>

<section class="bg-gray-100 px-10 py-6 rounded-md">
    <h1 class="uppercase text-center font-semibold tracking-wide">your reservations</h1>
    
      <table class="mt-4 rounded-md border border-gray-400 rounded-md w-full text-left ">
       
        <tr class="border-b border-gray-400">
            <th class="py-1 px-2">
                lawyer name
            </th>
            <th class="py-1 px-2">
                reservation date
            </th>
            <th class="py-1 px-2">
                status
            </th>

        </tr>
       <?php if(mysqli_num_rows($reservations) > 0){
       foreach( $reservations as $row){ ?>
        <tr class="border-b border-gray-400">
            <td class="py-1 px-2"><?php 
             $idl = $row["lawyer_id"];
             $stm = mysqli_prepare ($connect,"SELECT firstname , lastname from users WHERE user_id = ?");
             $stm -> bind_param("i",$idl);
             $stm -> execute();
             $res = $stm -> get_result();
             if(mysqli_num_rows($res) > 0){
                foreach( $res as $r){
                    echo $r["firstname"] .' '.$r["lastname"];
                }
                
             }

            ?></td>
            <td class="py-1 px-2"><?php echo $row["reservation_date"] ;?></td>
            <td class="py-1 px-2"><?php echo $row["status"] ;?></td>
        </tr>
        <?php } }else echo "<p>Ops ! you haven't made any reservations yet !</p>" ?>
      </table>
     
</section>

</div>


<!-- lawyer personnal info -->

<div class="py-6 px-3 shadow-md rounded-md flex flex-col gap-2">
    
    <img class="border border-green-600 p-1 w-[80px] h-[80px] rounded-md" src="../uploads/<?php echo $row1["image"]; ?>" alt="avatar">
    <h5><?php echo $row1["firstname"] .' '. $row1["lastname"]; ?></h5>
    
    <div class="flex gap-4">
        <p class="text-md font-semibold capitalize ">email : </p>
        <span class="semibold"><?php echo $row1["email"]; ?></span>
    </div>
    
    <div class="flex gap-4">
        <p class="text-md font-semibold capitalize ">phone number : </p>
        <span class="semibold"><?php echo $row1["phonenumber"] ?></span>
    </div>

    <!-- <a href="client-dashboard.php">Edit Profile</a> -->
    <button type="button" name="edit" value="Edit">Edit Profile</button>
    
   
</div>
<?php } ?>
</main>


<script src="../public/assets/js/app.js?v=<?php echo time(); ?>"></script>
</body>

</html>