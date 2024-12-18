<?php
 session_start();

function formValidation(){
    
    include "../dbconnection/dbconnec.php";

    if ($_SERVER["REQUEST_METHOD"] === "POST"){

        // Get the form inputs using global POST variables
        $firstName = trim($_POST["fname"]);
        $lastName = trim($_POST["lname"]);
        $email = trim($_POST["email"]);
        $image = trim($_POST["image"]);
        $role = trim($_POST["role"]);
        $password = md5(trim($_POST["password"]));
        $confirmPassword = md5(trim($_POST["confirm-password"]));
        $phone = trim($_POST["phone"]);

        
        // Validate inputs
        $errors = [];

        if (empty($firstName)) {
            $errors[] = "First name is required.";
        }
        if (empty($lastName)) {
            $errors[] = "Last name is required.";
        }
        if (empty($email)) {
            $errors[] = "Email is required.";
        }
        if (empty($phone)) {
            $errors[] = "Phone number is required.";
        }
        if (empty($image)) {
            $errors[] = "image is required.";
        }
        if ($password != $confirmPassword) {
            $errors[] = "passwords not match";
        }

        // stop execution if an error occurs
        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo $error . "<br>";
            }
            return; // Stop further processing if validation failed
        }

        // insert to database if validation success
            $userstmt = mysqli_prepare($connect,"INSERT INTO users (firstname, lastname, email, phonenumber, password, image, role) VALUES(?,?,?,?,?,?,?)");
            $userstmt -> bind_param("sssssbs",$firstName,$lastName,$email,$phone,$password,$image,$role);
            $userstmt->execute();
            //---stock the last added member in the session variable
            $last_id = mysqli_insert_id($connect);
             
            echo "<script> alert('you reservation is success') </script>";
            $userstmt->close();
            
            //session variables
            $_SESSION['username'] = $lastName." ".$firstName;
            $_SESSION["email"] = $email;
            $_SESSION["password"] = $password;
            $_SESSION["userid"] = $last_id;

        $firstName =  $lastName = $email = $phone = $role = $image = $password = $confirmPassword =  "";
        
        header("Location:signin.php");

    }
}

formValidation();


?>


<?php include_once "../utilities/header.php" ?>

<!-- sign up form -->
    <!-- <section class="bg-gray-50 dark:bg-gray-900 "> -->
  <div class="flex flex-col items-center justify-center px-6 mx-auto lg:py-0 my-10">
      <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
              <h1 class="text-xl border-b pb-3 text-center font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                  Create an account
              </h1>
            <form class="space-y-4 md:space-y-6" action="signup.php" method="post" id="signup-form">
                 <div class="flex gap-5">
                 <div class="flex-1">
                      <label for="fname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">first name</label>
                      <input type="text" name="fname" id="fname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com">
                  </div>
                  <div class="flex-1">
                      <label for="lname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">last name</label>
                      <input type="text" name="lname" id="lname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com">
                  </div>
                 </div>
                  <div>
                      <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">email</label>
                      <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com">
                  </div>
                <div>
                    <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">image</label>
                    <input type="file" name="image" id="image" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com">
                </div>
                <div>
                    <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">phone number</label>
                    <input type="text" name="phone" id="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com">
                </div>

                <div>
                <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">role</label>
                <select name="role" id="role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="client">Client</option>
                    <option value="lawyer">Lawyer</option>
                </select>
                </div>
                <div class="hidden-fields hidden">
                    <label for="biography" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">biography</label>
                    <textarea name="biography" id="biography" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="biographie..."></textarea>
                </div>
                <div class="hidden-fields hidden">
                    <label for="experience" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">years of experience</label>
                    <input type="number" name="experience" id="experience" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="10">
                </div>
                <div class="hidden-fields hidden">
                    <label for="contact-details" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">contact details</label>
                    <input type="text" name="contact-details" id="contact-details" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="country , city , adress , phone number ">
                </div>
                <div class="hidden-fields hidden">
                    <label for="speciality" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">speciality</label>
                    <input type="text" name="speciality" id="speciality" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="biographie...">
                </div>
                <div class="flex gap-5">
                  <div class="flex-1">
                      <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                      <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                  </div>
                  <div class="flex-1">
                      <label for="confirm-password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm password</label>
                      <input type="confirm-password" name="confirm-password" id="confirm-password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                  </div>
                </div>
                  <button type="submit" id="signup" class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Create an account</button>
                  <p class="text-sm text-center font-light text-gray-500 dark:text-gray-400">
                      Already have an account? <a href="#" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Login here</a>
                  </p>
            </form>
          </div>
      </div>
  </div>
<!-- </section> -->

</header>



<script src="./assets/js/app.js"></script>
</body>
</html>