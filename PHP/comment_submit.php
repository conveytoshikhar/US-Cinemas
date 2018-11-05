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
                $userid=$_SESSION['username'];
                $filmId=$_POST['filmSelected'];

                $comment=$_POST['comment'];
                $db_conn=mysqli_connect('sophia.cs.hku.hk','andelwal','Shikhar1','andelwal') 
                    or die("Error is "+mysqli_connect_error());
                $tempString="'$filmId','$userid','$comment'";
                $query="INSERT INTO commentstable (filmid,userid,comment) VALUES ($tempString)";
                $result=mysqli_query($db_conn,$query) or die("Query Error! ".mysqli_error($db_conn) );
                if($result==1){
                    echo "<h1> Your comment has been submitted </h1>";
                    echo "<script> setTimeout(  ()=>{window.location.replace('comment.php')}  , 3000) </script>"; 
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