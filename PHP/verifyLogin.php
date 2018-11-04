<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8"/>
    <title>Login</title>
  </head>

  <body>

        <?php

            session_start();
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
                    $_SESSION['username']=$username;
                    session_write_close();
                    header('location:main.php');
                }else{
                        echo "<h1> Invalid login, please login again. </h1>";
                        destroySession();
                        echo "<script>".$returnToIndexScript."</script>"; 
                }
            }else{
            
                echo "<h1> Invalid login, please login again. </h1>";
                destroySession();
                echo "<script>".$returnToIndexScript."</script>";
            }
            
            
            function destroySession(){
                if(isset($_COOKIE[session_name()])){
                    setcookie(session_name(),'',time()-3600,'/');
                }
                session_unset();
                session_destroy();
            }
        ?>

    </body>

</html>