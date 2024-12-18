const role = document.getElementById("role");
const signUpForm = document.getElementById("signup-form");
const lawyerFields = document.querySelectorAll(".hidden-fields")
const email = document.getElementById("email")
const navBar= document.getElementById("nav")
const links = document.querySelector("links")
const openmenu = document.getElementById("open")
const closemenu = document.getElementById("close")
//function to show hide and show specified inputs for the lawyer 
console.log("menu",openmenu);
function showMenu (){
    links.style.top = "11vh";
    openmenu.style.display = "none";
    closemenu.style.display = "block"
}

function hideMenu (){
    links.style.top = "-110vh";
    closemenu.style.display = "none";
    openmenu.style.display = "block"
}


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