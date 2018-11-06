<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>US Cinemas</title>
    <link rel="stylesheet" type="text/css" href="../CSS/mainStyling.css">
    <link rel="stylesheet" type="text/css" href="../CSS/headerStyling.css">
  </head>

  <body>

        <?php
            session_start();
            
            if(isAuthenticated()){

                echo "<header>";
                echo "<ul>";
                echo "<li><a href='buywelcome.php'>Buy a Ticket</a></li>";
                echo "<li><a href='comment.php'>Movie Review</a></li>";
                echo "<li><a href='history.php'>Purchase History</a></li>";
                echo "<li><a href='logout.php'>Logout</a></li>";
                echo "<ul>";
                echo "</header>";




                echo "<div id='content'>";
                echo "<h1>Have an awesome experience at US CINEMAS...</h1>";
                echo "</div>";
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