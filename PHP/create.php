<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8"/>
    <title>Create User</title>
  </head>

  <body>

        <?php
            $username=$_POST['username'];
            $password=$_POST['password'];
            $db_conn=mysqli_connect('sophia.cs.hku.hk','andelwal','Shikhar1','andelwal') 
                    or die("Error is "+mysqli_connect_error());

            $query="SELECT * FROM login where userid= '$username'";  
            $returnToIndexScript= 'setTimeout( ()=>{window.location.replace("../HTML/index.html")}, 3000)';

            $user_record=mysqli_query($db_conn,$query) or die("Query Error! ".mysqli_error($db_conn) );

            if(mysqli_num_rows($user_record)>0){
                $dupRecord=mysqli_fetch_array($user_record);
                // echo $dupRecord['userid']."    ".$dupRecord['password'];
                echo "<h1> Account already exists.</h1>";
                echo "<script>".$returnToCreateAccountScript."</script>";
            }else{
                $query="INSERT INTO login VALUES ('$username','$password') ";
                $result=mysqli_query($db_conn,$query) or die("Query Error! ".mysqli_error($db_conn) );
                if($result==1) {
                    echo "<h1> Account Created! Welcome.</h1>";
                    echo "<script>".$returnToIndexScript."</script>";
                }else{
                    echo ("Server Error: ".mysqli_error($db_conn));
                }
    
          }
        ?>

    </body>

</html>