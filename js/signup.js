document.getElementById("signup-btn").onclick = function () {
    if (account_type.value == "") {
        document.getElementById("SPaccount").innerHTML = "Account type required *";
        document.getElementById("SPaccount").style.display = "block";
        document.getElementById("SPaccount").style.color = "red";
      //  return false;
    }
    if (username.value == "") {
        document.getElementById("SPusername").innerHTML = "Username is required *";
        document.getElementById("SPusername").style.display = "block";
        document.getElementById("SPusername").style.color = "red"; 
        
       // return false;
    }
    if (email.value == "") {
        document.getElementById("SPemail").innerHTML = "Email is required *";
        document.getElementById("SPemail").style.display = "block";
        document.getElementById("SPemail").style.color = "red";
      //  return false;
    }
    if (password.value == "") {
        document.getElementById("SPpassword").innerHTML = "Password is required *";
        document.getElementById("SPpassword").style.display = "block";
        document.getElementById("SPpassword").style.color = "red";
        //return false;
    }
    if (confirm_password.value == "") {
        document.getElementById("SPcpassword").innerHTML = "Confirm Password is required *";
        document.getElementById("SPcpassword").style.display = "block";
        document.getElementById("SPcpassword").style.color = "red";
        return false; 
    }
}   

//onkeyup javascript events

document.getElementById("account_type").oninput = function () {
    if (account_type.value == "Employee") {
        document.getElementById("SPaccount").style.display = "none";
        return true;
    }
    if (account_type.value == "Client") {
        document.getElementById("SPaccount").style.display = "none";
        return true;
    }
    if (account_type.value=="") {
        document.getElementById("SPaccount").style.display = "block";
        return false;
    }
}

document.getElementById("username").onkeyup = function () {
    //var user = 5;
    if (username.value == ""){
        document.getElementById("SPusername").innerHTML = "Username is required *";
        document.getElementById("SPusername").style.display ="block";
        document.getElementById("SPusername").style.color = "red";

    }
    else if (username.value.length > 5) {
        document.getElementById("usernameico").style.display = "none";
        document.getElementById("SPusername").style.display = "none";
        return true;
    }
    else if (username.value.length <5) {
        document.getElementById("SPusername").innerHTML = "Username require atleast 5 character *";
        document.getElementById("SPusername").style.display = "block";
        document.getElementById("SPusername").style.color = "red";
        document.getElementById("usernameico").style.display = "none";
        return false;
    }

     else {
        document.getElementById("SPusername").style.display = "none";
        return true;
    }
}

document.getElementById("email").onkeyup = function () {
    var pattern = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (email.value == "") {
        document.getElementById("SPemail").innerHTML = "Email is required *";
        document.getElementById("SPemail").style.display = "block";
        document.getElementById("SPemail").style.color = "red";
    }
    else if (email.value.match(pattern)) {
        document.getElementById("SPemail").style.display = "none";
        return true;
    }else{
        document.getElementById("SPemail").innerHTML = "Please provide a valid email address *";
        document.getElementById("SPemail").style.display = "block";
        document.getElementById("SPemail").style.color = "red";
        return false;
    }          
}

document.getElementById("password").onkeyup = function () {
    var passlength = 6
    if (password.value == ""){
        document.getElementById("SPpassword").innerHTML = "Password is required *";
        document.getElementById("SPpassword").style.display = "block";
        document.getElementById("SPpassword").style.color = "red";
    }
    else if (password.value.length >6){
        document.getElementById("SPpassword").style.display = "none";
        return true;
    }
    else if (password.value.length <6){
        document.getElementById("SPpassword").innerHTML = "Password length atleast 6 character"
        document.getElementById("SPpassword").style.display = "block";
        document.getElementById("SPpassword").style.color = "red";
        return false;
    }
    else{
        document.getElementById("SPpassword").style.display = "none";
        return true;
    }
}

document.getElementById("confirm_password").onkeyup = function () {
    if (confirm_password.value == ""){
        document.getElementById("SPcpassword").innerHTML = "Confirm password id required *";
        document.getElementById("SPcpassword").style.display = "block";
        document.getElementById("SPcpassword").style.color = "red";
    }
    else if (password.value !== confirm_password.value){
        document.getElementById("SPcpassword").innerHTML = "Password not match *";
        document.getElementById("SPcpassword").style.display = "block";
        document.getElementById("SPcpassword").style.color = "red";
        return false;
    }
    else if (password.value == confirm_password.value){
        document.getElementById("SPcpassword").style.display = "none";
        return true;
    }
    else{
        document.getElementById("SPcpassword").style.display = "none";
        return true;
    }
}
