var usernameField=document.getElementById("username")
var passwordField=document.getElementById("password")
var signUpBtn= document.getElementById("signUp")
var backBtn= document.getElementById("back")

var username='',password='';

usernameField.onblur=()=>{username=usernameField.value}
passwordField.onblur=()=>{password=passwordField.value}


signUpBtn.onclick=sendCreateRequest

backBtn.onclick=()=>{window.location.replace("index.html")}



function sendCreateRequest(){
    var usernameInvalidFormat = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]+/;
    if(username==''|| password==''){
        alert("Please do not leave the fields empty.")
    }else if(username.length<=3){
        alert("Username must be longer than 3 charcters.")
    }else if(usernameInvalidFormat.test(username)){
        alert("Username can only conists of characters and numbers")
    }else if(password.length<6 || password.length >15) {
        alert("The length of the password must be between 6 to 15 characters and it must consist of only alphanumerical characters with at least one alphabet and one numerical character")
    }else{
        document.getElementById("form").submit()
    }
}


