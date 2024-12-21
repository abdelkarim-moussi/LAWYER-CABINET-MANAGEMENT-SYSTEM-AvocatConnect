<?php

include_once "../dbconnection/dbconnec.php";

$sql = "SELECT * from users JOIN lawyer_info where users.user_id = lawyer_info.user_id";
$result = mysqli_query($connect,$sql);


include_once "../utilities/header.php";

?>
 <h1 class="text-white text-[3em] font-bold tracking-wider my-auto text-center uppercase max-w-[600px]">we recommend hight experienced lawyers</h1>

</header>


<section class="bg-gray-100 pb-6">
    <h1 class="text-center text-3xl font-semibold uppercase py-6">Explore our trusted lawyers</h1>
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-5 py-6 px-10">
           <?php if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
            ?>
            <div class="shadow-md rounded-md py-6 px-3 flex flex-col gap-3 justify-center items-center bg-white text-black">
                <img class="w-[100px] h-[100px] p-2 border rounded-full" src="<?php echo $row["image"] ?>" alt="lawyer image">
            <h3 class="text-md font-semibold tracking-wider text-green-600"><?php echo $row["firstname"].' '.$row["lastname"]; ?></h3 class="text-md fontsemibold">
            <p class="text-md"><?php echo $row["speciality"] ?></p>
            <p class="text-sm">with over <span class="text-green-600"><?php echo $row["years_of_experience"] ?></span> years in the domain</p>
            <a href="./profile.php?id=<?php echo $row["user_id"] ?>" class="underline tracking-wide uppercase">show profile</a>
            </div>
           <?Php } } ?>
    </div>
</section>



<?php include_once "../utilities/footer.php" ?>