<?php
session_start();
include "../dbconnection/dbconnec.php";
include_once "../auth/auth.php";

if(!isAuthentified("lawyer")){
    header("location: ../public/index.php");
}

$stmt = mysqli_prepare ($connect,"SELECT * FROM users WHERE user_id = ?");
$stmt -> bind_param("i",$_SESSION["user_id"]);
$stmt -> execute();
$result = $stmt -> get_result();

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
    <nav id="nav" class="flex z-20 items-center justify-around shadow-md shadow-green-600 text-white bg-black m-5 py-4 px-3 rounded-md fixed mx-10 top-0 w-full max-w-[900px]" >
        <h2 class="uppercase text-lg font-semibold tracking-wide">Avocat<span class="lowercase text-green-600">Connect</span></h2>
        <ul class="flex gap-10 items-center" id="links">

           <li class="cursor-pointer hover:text-green-600"><a href="../public/index.php">Home</a></li>
           <li class="underline cursor-pointer hover:text-green-600"><a href="../public/logout.php">logout</a></li>
           
        </ul>
        <i id="open" class="cursor-pointer text-xl fa-solid fa-bars "></i>
        <i id="close" class="cursor-pointer text-xl fa-solid fa-xmark"></i>
    </nav>
</div>
<!-- ----------------------------- -->

<main class="p-20 bg-black grid grid-cols-1 lg:grid-cols-3 gap-5 pt-40">
<div class="lg:col-span-2">
<h1 class="text-white text-xl uppercase">Welcome <span class="text-green-600 lowercase">username</span></h1>
<p class="text-gray-200">welcome back to your AvocatConnect dashboard</p>
<section class="grid grid-cols-2 lg:grid-cols-3 gap-10 my-10">
    <div class="px-10 py-6 bg-white rounded-md shadow-sm shadow-orange-600">
        <div class="w-[30px] h-[30px] bg-orange-600 rounded-md"></div>
        <h1 class="text-2xl font-bold">12</h1>
        <h3>total reservations</h3>
    </div>
    <div class="px-10 py-6 bg-white rounded-md shadow-sm shadow-green-600">
        <div class="w-[30px] h-[30px] bg-green-600 rounded-md"></div>
        <h1 class="text-2xl font-bold">8</h1>
        <h3>accepted reservations</h3>
    </div>
    <div class="px-10 py-6 bg-white rounded-md shadow-sm shadow-red-600">
        <div class="w-[30px] h-[30px] bg-red-600 rounded-md"></div>
        <h1 class="text-2xl font-bold">4</h1>
        <h3>refused reservations</h3>
    </div>
</section>

<section class="bg-gray-100 px-10 py-6 rounded-md">
    <h1 class="uppercase text-center font-semibold tracking-wide">your reservations</h1>
    
      <table class="mt-4 rounded-md border border-gray-400 rounded-md w-full text-left ">
       
        <tr class="border-b border-gray-400">
            <th class="py-1 px-2">
                client name
            </th>
            <th>
                reservation date
            </th>
            <th>
                status
            </th>
        </tr>
   
        <tr class="border-b border-gray-400">
            <td class="py-1 px-2">Jhon</td>
            <td>12/23/2024</td>
            <td>refused</td>
        </tr>
   
      </table>
</section>

</div>


<!-- lawyer personnal info -->
<div class="py-6 px-3 bg-gray-100 rounded-md flex flex-col gap-2">
    <img class="bg-green-600 p-1 w-[40px] h-[40px] rounded-md" src="../public/assets/img/user.png" alt="avatar">
    <h5>user name</h5>
    <div class="flex gap-4">
        <p class="text-md text-green-600 font-semibold capitalize ">speciality : </p>
        <span class="semibold">My speciality</span>
    </div>
    <div class="flex gap-4">
        <p class="text-md text-green-600 font-semibold capitalize ">email : </p>
        <span class="semibold">example@gmail.com</span>
    </div>
    <div class="flex gap-4">
        <p class="text-md text-green-600 font-semibold capitalize ">phone number : </p>
        <span class="semibold">+212 681972108</span>
    </div>
    <div class="flex gap-4">
        <p class="text-md text-green-600 font-semibold capitalize ">email : </p>
        <span class="semibold">example@gmail.com</span>
    </div>
    <div class="flex gap-4">
        <p class="text-md text-green-600 font-semibold capitalize ">years of experience : </p>
        <span class="semibold">10 years</span>
    </div>
    <div class="flex flex-col gap-1">
        <p class="text-md text-green-600 font-semibold capitalize ">biography : </p>
        <span class="semibold">Lorem ipsum dolor sit amet consectetur adipisicing elit. Earum esse officiis ratione molestiae ipsa ad.</span>
    </div>
    
    
</div>


</main>


<script src="../public/assets/js/app.js?v=<?php echo time(); ?>"></script>
</body>

</html>