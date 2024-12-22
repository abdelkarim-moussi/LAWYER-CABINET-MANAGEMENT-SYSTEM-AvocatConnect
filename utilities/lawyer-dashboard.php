<?php
session_start();
include "../dbconnection/dbconnec.php";
include_once "../auth/auth.php";

if(!isAuthentified("lawyer")){
    header("location: ../public/index.php");
}

$stmt = mysqli_prepare ($connect,"SELECT * FROM users INNER JOIN lawyer_info WHERE users.user_id = lawyer_info.user_id AND users.user_id = ?");
$stmt -> bind_param("i",$_SESSION["user_id"]);
$stmt -> execute();
$result = $stmt -> get_result();

//get totale number reservations
$res = mysqli_prepare ($connect,"SELECT count(*) total FROM reservations INNER JOIN lawyer_info WHERE reservations.lawyer_id = lawyer_info.user_id and lawyer_info.user_id = ?");
$res -> bind_param("i",$_SESSION["user_id"]);
$res -> execute();
$result1 = $res -> get_result();

//reservations 
$allres = mysqli_prepare ($connect,"SELECT * FROM users INNER JOIN reservations WHERE reservations.user_id = users.user_id and reservations.lawyer_id = ? and reservations.status = 'pending'");
$allres -> bind_param("i",$_SESSION["user_id"]);
$allres -> execute();
$reservations = $allres -> get_result();

//get pending number reservations
$pen = mysqli_prepare ($connect,"SELECT count(*) pending FROM reservations INNER JOIN lawyer_info WHERE reservations.lawyer_id = lawyer_info.user_id and lawyer_info.user_id = ? and reservations.status = 'pending'");
$pen -> bind_param("i",$_SESSION["user_id"]);
$pen -> execute();
$result2 = $pen -> get_result();

//get accepted reservations
$acc = mysqli_prepare ($connect,"SELECT count(*) accept FROM reservations INNER JOIN lawyer_info WHERE reservations.lawyer_id = lawyer_info.user_id and lawyer_info.user_id = ? and reservations.status = 'accept'");
$acc -> bind_param("i",$_SESSION["user_id"]);
$acc -> execute();
$result3 = $acc -> get_result();

//get refused reservations
$ref = mysqli_prepare ($connect,"SELECT count(*) refuse FROM reservations INNER JOIN lawyer_info WHERE reservations.lawyer_id = lawyer_info.user_id and lawyer_info.user_id = ? and reservations.status = 'refuse'");
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
    
      <table class="mt-4 rounded-md w-full text-center shadow-md">
       
        <tr class="border-b">
            <th class="py-2 px-5">
                client name
            </th>
            <th class="py-2 px-5">
                reservation date
            </th>
            <th class="py-2 px-5">
                status
            </th>
            <th class="py-2 px-5">
                actions
            </th>

        </tr>
       <?php if(mysqli_num_rows($reservations) > 0){
       foreach( $reservations as $row){ ?>
        <tr class="border-b">
            <td class="py-2 px-5"><?php echo $row["firstname"].' '.$row["lastname"]; ?></td>
            <td class="py-2 px-5"><?php echo $row["reservation_date"] ;?></td>
            <td class="py-2 px-5"><?php echo $row["status"] ;?></td>
            <td class="py-2 px-5 flex gap-5">
              <a class ="bg-green-50 rounded-md hover:bg-green-100 px-2" href="../actions/lawyerActions/accept.php?id=<?php echo $row["reservation_id"]; ?> " name="accept" class="px-2 rounded-md underline uppercase text-sm text-green-600">accept</a>
              <a class ="bg-orange-50 rounded-md hover:bg-orange-100 px-2" href="../actions/lawyerActions/refuse.php?id=<?php echo $row["reservation_id"]; ?>" class="px-2 rounded-md underline uppercase text-sm text-orange-600">refuse</a>
            </td>
        </tr>
        <?php } }else echo "<p>Ops ! no pending reservations !</p>" ?>
      </table>
     
</section>

</div>


<!-- lawyer personnal info -->

<div class="py-6 px-3 shadow-md bg-white rounded-md flex flex-col gap-2">
    
    <img class="border border-green-600 p-1 w-[80px] h-[80px] rounded-md" src="../uploads/<?php echo $row1["image"];?>" alt="avatar">
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
        <span class="semibold"><?php echo $row1["biography"] ?></span>
    </div>
    
    <button type="button" name="edit" value="edit" id ="edit" class="bg-yellow-200 text-sm hover:bg-yellow-300 py-1 px-4 rounded-md uppercase font-semibold self-center">Edit Profile</button>
   
</div>

    <!-- edit form -->
    <div id="edit-modal" class="hidden z-10 p-6 space-y-4 md:space-y-6 sm:p-8 w-full md:max-w-[500px] mx-auto absolute top-[50%] left-[50%] translate-y-[-20%] translate-x-[-50%] bg-white shadow-md rounded-md">
          <img src="../public/assets/img/fermer.png" alt="close" class="w-[30px] float-end cursor-pointer" id="close-modal">
              <h1 class="text-xl border-b pb-3 text-center font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                  Update Your Informations
              </h1>
            <form class="space-y-4 md:space-y-6" action="../actions/lawyerActions/edit-info.php" method="post" enctype="multipart/form-data">
                 <div class="flex gap-5">
                  <div class="flex-1">
                      <label for="fname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">first name</label>
                      <input type="text" name="fname" value ="<?php echo $row1["firstname"]; ?>" id="fname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="">
                  </div>
                  <div class="flex-1">
                      <label for="lname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">last name</label>
                      <input type="text" name="lname" value ="<?php echo $row1["lastname"]; ?>" id="lname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="">
                  </div>
                 </div>
                  <div>
                      <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">email</label>
                      <input type="email" name="email" value ="<?php echo $row1["email"]; ?>" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com">
                      <div class="error text-sm text-red-600"></div>
                  </div>
                <div>
                    <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">image</label>
                    <input type="file" name="image" id="image" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="">
                    <div class="error text-sm text-red-600"></div>
                </div>
                <div>
                    <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">phone number</label>
                    <input type="text" name="phone" value ="<?php echo $row1["phonenumber"]; ?>" id="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="">
                    <div class="error text-sm text-red-600"></div>
                </div>
                <div>
                    <label for="biography" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">biography</label>
                    <textarea name="biography" value ="<?php echo $row1["biography"]; ?>" id="biography" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="biographie..."></textarea>
                    <div class="error text-sm text-red-600"></div>
                </div>
                <div >
                    <label for="experience" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">years of experience</label>
                    <input type="number" name="experience" value ="<?php echo $row1["years_of_experience"]; ?>" id="experience" min="2" max ="40" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="10">
                    <div class="error text-sm text-red-600"></div>
                </div>
                <div >
                    <label for="contact-details" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">contact details</label>
                    <input type="text" name="contact-details" value ="<?php echo $row1["contact_details"]; ?>" id="contact-details" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="country , city , adress , phone number ">
                    <div class="error text-sm text-red-600"></div>
                </div>
                <div>
                    <label for="speciality" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">speciality</label>
                    <input type="text" name="speciality" value ="<?php echo $row1["speciality"]; ?>" id="speciality" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="harassement">
                    <div class="error text-sm text-red-600"></div>
                </div>

                <button type="submit" name="edit-info" id="sub" class="w-full uppercase tracking-wide text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Continue</button>
            </form>
    </div>

    <?php } ?>
</main>


  <script>

  //edit profile form

     const editModal = document.getElementById("edit-modal");
     const editBtn = document.getElementById("edit");
     editBtn.addEventListener("click",()=>{
     editModal.classList.remove("hidden");
     })

     document.getElementById("close-modal").addEventListener("click",()=>{
        editModal.classList.add("hidden")
     })


  </script>


<script src="../public/assets/js/app.js?v=<?php echo time();?>"></script>
</body>

</html>