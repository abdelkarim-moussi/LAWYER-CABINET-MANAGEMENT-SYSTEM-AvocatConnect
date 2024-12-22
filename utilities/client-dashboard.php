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
<body class="bg-gray-100">

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


<section class="px-5 bg-white shadow-md md:px-10 py-6 rounded-md mt-5">
    <h1 class="uppercase text-center font-semibold tracking-wide">your reservations</h1>
    
      <table class="mt-4 bg-white rounded-md w-full text-center shadow-md">
       
        <tr class="border-b">
            <th class="py-2 px-5">
                lawyer name
            </th>
            <th class="py-2 px-5">
                reservation date
            </th>
            <th class="py-2 px-5">
                status
            </th>

        </tr>
       <?php if(mysqli_num_rows($reservations) > 0){
       foreach( $reservations as $row){ ?>
        <tr class="border-b">
            <td class="py-2 px-5"><?php 
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
            <td class="py-2 px-5"><?php echo $row["reservation_date"] ;?></td>
            <td class="py-2 px-5"><?php echo $row["status"] ;?></td>
        </tr>
        <?php } }else echo "<p>Ops ! you haven't made any reservations yet !</p>" ?>
      </table>
     
</section>

</div>


<!-- lawyer personnal info -->

<div class="relative bg-white py-6 px-3 shadow-md rounded-md flex flex-col gap-2">
    
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

    <button type="button" name="edit" value="edit" id ="edit" class="bg-yellow-200 text-sm hover:bg-yellow-300 py-1 px-4 rounded-md uppercase font-semibold self-center absolute top-5 right-5">Edit Profile</button>
    
</div>

    <!-- edit form -->
    <div id="edit-modal" class="hidden z-10 p-6 space-y-4 md:space-y-6 sm:p-8 w-full md:max-w-[500px] mx-auto absolute top-[50%] left-[50%] translate-y-[-30%] translate-x-[-50%] bg-white shadow-md rounded-md">
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

<script src="../public/assets/js/app.js?v=<?php echo time(); ?>"></script>
</body>

</html>