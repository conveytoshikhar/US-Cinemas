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
                
                $selected_item= $_POST['chosen'];
                //parsing input 
                $top_result=explode("&",$selected_item);
                
                for($i=0;$i<count($top_result);$i++){
                    $result[$i]=explode("=",$top_result[$i])[1];
                }
                $date=$result[0];
                $time=$result[1];
                $filmName=$result[2];
                $house=$result[3];
                $category=$result[4];
                $day=$result[5];

                echo "<h1>Ticketing</h1>";

                echo "<h3> Cinema:      US</h3>";
                echo "<h3> House:       $house</h3>";
                echo "<h3> Film:        $filmName</h3>";
                echo "<h3> Category:    $category</h3>";
                echo "<h3> Show Time:   $date ($day) $time</h3>";

                




                //create table here 

    










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

            function getHouseNumber($houseid){
                $number=1;
                $tempId='A';
                while(strcmp($tempId,$houseid)!=0){
                    $tempId++;
                    $number++;
                }

                return $number;
            }

        ?>

    </body>

</html>