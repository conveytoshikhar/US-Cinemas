<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8"/>
    <title>Create User</title>
  </head>

  <body>
        <h1>Youre here</h1>
        <?php
            session_start();
            
            if(isAuthenticated()){
                echo "<h1> Youre good to go buddy </h1>";
            }else{
                echo "<h1> You have not logged in. </h1>";
                echo "<script> setTimeout(  ()=>{window.location.replace('../index.html')}  , 3000) </script>";
            }
          







          function isAuthenticated(){
              if(isset($_SESSION['username'])){
                    return true;
              }else{
                    return false;
              }
          }
        ?>

    </body>

</html>