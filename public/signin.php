<?php

include_once "../dbconnection/dbconnec.php";
include_once "../auth/auth.php";


$emailerror = "";

if($_SERVER["REQUEST_METHOD"] === "POST"){

if(!empty($_POST["email"]) && $_POST["password"]){

$email = $_POST["email"];
$password = md5($_POST["password"]);

$stm = mysqli_prepare($connect,"SELECT email, password FROM users WHERE email = ? and password = ?");
$stm -> bind_param("ss",$email,$password);
$stm->execute();

$result = $stm->get_result();


if($row = $result->fetch_assoc()){

    $db_pass = $row["password"];
    $db_email = $row["email"];

    if($email === $db_email && $password === $db_pass){
        if(isAuthentified("lawyer")){
            header("Location : ../utilities/lawyer-dashboard.ph");
        }
    }

}
}


}

?>



<?php include_once "../utilities/header.php"; ?>

   <!-- sign in form -->
   <div class="flex flex-col items-center justify-center px-6 mx-auto lg:py-0 my-10 w-full mt-[150px]">
      <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
              <h1 class="text-xl border-b pb-3 text-center font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                  log in
              </h1>
            <form class="space-y-4 md:space-y-6" action="signin.php" method="post" id="signin-form">
                <div class="text-red-600"><?php echo $emailerror;?></div>
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">email</label>
                    <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com">
                </div>
                  <div>
                      <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                      <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                  </div>
                  
                  <button type="submit" id="signin" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Login</button>
                  <p class="text-sm text-center font-light text-gray-500 dark:text-gray-400">
                      don't have an account? <a href="signup.php" class="font-medium text-primary-600 hover:underline dark:text-primary-500">sign up here</a>
                  </p>
            </form>
          </div>
      </div>
  </div>
    
</header>

<script src="../public/assets/js/app.js?v=<?php echo time(); ?>"></script>
</body>
</html>