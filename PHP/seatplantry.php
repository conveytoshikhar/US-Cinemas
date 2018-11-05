<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8"/>
    <title>Choose a seat.</title>
  </head>

  <body>

        <?php
            session_start();

            if(isAuthenticated()){
                $broadcast_id= $_POST['chosen'];
                $db_conn=mysqli_connect('sophia.cs.hku.hk','andelwal','Shikhar1','andelwal') 
                    or die("Error is "+mysqli_connect_error());

                $query="SELECT * FROM broadcast where id='$broadcast_id'";    
                $broadcast=mysqli_query($db_conn,$query) or die("Query Error! ".mysqli_error($db_conn) );


                $broadcast_items=mysqli_fetch_array($broadcast);



                $day= $broadcast_items['day'];
                $time= $broadcast_items['time'];
                $filmId= $broadcast_items['filmId'];
                $houseid=$broadcast_items['houseid'];
                $house=getHouseName($houseid);
                $date= $broadcast_items['date'];


                $query = "SELECT * FROM film WHERE filmid='$filmId'";
                $film_details=mysqli_query($db_conn,$query) or die("Query Error! ".mysqli_error($db_conn) );
                $film=mysqli_fetch_array($film_details);


                $filmName=$film['filmname'];
                $filmCategory=$film['category'];
              
                echo "<h1>Ticketing</h1>";
                echo "<h3> Cinema:      US</h3>";
                echo "<h3> House:       $house</h3>";
                echo "<h3> Film:        $filmName</h3>";
                echo "<h3> Category:    $filmCategory</h3>";
                echo "<h3> Show Time:   $date ($day) $time</h3>";

                $query="SELECT * FROM house where id='$houseid'";
                $house_object=mysqli_query($db_conn,$query) or die("Query Error! ".mysqli_error($db_conn) );
                $house_items=mysqli_fetch_array($house_object);
                $rows=$house_items['houserow'];
                $columns=$house_items['housecol'];
                echo "<form action='buyticket.php' method='POST'>";
                echo '<table id="seatingPlan" style="border: 1px solid black">';
                for($r=1;$r<=$rows;$r++){
                    echo '<tr>';
                    for($c=1;$c<=$columns;$c++){
                        echo '<td>';
                        echo '<div">';
                        $rowAlphabet=getRowsAlphabet($r);
                        echo "<input type='checkbox' name='seat' value='$rowAlphabet&$c'>";
                        echo "<p> $rowAlphabet$c </p>";
                        echo '</div>';
                        echo '</td>';
                    }
                    echo '</tr>';
                }
                echo '</table>';
                echo '<input type="submit" value="Submit">';
                echo '</form>';
                echo '<button id="cancel">Cancel</button>';
                
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

            function getRowsAlphabet($rowid){
                $row='A';
                for($i=1;$i<$rowid;$i++){
                    $row++;
                }
                return $row;
            }
        
        ?>
        <script>
            var cancel=document.getElementById("cancel");
            cancel.onclick=()=>{window.location.replace('buywelcome.php')};
        </script>
    </body>

</html>