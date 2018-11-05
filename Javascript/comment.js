var submitBtn=document.getElementById("submit");
var viewCommentsBtn=document.getElementById("viewComments");
var form=document.getElementById("form");
var comment=document.getElementById("comment");
var selector = document.getElementById('selector');
var toPutCommentsIn=document.getElementById("retrievedComments");


submit.onclick=checkSubmit;

viewCommentsBtn.onclick=sendCommentsRequest;


function checkSubmit(){
    if (comment.value==''){
        alert("Please fill in some comments ");
    }else{
        form.submit();
    }
}




function sendCommentsRequest(){
    var xmlhttp;
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    var value = selector[selector.selectedIndex].value;
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            toPutCommentsIn.innerHTML=xmlhttp.responseText;
        }
    }
    xmlhttp.open("POST", "comment_retrieve.php",true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("getComments=true&filmIDForComments="+value);
}