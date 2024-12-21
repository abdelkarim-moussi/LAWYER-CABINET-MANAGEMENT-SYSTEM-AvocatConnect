<?php
session_start();

include_once "../utilities/header.php" ?>

    <div class="absolute text-white top-[50%] translate-y-[-50%]">
    <h1 class="uppercase text-3xl font-semibold tracking-wide text-white">Welcome to Avocat<span class="lowercase text-green-600">Connect</span></h1>
    <p class="my-2">your best choice for consulting, here you will find what you need</p>
    
    <div class="flex items-center gap-5 justify-center mt-5">
    <a href="signin.php" class="text-md uppercase tracking-wide font-semibold py-2 px-5 border border-md border-white hover:border-green-600 rounded-md">login</a>
    <a href="signup.php" class="text-md uppercase tracking-wide font-semibold py-2 px-5 border border-md border-green-600 hover:bg-green-600 rounded-md">sign up</a>
    </div>
    </div>
</header>

<section class="grid lg:grid-cols-2 bg-black text-white py-10 px-6">
<div>
<h1 class=" text-3xl font-semibold uppercase py-5">Who we are</h1>
    <p class="pb-6">Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero, repudiandae. Consequatur repudiandae nisi, excepturi similique officia ipsam tempora modi quos?</p>
    <a href="#" class="text-md uppercase tracking-wide font-semibold py-2 px-5 border border-md border-white hover:border-green-600 rounded-md">Email us</a>
</div>    
</section>


<!-- services section -->
<section class="pb-12 pt-6 px-10">
    <h1 class="text-center text-3xl font-semibold uppercase py-6">What we can do for you ?</h1>
    <div class="grid grid-cols-2 lg:grid-cols-4 grid gap-5">
        <div class="border border-green-600 px-3 py-6 flex flex-col items-center justify-center gap-3 rounded-md">
            <h4 class="font-bold uppercase">excutives & employees</h4>
            <div class="w-[90px] h-[90px] border border-green-600 rounded-md p-2"><img src="../public/assets/img/process.png" alt=""></div>
        </div>
        <div class="border border-green-600 px-3 py-6 flex flex-col items-center justify-center gap-3 rounded-md">
            <h4 class="font-bold uppercase">Sexual Harassment</h4>
            <div class="w-[90px] h-[90px] border border-green-600 rounded-md p-2"><img src="../public/assets/img/sexual-harassment-icon.png" alt=""></div>
        </div>
        <div class="border border-green-600 px-3 py-6 flex flex-col items-center justify-center gap-3 rounded-md">
            <h4 class="font-bold uppercase">Equal Pay</h4>
            <div class="w-[90px] h-[90px] border border-green-600 rounded-md p-2"><img src="../public/assets/img/equality.png" alt=""></div>
        </div>
        <div class="border border-green-600 px-3 py-6 flex flex-col items-center justify-center gap-3 rounded-md">
            <h4 class="font-bold uppercase">Litigation</h4>
            <div class="w-[90px] h-[90px] border border-green-600 rounded-md p-2"><img src="../public/assets/img/litigation.png" alt=""></div>
        </div>
        <div class="lg:col-start-2 border border-green-600 px-3 py-6 flex flex-col items-center justify-center gap-3 rounded-md">
            <h4 class="font-bold uppercase">Employment Agreements</h4>
            <div class="w-[90px] h-[90px] border border-green-600 rounded-md p-2"><img src="../public/assets/img/contract.png" alt=""></div>
        </div>
        <div class="border border-green-600 px-3 py-6 flex flex-col items-center justify-center gap-3 rounded-md">
            <h4 class="font-bold uppercase">Counseling</h4>
            <div class="w-[90px] h-[90px] border border-green-600 rounded-md p-2"><img src="../public/assets/img/contract (1).png" alt=""></div>
        </div>
    </div>
</section>

<!-- contact section -->
<section class="bg-black text-white flex flex-col justify-center items-center gap-5 pb-8 pt-6">
   <h1 class="text-center text-3xl font-semibold uppercase py-6">We are here to help</h1>
   <a href="#" class="text-md uppercase tracking-wide font-semibold py-2 px-5 border border-md border-green-600 hover:bg-green-600 rounded-md">contact us</a>
   <div class="flex gap-3">
    <p class="underline text-md border-r px-3">(+212) 629411283</p>
    <p class="underline text-md">info@AvocatConnect.com</p>
   </div> 
   <div class="w-[70%] h-[1px] mx-auto my-5 bg-gray-300"></div>
</section>

<?php include_once "../utilities/footer.php" ?>