const role = document.getElementById("role");
const signUpForm = document.getElementById("signup-form");
const lawyerFields = document.querySelectorAll(".hidden-fields")


//function to show hide and show specified inputs for the lawyer 
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