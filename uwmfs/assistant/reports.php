<?php
include'../access.php';
include("../dboperations.php");
include("header.php");
$user=$_SESSION["username"];
$date=date('Y-m-d');
$dv=substr($date,0,4);
?>
    <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Academic Registrar</h1><button type='button' onclick='PrintDiv();' class='btn btn-outline btn-info fa fa-print' title="Print this"></button>
                </div>
            </div>
            <div id="divToPrint" >
            <div class="row">               
                           <div id="collapseOne" class="panel-collapse collapse in">
                                                       
                                        <div class="tab-pane fade in active" id="applicants-pills">
                                            
                                            <p>    <div class="col-lg-12">
                                                   <div class="panel panel-primary">
        <table><tr><td><img src="http://localhost/real/css_scripts/vendor/datatables/images/test.png" width="100" height="80" class="img-circle"></td><td width="20%"></td><td><center><b>UNIVERSITY OF WORLD MISSION FRONTIERS<br>
            Graduate School Of THE THEOGOLOGY</b><br>
            P.O.BOX 5856 KIGALI-RWANDA TEL:(+250)788554109/(+250)781403982<br>
           <b> WEBSITE:hismission.org E-mail:missionfrontiers@yahoo.com
            
           </b></center></td></tr></table><br>

    <?php 
    if(isset($_GET['viewpending'])){
    $dbapplicant=mysqli_query($db,"SELECT * FROM candidates join applications using (reference_no) where application_status='pending'") or die(mysqli_error($db));
    $counter=mysqli_num_rows($dbapplicant);
  echo'<div class="panel-heading"><br><center> Pending Applications </center><br></div><div class="panel-body">
  <div class="table-responsive"><center><table border=1 width=100%>';      
echo'<thead><tr><th>Applicants code</th><th>Full Names</th><th>Telephone</th><th>Email</th><th>Program</th></tr></thead><tbody>';
                    while($res=mysqli_fetch_array($dbapplicant)){
echo"<tr>
<td>".$res['reference_no']."</td>
<td>".$res['first_name']." ".$res['last_name']."</td>
<td>".$res['candidate_telephone']."</td>
<td class='center'>".$res['candidate_email']."</td>
<td class='center'>".$res['program_code']."</td>
</tr>";
}}
if(isset($_GET['viewallocated'])){
$lecturer=mysqli_query($db,"select * from users join users_responsabilities USING(user_respo_id) where responsability='Lecturer' and user_id in (select user_id from modules_programs)")or die(mysqli_error($db));
$counter=mysqli_num_rows($lecturer);
echo'<div class="panel-heading"><br><center>MODULES WITH THEIR RESPECTIVE LECTULER </center><br></div><div class="panel-body">
  ';
 if($counter>0){
     
   
            while($lines=mysqli_fetch_array($lecturer)){
$user_id=$lines['user_id'];
$lecf=$lines['first_name'];$lecl=$lines['last_name'];
echo"<table  width=100% border=1><tr><td><center><b> Lecturers Details:".$lecf."   ".$lecl."    ".$lines['email']."    ".$lines['telephone']."</b></td></tr></table>";
 echo'<div class="table-responsive"><center><table border=1 width=100%>
 <thead><tr><th>MODULE CODE</th><th>MODULE NAME</th><th>PROGRAM-CODE</th><th>Course credits</th>
</tr></thead><tbody>';
$md=mysqli_query($db,"select * from users join modules_programs USING(user_id) JOIN modules USING (module_id) join programs using (program_id) join users_responsabilities USING(user_respo_id) where responsability='Lecturer' and user_id=$user_id")or die(mysqli_error($db));
               
            while($recs=mysqli_fetch_array($md))
{

echo " <tr class='success'><td>".$recs['module_code']."</td><td>".$recs['module_name']."</td><td>".$recs['program_code']."</td><td>".$recs['module_credits']."</td></tr>";
                
                
            }}}
            
            
        
    else{
echo '<tr><td colspan=6><center>No records found</center></td></tr>';
    }
    
}
if(isset($_GET['viewprograminfo'])){
$dbapplicant=mysqli_query($db,"select * from programs") or die(mysqli_error($db));
$counter=mysqli_num_rows($dbapplicant);
echo'<div class="panel-heading"><br><center>School Program infos</center><br></div><div class="panel-body">
  <div class="table-responsive"><center><table border=1 width=100%>';
echo'<thead><tr><th>Program Name</th><th>Learning period</th><th>Program description</th><th>Program code</th></tr></thead><tbody>';

                    while($res=mysqli_fetch_array($dbapplicant)){
 echo"<tr class='panel panel-info'>
 <td>".$res['program_name']."</td><td>".$res['number_of_levels']."</td><td>".wordwrap($res['description'],30,"<br>",true)."</td><td>".$res['program_code']."</td></tr>";
    
}}
if(isset($_GET['viewunassigned'])){
$lecturer=mysqli_query($db,"SELECT * FROM `modules` WHERE module_id not in(select module_id from modules_programs)")or die(mysqli_error($db));
    $counter=mysqli_num_rows($lecturer);
echo'<div class="panel-heading"><br><center>Modules that have not yet been Assigned to Programs</center><br></div><div class="panel-body">
  <div class="table-responsive"><center><table border=1 width=100%>';
echo'<thead><tr><th>Module Code</th><th>Module Name</th><th>Course Units</th><th>Learning Hours</th></tr></thead><tbody>';

            if($counter>0){
  while($lines=mysqli_fetch_array($lecturer)){
                echo " <tr class='red'><td>".$lines['module_code']."</td><td>".$lines['module_name']."</td>
            <td>".$lines['module_credits']."</td><td>".$lines['study_hours']."</td></tr>";
                
                
            }
            
            
        }
        else{
            echo '<tr><td colspan=5><center>All modules have been assigned to their corresponding program</center></td><tr>';
        }
    
}
if(isset($_GET['viewbranches'])){
$dbbranches=mysqli_query($db,"select * from branches") or die(mysqli_error($db));
$counter=mysqli_num_rows($dbbranches);
echo'<div class="panel-heading"><br><center>University Branches</center><br></div><div class="panel-body">
  <div class="table-responsive"><center><table border=1 width=100%>';
echo'<thead><tr><th>Branch Name</th><th>Branch Code</th><th>District</th><th>Country</th></tr></thead><tbody>';
    if($dbbranches){
  while($res=mysqli_fetch_array($dbbranches)){
    echo"<tr class='panel panel-info'>
   <td>".$res['branch_name']."</td>
  <td>".$res['branch_code']."</td>
 <td>".$res['branch_location']."
<td class='center'>".$res['branch_country']."</td>
</tr>";                                                    
}
    }
else
{
echo"<tr><td colspan='4'>no data selected</td></tr>";  
}
}
if(isset($_GET['viewrejected'])){
  $dbapplicant=mysqli_query($db,"SELECT * FROM candidates join applications using (reference_no) where application_status='rejected'") or die(mysqli_error($db));
  $counter=mysqli_num_rows($dbapplicant);  
echo'<div class="panel-heading"><br><center>'.$counter.'    Rejected Applicants</center><br></div><div class="panel-body">
  <div class="table-responsive"><center><table border=2 width=100%>';
echo'<thead><tr><th>Applicant Refence number</th><th>Full Names</th><th>Telephone</th><th>E-mail</th><th>Program </th></tr></thead><tbody>';
if($dbapplicant and $counter>0){
            while($res=mysqli_fetch_array($dbapplicant)){
                        echo"<tr>
<td>".$res['reference_no']."</td>
<td>".$res['first_name']." ".$res['last_name']."</td>
<td>".$res['candidate_telephone']."</td>
<td class='center'>".$res['candidate_email']."</td>
<td class='center'>".$res['program_code']."</td>
</tr>";
}
 }           
            
        
        else{
            echo '<tr><td colspan=5><center>All modules have been assigned to their corresponding program</center></td><tr>';
        }
}
if(isset($_GET['viewstudents']))
{
$dbapplicant=mysqli_query($db,"select * from candidates join students USING(reference_no)") or die(mysqli_error($db));
  $counter=mysqli_num_rows($dbapplicant);  
echo'<div class="panel-heading"><br><center>The total number of Students in '.$dv.' is  ('.$counter.')</center><br></div><div class="panel-body">
  <div class="table-responsive"><center><table border=2 width=100%>';
echo'<thead><tr><th>Registration NUmber</th><th>Full Names</th><th>Telephone</th><th>E-mail</th><th>Program </th><th>Branch Code</th></tr></thead><tbody>';
                    while($res=mysqli_fetch_array($dbapplicant)){
echo"<tr>
<td>".$res['registration_no']."</td>
<td>".$res['first_name']." ".$res['last_name']."</td>
<td>".$res['candidate_telephone']."</td>
<td class='center'>".$res['candidate_email']."</td>
<td class='center'>".$res['program_code']."</td>
<td class='center'>".$res['branch_code']."</td>
</tr>";
}
}
if(isset($_GET['viewstatus'])){
$students=mysqli_query($db,"select * from learning_status join students USING(registration_no) join candidates USING(reference_no)")or die(mysqli_error($db));
  $counter=mysqli_num_rows($students);  
echo'<div class="panel-heading"><br><center> Record of '.$counter.' students Learning status </center><br></div><div class="panel-body">
  <div class="table-responsive"><center><table class="table" styles="border:5">';
echo'<thead><tr><th>Reg no</th><th>Names</th><th>Learning Status</th><th>Description</th><th>Date</th><th>Branch</th><th>Program</th></tr></thead><tbody>';
if($counter>0){
 while($read=mysqli_fetch_array($students)){
                            
                    echo"<tr>
<td>".$read['registration_no']."</td>
<td>".$read['first_name']." ".$read['last_name']."</td>
<td>".$read['status']."</td>
<td>".$read['status_description']."</td>
<td>".$read['status_date']."</td>
<td>".$read['branch_code']."</td>
<td>".$read['program_code']."</td>
</tr>";
               
                                                                                                    
                        }}
    
    
    
}
 if(isset($_POST['find'])){
 $reason=$_POST['reason'];
$student=$_POST['student'];
$students=mysqli_query($db,"select * from learning_status join students USING(registration_no) join candidates USING(reference_no) where registration_no='$student'")or die(mysqli_error($db));
     if($students){
$re=mysqli_fetch_array($students);
$first_name=$re['first_name']; 
$last_name=$re['last_name'];

 echo'<div class="panel-heading"><br><center>'.$first_name.'     '.$last_name.' learning Status</center><br></div><div class="panel-body">
  <div class="table-responsive"><center><table border=2 width=100%>';   
echo'<thead><tr><th>Status</th><th>Status description</th><th>Date</th></thead><tbody>';

  
 $reason=mysqli_query($db,"select * from learning_status join students USING(registration_no) join candidates USING(reference_no) where registration_no='$student'")or die(mysqli_error($db));
if($reason){
 while($re=mysqli_fetch_array($reason))  
 {
$status=$re['status'];
$status_description=$re['status_description'];
 $status_date=$re['status_date'];   
 echo"<tr>
<td>".$re['status']."</td>
<td>".$re['status_description']."</td>
<td>".$re['status_date']."</td>
</tr>";
}
 }}else{   
   echo "<tr><td colspan=3><center><font color='red'>please check registration number entered</font></center></td></tr>";
   echo "  <script>function goto(){
                        window.location='students.php';
                        
                        }
                        setInterval(goto,2000);
                        </script>";} 
 } 
                                                       
if(isset($_POST['program'])){
$program_name=$_POST['program_name'];
$da=explode("-",$program_name);
    $reason=$_POST['reason'];

 $students=mysqli_query($db,"select * from learning_status join students USING(registration_no) join candidates USING(reference_no) join applications using(reference_no) where candidates.program_code='$da[0]' and (learning_status.status='$reason' or applications.application_status='$reason')")or die(mysqli_error($db));
$count=mysqli_num_rows($students);

echo'<div class="panel-heading"><br><center>'.$da[1].'     '.$reason.' students ('.$count.') </center><br></div><div class="panel-body">
  <div class="table-responsive"><center><table border=2 width=100%>';   
echo'<thead><tr><th>Reg no</th><th>Full Names</th><th>Status</th><th>Email</th><th>Date</th><th>Branch</th>
<th>program</th>
</tr>
</thead><tbody>';   
if($count>0){
 while($read=mysqli_fetch_array($students)){
                            
                    echo"<tr>
<td>".$read['registration_no']."</td>
<td>".$read['first_name']." ".$read['last_name']."</td>
<td>".$read['status']."</td>
<td>".wordwrap($read['candidate_email'],20,"<br/>",true)."</td>
<td>".$read['status_date']."</td>
<td>".$read['branch_code']."</td>
<td>".$read['program_code']."</td>
</tr>";
               
                                                                                                    
                        }}
else{
echo"<tr><td colspan=8><center>no data found</center></td></tr>";
}
    
}
if(isset($_POST['findapp'])){
 $students=mysqli_query($db,"select * from learning_status join students USING(registration_no) join candidates USING(reference_no) join applications using(reference_no) where candidates.program_code='$da[0]' and (learning_status.status='$reason' or applications.application_status='$reason')")or die(mysqli_error($db));
$count=mysqli_num_rows($students);
   
    $student=$_POST['student'];
    echo $student;
    
}
if(isset($_POST['reject'])){
    

$data=explode("-",$_POST['program_name']);
echo'<div class="panel-heading"><br><center>'.$data[1].'   Students Learning Status</center><br></div><div class="panel-body">
  <div class="table-responsive"><center><table border=2 width=100%>';   
echo'<thead><tr><th>Reg no</th><th>Full Names</th><th>Status</th><th>Email</th><th>Date</th><th>Branch</th>
<th>program</th>
</tr>
</thead><tbody>'; 
   
 $students=mysqli_query($db,"select * from candidates join applications USING(reference_no) where applications.application_status='rejected' and candidates.program_code='04'")or die(mysqli_error($db));
     if(mysqli_num_rows($students)>0){                                                  
                    while($res=mysqli_fetch_array($students)){
     echo"<tr>
<td>".$res['reference_no']."</td>
<td>".$res['first_name']." ".$res['last_name']."</td>
<td>".$res['candidate_telephone']."</td>
<td class='center'>".$res['candidate_email']."</td>
<td class='center'>".$res['program_code']."</td>
<td class='center'>".$res['branch_code']."</td></tr>";
    
}}
echo"<tr><td colspan=8><center>no data found</center>

<script>function redirect(){
window.location='index.php'
}setInterval(redirect,1000)</sript>
</td></tr>";
}
                                                       if(isset($_POST['rejected'])){
                                                          
                                                           $data=explode("-",$_POST['program_name']);
                                                           
    echo'<div class="panel-heading"><br><center>'.$data[1].'   Rejected Applicants List</center><br></div><div class="panel-body">
  <div class="table-responsive"><center><table border=1 width=100%>';   
echo'<thead> <tr>
                                                                      <thead>
                                                                      <th>Refference NO</th>
                                                                      <th>Full Names</th>
                                                                      <th>Telephone</th>
                                                                      <th>Email</th>
                                                                    <th>Program</th>
                                                                    <th>Branch</th>
                                                                    
                                                                    
                                                                         
                                                                      </thead>
                                                                  </tr>
</thead><tbody>';
   $dbbranches=mysqli_query($db,"select * from candidates join applications USING(reference_no) where applications.application_status='rejected' and applications.program_code='$data[0]'") or die(mysqli_error($db));
               if(mysqli_num_rows($dbbranches)>0){                                                  
                    while($res=mysqli_fetch_array($dbbranches)){                  
                                                           
     echo"<tr>
<td>".$res['reference_no']."</td>
<td>".$res['first_name']." ".$res['last_name']."</td>
<td>".$res['candidate_telephone']."</td>
<td class='center'>".$res['candidate_email']."</td>
<td class='center'>".$res['program_code']."</td>
<td class='center'>".$res['branch_code']."</td>
</tr>";                                                       
                                                           
}}
        else{
            echo"<tr><td colspan=6><center>No data found
            <script>function goto(){
                        window.location='index.php';
                        
                        }
                        setInterval(goto,2000);
                        </script>
            </center></td></tr>";
        }
                                                           
               }

                                                                             
?></tbody></table>
                                            
            <?php 
$userdetails=mysqli_query($db,"select * from users join users_responsabilities using(user_respo_id) where users.email='$user'");
$recs=mysqli_fetch_array($userdetails);
$user=$recs['responsability'];
                                            
                                            
echo "<br><br><br>Done on    ".date('Y-M-d-(D)')."   By The ".$user;?> 
                                            </center>
</div>
    </div></div> </p>
</div>
</div>
</div>
                      </div>  </div>

                      </div>
              </div>
            </div>
            <!-- /.row -->
                          <!-- /.col-lg-4 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
</div>
             
    

 <script type="text/javascript">     
        function PrintDiv() {    
           var divToPrint = document.getElementById('divToPrint');
           var popupWin = window.open('', '_blank', 'width=300,height=300');
           popupWin.document.open();
           popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
                }
     </script>
	<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="js.js"></script>
<?php include("footer.php");?>
