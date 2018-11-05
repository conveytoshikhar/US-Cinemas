var ok=document.getElementById("ok");


ok.onclick=sendStoreTicketRequest;





function sendStoreTicketRequest(){
    var xmlhttp;
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    console.log("Object created");
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            console.log("Values uploaded "+xmlhttp.responseText);
            window.location.replace('../PHP/buywelcome.php');
        }
    }
    xmlhttp.open("POST", "confirm.php",true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("storeData=true");
}
