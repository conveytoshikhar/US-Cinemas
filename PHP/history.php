<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8"/>
    <title>US Cinemas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../CSS/headerStyling.css">
    <link rel="stylesheet" type="text/css" href="../CSS/historyStyling.css">
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
                echo "</ul>";
                echo "</header>";

                $userid=$_SESSION['username'];
                $db_conn=mysqli_connect('sophia.cs.hku.hk','andelwal','Shikhar1','andelwal') 
                or die("Error is "+mysqli_connect_error());
                echo "<h1> Purchase History </h1>";
                echo "<h3> $userid</h3>";

                $query="SELECT * FROM ticket where userid='$userid'";    
                $ticket_records=mysqli_query($db_conn,$query) or die("Query Error! ".mysqli_error($db_conn) );

                if(mysqli_num_rows($ticket_records)>0){
                    while($ticket=mysqli_fetch_array($ticket_records)){
                        echo "<div id='ticketDetails'>";
                        $ticketId=$ticket['ticketid'];
                        $type=strtoupper($ticket['type']);
                        $broadcast_id=$ticket['broadcastid'];
                        $seat=$ticket['seat'];
                        $fee="$".$ticket['fee'];

                        $query="SELECT * from broadcast where id='$broadcast_id'";
                        $result=mysqli_query($db_conn,$query) or die("Query Error! ".mysqli_error($db_conn) );
                        $broadcast=mysqli_fetch_array($result);
                        $day=$broadcast['day'];
                        $date=$broadcast['date'];
                        $houseid=$broadcast['houseid'];
                        $housename=getHouseName($houseid);
                        $time=$broadcast['time'];
                        $filmId=$broadcast['filmId'];

                        $query="SELECT * from film where filmid='$filmId'";
                        $result=mysqli_query($db_conn,$query) or die("Query Error! ".mysqli_error($db_conn) );
                        $film=mysqli_fetch_array($result);
                        
                        $filmName=$film['filmname'];
                        $language=$film['languageFilm'];
                    

                        echo "<p> <span>Ticket Id: </span> $ticketId, $fee ($type) </p>";
                        echo "<p> <span>House:</span> $housename </p>";
                        echo "<p> <span>Seat: </span> $seat </p>";
                        echo "<p> <span>Film Name: </span>$filmName </p>";
                        echo "<p> <span>Language: </span>$language </p>";
                        echo "<p> <span>Date: </span>$date ($day) $time  </p>";

                        echo "</div>";
                        echo "<hr>";

                    }
                }else{
                    echo "<div id='noDetails'>";
                    echo "<h2> Sorry, No Purchase Records Found ... </h2> ";
                    echo '</div>';
                }
              


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
          function getHouseName($houseid){
            $house='A';
            for($i=1;$i<$houseid;$i++){
                $house++;
            }
            return $house;
        }
        ?>
    </body>

</html>