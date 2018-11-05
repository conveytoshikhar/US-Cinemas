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
                if(isset($_POST['storeData'])){
                    $seats=$_SESSION['seats'];
                    $ticketsType=$_SESSION['ticketsType'];
                    $ticketsFee=$_SESSION['ticketsFee'];
                    $valid="SOLD";
                    $houseid=$_SESSION['houseID'];
                    $filmId=$_SESSION['filmId'];
                    $userId=$_SESSION['username'];
                    $broadcast_id=$_SESSION['broadcastID'];
                    print_r($seats);
                    print_r($ticketsType);
                    print_r($ticketsFee);
                    $db_conn=mysqli_connect('sophia.cs.hku.hk','andelwal','Shikhar1','andelwal')
                    or die("Error is "+mysqli_connect_error());
                    for($i=0;$i<count($seats);$i++){
                        $seat=$seats[$i];
                        $ticketType=$ticketsType[$i];
                        $ticketFee=$ticketsFee[$i];
                        $tempString="'$seat','$broadcast_id','$valid','$userId','$ticketType','$ticketFee'";
                        $query="INSERT INTO `ticket` (seat,broadcastid,valid,userid,type,fee) VALUES ($tempString)";
                        $result=mysqli_query($db_conn,$query) or die('Failed to query'.mysqli_error($conn));
                    }

                }else{
                echo "<ul>";
                echo "<li><a href='buywelcome.php'>Buy a Ticket</a></li>";
                echo "<li><a href='comment.php'>Movie Review</a></li>";
                echo "<li><a href='history.php'>Purchase History</a></li>";
                echo "<li><a href='logout.php'>Logout</a></li>";
                echo "<ul>";


                //first get ticket price details for selected seats
                $seats=$_SESSION['seats'];
                $house=$_SESSION['houseName'];
                $houseid=$_SESSION['houseID'];
                $filmName=$_SESSION['filmName'];
                $filmId=$_SESSION['filmId'];
                $filmCategory=$_SESSION['category'];
                $day=$_SESSION['day'];
                $date=$_SESSION['date'];
                $time=$_SESSION['time'];
                $broadcast_id=$_SESSION['broadcastID'];

                for ($i=0;$i<count($seats);$i++){
                    $ticketsType[$i]=$_POST[$seats[$i]];
                }
                $_SESSION['ticketsType']=$ticketsType;


                echo "<h1>  Order Information </h1>";
                $totalFee=0;
                for($i=0;$i<count($ticketsType);$i++){
                    echo "<table style='border:1px solid black'>";
                    echo '<tr>';
                    echo "<td>";
                    echo "<h3> Cinema:      US</h3>";
                    echo "</td>";
                    echo '</tr>';
                    echo '<tr>';
                    echo "<td>";
                    echo "<h3> House:       $house</h3>";
                    echo "</td>";
                    echo '</tr>';
                    echo '<tr>';
                    echo "<td>";
                    $seat=$seats[$i];
                    echo "<h3> Seat No.:    $seat</h3>";
                    echo "</td>";
                    echo '</tr>';
                    echo '<tr>';
                    echo "<td>";
                    echo "<h3> Film:        $filmName</h3>";
                    echo "</td>";
                    echo '</tr>';
                    echo '<tr>';
                    echo "<td>";
                    echo "<h3> Category:    $filmCategory</h3>";
                    echo "</td>";
                    echo '</tr>';
                    echo '<tr>';
                    echo "<td>";
                    echo "<h3> Show Time:   $date ($day) $time</h3>";
                    echo "</td>";
                    echo '</tr>';
                    echo '<tr>';
                    echo "<td>";
                    if(strcmp($ticketsType[$i],"adult")==0){
                        echo "<h3> Ticket Fee:   $75 (Adult) </h3>";
                        echo "</td>";
                        echo '</tr>';
                        $ticketsFee[$i]='75';
                        $totalFee=$totalFee+75;
                    }else{
                        echo "<h3> Ticket Fee:   $50 (Student/Senior) </h3>";
                        $ticketsFee[$i]='50';
                        echo "</td>";
                        echo '</tr>';
                        $totalFee=$totalFee+50;
                    }
                    echo "</table>";
                    

                }
                $_SESSION['ticketsFee']=$ticketsFee;
                echo "<h3> Total Fee: $totalFee</h3>";
                echo "<hr>";
                echo "Please present valid proof of age/status when purchasing Student or Senior tickets before entering the cinema house";
                echo "<br>";
                echo '<button id="ok">OK</button>';
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
        ?>
        <script src="../Javascript/confirm.js"></script>
    </body>

</html>