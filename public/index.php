<?php include_once "../utilities/header.php" ?>

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
    <a href="signin.php" class="text-md uppercase tracking-wide font-semibold py-2 px-5 border border-md border-white hover:border-green-600 rounded-md">login</a>
</div>    
</section>
<section class="py-10 px-6">
    <h1 class="text-center text-3xl font-semibold uppercase py-6">What we can do for you ?</h1>
    <div class="grid grid-cols-2 lg:grid-cols-4 grid gap-5">
        <div class="border border-green-600 px-3 py-4 flex flex-col items-center justify-center gap-3 rounded-md">
            <h4 class="font-bold uppercase">excutives & employees</h4>
            <div class="w-[40px] h-[40px] bg-green-600 rounded-md"></div>
        </div>
        <div class="border border-green-600 px-3 py-4 flex flex-col items-center justify-center gap-3 rounded-md">
            <h4 class="font-bold uppercase">Sexual Harassment</h4>
            <div class="w-[40px] h-[40px] bg-green-600 rounded-md"></div>
        </div>
        <div class="border border-green-600 px-3 py-4 flex flex-col items-center justify-center gap-3 rounded-md">
            <h4 class="font-bold uppercase">Equal Pay</h4>
            <div class="w-[40px] h-[40px] bg-green-600 rounded-md"></div>
        </div>
        <div class="border border-green-600 px-3 py-4 flex flex-col items-center justify-center gap-3 rounded-md">
            <h4 class="font-bold uppercase">Litigation</h4>
            <div class="w-[40px] h-[40px] bg-green-600 rounded-md"></div>
        </div>
        <div class="col-start-2 border border-green-600 px-3 py-4 flex flex-col items-center justify-center gap-3 rounded-md">
            <h4 class="font-bold uppercase">Employment Agreements</h4>
            <div class="w-[40px] h-[40px] bg-green-600 rounded-md"></div>
        </div>
        <div class="border border-green-600 px-3 py-4 flex flex-col items-center justify-center gap-3 rounded-md">
            <h4 class="font-bold uppercase">Counseling</h4>
            <div class="w-[40px] h-[40px] bg-green-600 rounded-md"></div>
        </div>
    </div>
</section>
<script src="../public/assets/js/app.js?v=<?php echo time(); ?>"></script>
</body>
</html>