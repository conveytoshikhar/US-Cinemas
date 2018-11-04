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
        ?>

    </body>

</html>