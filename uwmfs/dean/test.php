<?php
include'../access.php';
include("header.php");
include("../dboperations.php");
$user=$_SESSION["username"];

?>
<?php
if(isset($_GET['editgrade'])){
$lowerbound=$_GET['lowerbound'];
$upperbound=$_GET['upperbound'];
$letter=$_GET['letter'];
$grade=$_GET['grade'];
    
    
 $update=mysqli_query($db,"update grades set lowerbound=$lowerbound,upperbound=$upperbound,letter='$letter' where grade=$grade");
    if($update){
        echo"<div class='alert alert-warning alert-dismissable'>
        <center>transaction done successfully</center>
          <script>function goto(){
                        window.location='index.php';
                        
                        }
                        setInterval(goto,1000);
                        </script>
        </div>";
    }
    else{
        echo"<div class='alert alert-warning alert-dismissable'>
        <center>".mysqli_error($db)."</center>
        </div>
         <script>function goto(){
                        window.location='index.php';
                        
                        }
                        setInterval(goto,9000);
                        </script>
                              </div>";
    }
    
    
    
    
}

?>