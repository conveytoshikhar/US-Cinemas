<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8"/>
    <title>Login</title>
  </head>

  <body>

        <?php
            $username=$_POST['username'];
            $password=$_POST['password'];
            $db_conn=mysqli_connect('sophia.cs.hku.hk','andelwal','Shikhar1','andelwal') 
                    or die("Error is "+mysqli_connect_error());

            $query="SELECT * FROM login where userid= '$username'";  
            $returnToIndexScript= 'setTimeout( ()=>{window.location.replace("../index.html")}, 3000)';

            $user_record=mysqli_query($db_conn,$query) or die("Query Error! ".mysqli_error($db_conn) );

            if(mysqli_num_rows($user_record)>0){
                $entry=mysqli_fetch_array($user_record);
                if($entry['password']==$password){
                    echo "<h1>Success.</h1>";
                }
                else{
                        echo "<h1> Invalid login, please login again. </h1>";
                        echo "<script>".$returnToIndexScript."</script>"; 
                }
            }else{
            
                echo "<h1> Invalid login, please login again. </h1>";
                echo "<script>".$returnToIndexScript."</script>";
            }    
        ?>

    </body>

</html>