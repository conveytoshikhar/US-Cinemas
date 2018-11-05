<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8"/>
    <title>Buy A Ticket</title>
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

                $db_conn=mysqli_connect('sophia.cs.hku.hk','andelwal','Shikhar1','andelwal') 
                    or die("Error is "+mysqli_connect_error());
                    
                $query="SELECT * FROM film";    
                $film_records=mysqli_query($db_conn,$query) or die("Query Error! ".mysqli_error($db_conn) );
                
                if(mysqli_num_rows($film_records)>0){
                    while($film=mysqli_fetch_array($film_records)){
                        echo "<div id='cardview'> ";
                        echo "<p>";
                        echo "Title: ".$film['filmname'];
                        echo "</p>";
                        echo "<img src='../Assets/".$film['poster']."' alt='image poster'/>";
                        echo "<p>";
                        echo "Synopsis: ".$film['description'];
                        echo "</p>";
                        echo "<p>";
                        echo "Director: ".$film['director'];
                        echo "</p>";
                        echo "<p>";
                        echo "Category: ".$film['category'];
                        echo "</p>";
                        echo "<p>";
                        echo "Language: ".$film['languageFilm'];
                        echo "</p>";

                        // here the show timings will go for the current movie
                        $query="SELECT * FROM broadcast WHERE filmid='".$film['filmid']."'";
                        $broadcast_items=mysqli_query($db_conn,$query) or die("Query Error! ".mysqli_error($db_conn) );
                        if(mysqli_num_rows($broadcast_items)>0){
                            echo "<form id='form' method='POST' action='seatplantry.php'>";
                            echo '<select name="chosen" size="1">';
                            while($broad_item=mysqli_fetch_array($broadcast_items)){
                                $broadcast_id=$broad_item['id'];
                                $houseid=convertHouseName($broad_item['houseid']);
                                $date=$broad_item['date'];
                                $filmname=$film['filmname'];
                                $category=$film['category'];
                                $time=$broad_item['time'];
                                $day=$broad_item['day'];
                                $displayitem= $date." ".$time." (".$day.") "."House ".$houseid;
                                echo "<option  value='$broadcast_id' >".$displayitem.'</option>';
                            }
                            echo '</select>';
                            echo '<input type="submit" value="submit">';
                            echo '</form>';
                        }

                        echo "</div>";
                        
                        echo "<hr>";

                    }
                }

            }else{
                echo "<h1> You have not logged in. </h1>";
                echo "<script> setTimeout(  ()=>{window.location.replace('../index.html')}  , 3000) </script>";
            }
          




            function convertHouseName($houseid){
                $house='A';
                for($i=1;$i<$houseid;$i++){
                    $house++;
                }
                return $house;
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