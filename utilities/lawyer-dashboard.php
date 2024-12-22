<?php
session_start();
include "../dbconnection/dbconnec.php";
include_once "../auth/auth.php";

if(!isAuthentified("lawyer")){
    header("location: ../public/index.php");
}

$stmt = mysqli_prepare ($connect,"SELECT * FROM users INNER JOIN lawyer_info WHERE users.user_id = ?");
$stmt -> bind_param("i",$_SESSION["user_id"]);
$stmt -> execute();
$result = $stmt -> get_result();

//get totale number reservations
$res = mysqli_prepare ($connect,"SELECT count(*) total FROM users INNER JOIN reservations INNER JOIN lawyer_info WHERE users.user_id = reservations.user_id and lawyer_info.user_id = ?");
$res -> bind_param("i",$_SESSION["user_id"]);
$res -> execute();
$result1 = $res -> get_result();

//reservations 
$allres = mysqli_prepare ($connect,"SELECT * FROM users INNER JOIN reservations INNER JOIN lawyer_info WHERE users.user_id = reservations.user_id and lawyer_info.user_id = ? and reservations.status = 'pending'");
$allres -> bind_param("i",$_SESSION["user_id"]);
$allres -> execute();
$reservations = $allres -> get_result();

//get pending number reservations
$pen = mysqli_prepare ($connect,"SELECT count(*) pending FROM users INNER JOIN reservations INNER JOIN lawyer_info WHERE users.user_id = reservations.user_id and lawyer_info.user_id = ? and reservations.status = 'pending'");
$pen -> bind_param("i",$_SESSION["user_id"]);
$pen -> execute();
$result2 = $pen -> get_result();

//get accepted reservations
$acc = mysqli_prepare ($connect,"SELECT count(*) accept FROM users INNER JOIN reservations INNER JOIN lawyer_info WHERE users.user_id = reservations.user_id and lawyer_info.user_id = ? and reservations.status = 'accept'");
$acc -> bind_param("i",$_SESSION["user_id"]);
$acc -> execute();
$result3 = $acc -> get_result();

//get refused reservations
$ref = mysqli_prepare ($connect,"SELECT count(*) refuse FROM users INNER JOIN reservations INNER JOIN lawyer_info WHERE users.user_id = reservations.user_id and lawyer_info.user_id = ? and reservations.status = 'refuse'");
$ref -> bind_param("i",$_SESSION["user_id"]);
$ref -> execute();
$result4 = $ref -> get_result();

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
           <li class="underline cursor-pointer hover:text-green-600"><a href="../public/logout.php">logout</a></li>
           
        </ul>
        <i id="open" class="cursor-pointer text-xl fa-solid fa-bars "></i>
        <i id="close" class="cursor-pointer text-xl fa-solid fa-xmark"></i>
    </nav>
</div>
<!-- ----------------------------- -->

<main class="pt-40 lg:pt-36 lg:p-20 p-5 grid bg-gray-100 grid-cols-1 lg:grid-cols-3 gap-5">
<?php if($row1 = $result->fetch_assoc()){ ?>
<div class="lg:col-span-2">
<h1 class="text-xl uppercase">Welcome <span class="text-green-600 lowercase"><?php echo $row1["firstname"] .' '. $row1["lastname"]; ?></span></h1>
<p class="text-gray-600">welcome back to your AvocatConnect dashboard</p>

<section class="grid grid-cols-2 lg:grid-cols-4 gap-5 my-10">
<?php if($row = $result1->fetch_assoc()){ ?>
    <div class="px-10 py-5 bg-white rounded-md shadow-sm shadow-orange-600">
        <div class="w-[30px] h-[30px] bg-blue-600 rounded-md"></div>
        <h1 class="text-2xl font-bold"><?php echo $row["total"]; ?></h1>
        <h3>total reservations</h3>
    </div>
    <?php } ?>
    <?php if($row = $result2->fetch_assoc()){ ?>
    <div class="px-10 py-5 bg-white rounded-md shadow-sm shadow-orange-600">
        <div class="w-[30px] h-[30px] bg-orange-600 rounded-md"></div>
        <h1 class="text-2xl font-bold"><?php echo $row["pending"]; ?></h1>
        <h3>pending reservations</h3>
    </div>
    <?php } ?>
    <?php if($row = $result3->fetch_assoc()){ ?>
    <div class="px-10 py-5 bg-white rounded-md shadow-sm shadow-green-600">
        <div class="w-[30px] h-[30px] bg-green-600 rounded-md"></div>
        <h1 class="text-2xl font-bold"><?php echo $row["accept"]; ?></h1>
        <h3>accepted reservations</h3>
    </div>
    <?php } ?>
    <?php if($row = $result4->fetch_assoc()){ ?>
    <div class="px-10 py-5 bg-white rounded-md shadow-sm shadow-red-600">
        <div class="w-[30px] h-[30px] bg-red-600 rounded-md"></div>
        <h1 class="text-2xl font-bold"><?php echo $row["refuse"]; ?></h1>
        <h3>refused reservations</h3>
    </div>
    <?php } ?>
</section>

<section class="bg-white rounded-md shadow-md px-5 md:px-10 py-6 rounded-md">
    <h1 class="uppercase text-center font-semibold tracking-wide">your reservations</h1>
    
      <table class="mt-4 rounded-md border border-gray-400 rounded-md w-full text-left ">
       
        <tr class="border-b border-gray-400">
            <th class="py-1 px-2">
                client name
            </th>
            <th class="py-1 px-2">
                reservation date
            </th>
            <th class="py-1 px-2">
                status
            </th>
            <th class="py-1 px-2">
                actions
            </th>

        </tr>
       <?php if(mysqli_num_rows($reservations) > 0){
       foreach( $reservations as $row){ ?>
        <tr class="border-b border-gray-400">
            <td class="py-1 px-2"><?php echo $row["firstname"].' '.$row["lastname"]; ?></td>
            <td class="py-1 px-2"><?php echo $row["reservation_date"] ;?></td>
            <td class="py-1 px-2"><?php echo $row["status"] ;?></td>
            <td class="py-1 px-2">
              <a class ="bg-green-50 rouded-md" href="../actions/lawyerActions/accept.php?id=<?php echo $row["reservation_id"]; ?> " name="accept" class="px-2 rounded-md underline uppercase text-sm text-green-600">accept</a>
              <a class ="bg-orange-50 rounded-md" href="../actions/lawyerActions/refuse.php?id=<?php echo $row["reservation_id"]; ?>" class="px-2 rounded-md underline uppercase text-sm text-orange-600">refuse</a>
            </td>
        </tr>
        <?php } }else echo "<p>Ops ! no pending reservations !</p>" ?>
      </table>
     
</section>

</div>


<!-- lawyer personnal info -->

<div class="py-6 px-3 shadow-md bg-white rounded-md flex flex-col gap-2">
    
    <img class="border border-green-600 p-1 w-[80px] h-[80px] rounded-md" src="../public/assets/img/user.png" alt="avatar">
    <h5><?php echo $row1["firstname"] .' '. $row1["lastname"]; ?></h5>
    
    <div class="flex gap-4">
        <p class="text-md font-semibold capitalize ">email : </p>
        <span class="semibold"><?php echo $row1["email"]; ?></span>
    </div>

    <div class="flex gap-4">
        <p class="text-md font-semibold capitalize ">speciality : </p>
        <span class="semibold"><?php echo $row1["speciality"]; ?></span>
    </div>
    
    <div class="flex gap-4">
        <p class="text-md font-semibold capitalize ">phone number : </p>
        <span class="semibold"><?php echo $row1["phonenumber"] ?></span>
    </div>
    <div class="flex gap-4">
        <p class="text-md font-semibold capitalize ">contact details : </p>
        <span class="semibold"><?php echo $row1["contact_details"] ?></span>
    </div>
    <div class="flex gap-4">
        <p class="text-md font-semibold capitalize ">years of experience : </p>
        <span class="semibold"><?php echo $row1["years_of_experience"] ?> years</span>
    </div>
    <div class="flex flex-col gap-1">
        <p class="text-md font-semibold capitalize ">biography : </p>
        <span class="semibold"><?php echo $row1["biography"] ?>.</span>
    </div>
    
   
</div>
<?php } ?>
</main>


<script src="../public/assets/js/app.js?v=<?php echo time(); ?>"></script>
</body>

</html>