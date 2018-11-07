<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8"/>
    <title>US Cinemas</title>
    <link rel="stylesheet" type="text/css" href="../CSS/buyTicketStyling.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>

  <body>

        <?php
            session_start();
            
            if(isAuthenticated()){
                $seats=($_POST['seat']);
                $_SESSION['seats']=$seats;
                $house=$_SESSION['houseName'];
                $houseid=$_SESSION['houseID'];
                $filmName=$_SESSION['filmName'];
                $filmId=$_SESSION['filmId'];
                $filmCategory=$_SESSION['category'];
                $day=$_SESSION['day'];
                $date=$_SESSION['date'];
                $time=$_SESSION['time'];
                $broadcast_id=$_SESSION['broadcastID'];
                echo '<h1 id="cart"> Cart</h1>';
                echo "<div class='top-info'>";
                echo "<h1>Ticketing</h1>";
                echo "<h3> Cinema:      US</h3>";
                echo "<h3> House:       $house</h3>";
                echo "<h3> Film:        $filmName</h3>";
                echo "<h3> Category:    $filmCategory</h3>";
                echo "<h3> Show Time:   $date ($day) $time</h3>";
                echo "</div>";

                echo "<form action='confirm.php' method='POST'>";
                echo "<table>";
                $db_conn=mysqli_connect('sophia.cs.hku.hk','andelwal','Shikhar1','andelwal') 
                or die("Error is "+mysqli_connect_error());
                for($i=0;$i<count($seats);$i++){
                    echo '<tr>';
                    $seat_value=$seats[$i];
                    


                    echo "<td id='seat-value'> $seat_value</td>";
                    echo '<td>';
                    echo "<select id='ticket-value'name='$seat_value' size='1'>";
                    echo '<option value="adult"> Adult ($75) </option>';
                    echo '<option value="student/senior"> Student/Senior ($50) </option>';
                    echo '</select>';
                    echo "</td>";

                   

                }
                echo "</table>";
                echo '<input id="submit" type="submit" value="Confirm">';
                echo "</form>";
                echo '<button id="cancel">Cancel</button>';
                

            }else{
                echo "<h1 id='notLoggedIn'> You have not logged in. </h1>";
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
         <script>
            var cancel=document.getElementById("cancel");
            cancel.onclick=()=>{window.location.replace('buywelcome.php')};
        </script>
    </body>

</html>