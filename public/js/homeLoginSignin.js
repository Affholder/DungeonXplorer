console.log("homeLoginSignin.js chargé");

function openLogInPopUp() {
    document.getElementById("login-popup").style.display = "flex";
    document.getElementById("signin-popup").style.display = "none";    
}
  
function openSignInPopUp() {
    document.getElementById("login-popup").style.display = "none";
    document.getElementById("signin-popup").style.display = "flex";    
}