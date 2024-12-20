
// const semail = document.getElementById("email");
// const sfname = document.getElementById("fname");
// const slname = document.getElementById("lname");
// const sphone = document.getElementById("phone");
// const simage = document.getElementById("image");
// const srole = document.getElementById("role");
// const spassword = document.getElementById("password");
// const sconfirmPassword = document.getElementById("confirm-password");
// const sbiography = document.getElementById("biography");
// const sexperience = document.getElementById("experience");
// const scontactDetails = document.getElementById("contact-details");
// const sspeciality = document.getElementById("speciality");

// const signUp_Form = document.getElementById("signup-form");
// const signUp_button = document.getElementById("signup");


// function ErrorMessage(element, message) {
//     const inputControl = element.parentElement;
//     const displayError = inputControl.querySelector(".error");
//     displayError.innerHTML = message;
// }


// // signUp_Form.addEventListener("submit", (e) => {
// //     e.preventDefault(); // Prevent default submission behavior
  
// //     // Define the regular expressions
// //     const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
// //     const phoneRegex = /^\d{10}$/;
// //     const stringRegex = /^[a-zA-Z][a-zA-Z0-9_]{5,19}$/;
// //     const passRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
  
// //     let isValid = true; // Track overall validation status
  
// //     // Validate email
// //     if (!emailRegex.test(semail.value.trim())) {
// //       ErrorMessage(semail, "Invalid email address");
// //       isValid = false;
// //     }
  
// //     // Validate first name
// //     if (!stringRegex.test(sfname.value.trim())) {
// //       ErrorMessage(sfname, "Invalid first name");
// //       isValid = false;
// //     }
  
// //     // Validate last name
// //     if (!stringRegex.test(slname.value.trim())) {
// //       ErrorMessage(slname, "Invalid last name");
// //       isValid = false;
// //     }
  
// //     // Validate phone number
// //     if (!phoneRegex.test(sphone.value.trim())) {
// //       ErrorMessage(sphone, "Invalid phone number");
// //       isValid = false;
// //     }
  
// //     // Validate password
// //     if (!passRegex.test(spassword.value.trim())) {
// //       ErrorMessage(spassword, "Invalid password");
// //       isValid = false;
// //     }
  
// //     // Check if passwords match
// //     if (spassword.value.trim() !== sconfirmPassword.value.trim()) {
// //       ErrorMessage(sconfirmPassword, "Passwords do not match");
// //       isValid = false;
// //     }
  
// //     // Role-specific validations (if role is "lawyer")
// //     if (role.value === "lawyer") {
// //       if (!stringRegex.test(sspeciality.value.trim())) {
// //         ErrorMessage(sspeciality, "Invalid speciality");
// //         isValid = false;
// //       }
  
// //       if (!stringRegex.test(scontactDetails.value.trim())) {
// //         ErrorMessage(scontactDetails, "Invalid contact details");
// //         isValid = false;
// //       }
  
// //       if (!stringRegex.test(sbiography.value.trim()) || sbiography.value.length < 50) {
// //         ErrorMessage(sbiography, "Biography must be at least 50 characters");
// //         isValid = false;
// //       }
// //     }
  
// //     // Submit the form only if all validations pass
// //     if (isValid) {
// //       signUp_Form.submit();
// //     }
// //   });
  
