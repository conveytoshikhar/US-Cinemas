var usernameField=document.getElementById("username");
var passwordField=document.getElementById("password");
var submitBtn = document.getElementById("submit");
var createAccountBtn=document.getElementById("createAccount");
var username='',password='';
usernameField.onblur=()=>{username=usernameField.value}
passwordField.onblur=()=>{password=passwordField.value}



submitBtn.onclick=sendLoginRequest
console.log(submitBtn)
createAccountBtn.onclick=()=>{window.location.replace("../HTML/createaccount.html")}









function sendLoginRequest(){
    console.log(username+"   "+password)
    if(username==''|| password==''){
        alert("Please do not leave fields empty.")
    }else{
        console.log("Form needs to be submitted")
        document.getElementById("form").submit()
        // var xmlhttp;
        // if (window.XMLHttpRequest) {
        //     xmlhttp = new XMLHttpRequest();
        // } else {
        //     xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        // }
        // xmlhttp.onreadystatechange = function () {
        //     if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        //         console.log("Achieved")
        //     }
        // }
        // xmlhttp.open("POST", "../PHP/verifyLogin.php",true);
        // xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        // xmlhttp.send("username="+username+"&password="+password);   
    }
    


}