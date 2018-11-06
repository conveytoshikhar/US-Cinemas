<?php
    session_start();

    if(isset($_POST['getComments'])){

        $filmId=$_POST['filmIDForComments'];
        $db_conn=mysqli_connect('sophia.cs.hku.hk','andelwal','Shikhar1','andelwal') 
        or die("Error is "+mysqli_connect_error());
        
        $query="SELECT * FROM commentstable where filmid='$filmId'";    
        $result=mysqli_query($db_conn,$query) or die("Query Error! ".mysqli_error($db_conn) );
        $counter=0;
        if(mysqli_num_rows($result)>0){
            while($comment=mysqli_fetch_array($result)){
                if($comment['filmid']==$filmId){
                    $counter++;
                    $viewer = $comment['userid'];
                    $commentDescription = $comment['comment'];
                    echo "<section id='commentSection'>";
                    echo "<p> <span>Viewer:</span> $viewer </p>";
                    echo "<p> <span>Comment:</span> $commentDescription </p>";
                    echo "</section>";
                    echo "<hr>";
                }
            }


            
        }
        if($counter==0){
            echo "<section id='commentSection'>";
            echo "<p>No Comments posted yet..</p>";
            echo "</section>";
        }
    
    }





?>