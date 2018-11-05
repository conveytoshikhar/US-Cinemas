<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8"/>
    <title>US Cinemas</title>
  </head>

  <body>

        <?php
            session_start();
            
            if(isAuthenticated()){
                echo "<ul>";
                echo "<li><a href='buywelcome.php'>Buy a Ticket</a></li>";
                echo "<li><a href='comment.php'>Movie Review</a></li>";
                echo "<li><a href='history.php'>Purchase History</a></li>";
                echo "<li><a href='logout.php'>Logout</a></li>";
                echo "<ul>";

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
                    

                        echo "<p> Ticket Id: $ticketId, $fee ($type) </p>";
                        echo "<p> House: $housename </p>";
                        echo "<p> Seat: $seat </p>";
                        echo "<p> Film Name: $filmName </p>";
                        echo "<p> Language: $language </p>";
                        echo "<p> Date: $date ($day) $time  </p>";

                        echo "</div>";
                        echo "<hr>";

                    }
                }
              


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