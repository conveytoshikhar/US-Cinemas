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
                
                $_SESSION['date']=$date;
                $_SESSION['time']=$time;
                $_SESSION['filmName']=$filmName;
                $_SESSION['house']=$house;
                $_SESSION['category']=$category;
                $_SESSION['day']=$day;
                echo "<h1>Ticketing</h1>";

                echo "<h3> Cinema:      US</h3>";
                echo "<h3> House:       $house</h3>";
                echo "<h3> Film:        $filmName</h3>";
                echo "<h3> Category:    $category</h3>";
                echo "<h3> Show Time:   $date ($day) $time</h3>";

                




                //create table here 
                $db_conn=mysqli_connect('sophia.cs.hku.hk','andelwal','Shikhar1','andelwal') 
                or die("Error is "+mysqli_connect_error());

                $houseid=getHouseNumber($house);
                $query="SELECT * FROM house WHERE id='$houseid'";  
                $house_record=mysqli_query($db_conn,$query) or die("Query Error! ".mysqli_error($db_conn) ); 
                $rows=0;
                $columns=0;
                if(mysqli_num_rows($house_record)>0){
                    while($house=mysqli_fetch_array($house_record)){
                        $rows=$house['houserow'];
                        $columns=$house['housecol'];
                    }
                }

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

            function getHouseNumber($houseid){
                $number=1;
                $tempId='A';
                while(strcmp($tempId,$houseid)!=0){
                    $tempId++;
                    $number++;
                }

                return $number;
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