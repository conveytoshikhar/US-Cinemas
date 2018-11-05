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


                $db_conn=mysqli_connect('sophia.cs.hku.hk','andelwal','Shikhar1','andelwal') 
                    or die("Error is "+mysqli_connect_error());
                    
                $query="SELECT * FROM film";    
                $film_records=mysqli_query($db_conn,$query) or die("Query Error! ".mysqli_error($db_conn) );
                echo'<form id="form" action="comment_submit.php" method="POST">';
                echo '<p>';
                echo '<label for="film">Film Name:</label>';
                echo "<select id='selector' name='filmSelected' size='1'>";
                while($film=mysqli_fetch_array($film_records)){
                    $film_id=$film['filmid'];
                    $filmName=$film['filmname'];
                    echo "<option value='$film_id'>$filmName</option>";
                }
                echo '</select>';
                echo '</p>';
                echo '<p>';
                echo '<textarea id="comment" name="comment"  rows="20" cols="80" placeholder="Please input comment here"></textarea>';
                echo '</p>';
                echo "</form>";
                echo '<button id="viewComments">View Comment</button>';
                echo '<button id="submit">"Submit Comment"</button>';
                
                echo "<div id='retrievedComments'>";
                echo"</div>";

                   
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
        <script src="../Javascript/comment.js"></script>
    </body>

</html>