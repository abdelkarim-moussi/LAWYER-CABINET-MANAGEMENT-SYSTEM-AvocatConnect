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
const confrirBtn = document.getElementById("confirm-booking")

bookingBtn.addEventListener("click",()=>{
    dateModal.classList.remove("hidden");
})
confrirBtn.addEventListener("click",()=>{
    dateModal.classList.add("hidden");
})
//function to show hide and show specified inputs for the lawyer 
console.log("menu",links);
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

function checkRole(){
role.addEventListener("change",()=>{

    for(let i = 0; i < lawyerFields.length ; i++){
    if(role.value === "lawyer"){
        lawyerFields[i].classList.remove("hidden")
    }
    else lawyerFields[i].classList.add("hidden");
        
    }
    
}
)
}

document.addEventListener("DOMContentLoaded", checkRole);