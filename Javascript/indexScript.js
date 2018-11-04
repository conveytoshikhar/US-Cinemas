var usernameField=document.getElementById("username");
var passwordField=document.getElementById("password");
var submitBtn = document.getElementById("submit");
var createAccountBtn=document.getElementById("createAccount");
var username='',password='';
usernameField.onblur=()=>{username=usernameField.value}
passwordField.onblur=()=>{password=passwordField.value}



submitBtn.onclick=sendLoginRequest
console.log(submitBtn)
createAccountBtn.onclick=()=>{window.location.replace("createaccount.html")}









function sendLoginRequest(){
    console.log(username+"   "+password)
    if(username==''|| password==''){
        alert("Please do not leave fields empty.")
    }else{
        console.log("Form needs to be submitted")
        document.getElementById("form").submit();
    }
    


}