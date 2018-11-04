<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8"/>
    <title>Logout</title>
  </head>

  <body>
        <h1>Logging out..</h1>
        <?php
            session_start();
            if(isset($_COOKIE[session_name()])){
                setcookie(session_name(),'',time()-3600,'/');
            }
            session_unset();
            session_destroy();
            echo "<script>".'setTimeout( ()=>{window.location.replace("../index.html")},3000 )'."</script>"; 
        ?>

    </body>

</html>