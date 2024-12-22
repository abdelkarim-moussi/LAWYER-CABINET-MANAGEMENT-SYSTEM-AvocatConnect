const role = document.getElementById("role");
const signUpForm = document.getElementById("signup-form");
const lawyerFields = document.querySelectorAll(".hidden-fields")
const email = document.getElementById("email")
const navBar= document.getElementById("nav")
const links = document.getElementById("links")
const openmenu = document.getElementById("open")
const closemenu = document.getElementById("close")

const bookingBtn = document.getElementById("booking-btn");
const dateModal = document.getElementById("date-modal");
const confirmBtn = document.getElementById("confirm-booking")

const editModal = document.getElementById("edit-modal");
const editBtn = document.getElementById("edit");
//show hide menu

function showMenu (){
    links.style.top = "11vh";
    openmenu.style.display = "none";
    closemenu.style.display = "block"
}

openmenu.addEventListener("click",showMenu)

function hideMenu (){
    links.style.top = "-110vh";
    closemenu.style.display = "none";
    openmenu.style.display = "block"
}
closemenu.addEventListener("click",hideMenu)


//function to show hide and show specified inputs for the lawyer 

function checkRole(){

    for(let i = 0; i < lawyerFields.length ; i++){
    if(role.value === "lawyer"){
        lawyerFields[i].classList.remove("hidden")
    }
    else lawyerFields[i].classList.add("hidden");
        
    }

}

bookingBtn.addEventListener("click",()=>{
    dateModal.classList.remove("hidden");
})
confirmBtn.addEventListener("click",()=>{
    dateModal.classList.add("hidden");
})


//edit profile form

console.log(true);
editBtn.addEventListener("click",()=>{
  editModal.classList.remove("hidden");
})