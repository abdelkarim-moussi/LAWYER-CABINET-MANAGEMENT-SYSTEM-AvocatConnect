<?php
   session_start();
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


<header class="px-10 relative flex flex-col items-center align-center w-full">
    <nav id="nav" class="flex z-20 items-center justify-around shadow-md shadow-gray-600 text-white bg-black m-5 py-4 px-3 rounded-md fixed mx-10 top-0 w-full max-w-[900px]" >
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
    <?php } else { 
        if(isset($_SESSION["user_id"])) { ?>
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
    <?php } } ?>
    </ul>
        <i id="open" class="cursor-pointer text-xl fa-solid fa-bars "></i>
        <i id="close" class="cursor-pointer text-xl fa-solid fa-xmark"></i>
    </nav>
    

 

