<?php
include'../access.php';
include("../dboperations.php");
include("header.php");
$user=$_SESSION["username"];
$date=date('Y-m-d');
$dv=substr($date,0,4);
require('mails/mail.php');
?> 
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>UWMS-MIS</title>

    <!-- Bootstrap Core CSS -->
    <link href="../../css_scripts/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../../css_scripts/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../../css_scripts/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../../css_scripts/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
               <a class="navbar-brand" href="../logout.php"><img src="http://localhost/real/css_scripts/vendor/datatables/images/test.png" width="40" height="40" class="img-circle"></a>
            
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                         <li><a href="#" ><i class="fa fa-user fa-fw" data-toggle="modal" data-target="#abp"></i> <label data-toggle="modal" data-target="#abp">
                                    User Profile
                                </label></a>
                        </li>                      
                        <li><a href="../logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
 <div class="navbar-default sidebar">
                 <div class="sidebar-nav navbar-collapse">

                   <div class="col-lg-12 col-md-6">
                                  <div class="panel panel-primary">
                           
                            <a href="students.php">
                                <div class="panel-footer">
                                  <span class="pull-left">
             <?php
                                        
                $qer=mysqli_query($db,"select * from students")or die(mysqli_error($db));
              $recors=mysqli_num_rows($qer); 
                                            echo $recors;
                                           ?>
                                    Students in the database
                                     
                                  </span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
            <div class="panel panel-primary">
                             <a href="index.php">
                                <div class="panel-footer">
                                  <span class="pull-left">
                                      Home
                                  </span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div> 
                     
                     


                      </div></div></div>
                  
</nav><div class="navbar-default sidebar">
                <div class="sidebar-nav navbar-collapse">

                  <div class="col-lg-12 col-md-6">
                                     <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                       <div class="huge"><?php
                                            $number=0;
                $qer=mysqli_query($db,"select *from students")or die(mysqli_error($db));
              $recors=mysqli_num_rows($qer); 
                                            echo $recors;
                                       ?> 
                                        </div>
                                        <div><br>Total Students!</div>
                                    </div>
                                </div>
                            </div>
                            <a href="students.php">
                                <div class="panel-footer">
                                  <span class="pull-left">
                                      View details report
                                  </span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
 <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <center><a href=index.php><font color='#fff'><i class="fa fa-home fa-5x"></i></font></a></center>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                      </div>
                  </div>
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Accountant Dashboard</h1><button type='button' onclick='PrintDiv();' class='btn btn-outline btn-info fa fa-print' title="Print this"></button>
                </div>
            </div>
            <div id="divToPrint" >
            <div class="row">               
                           <div id="collapseOne" class="panel-collapse collapse in">
                                                       
                                        <div class="tab-pane fade in active" id="applicants-pills">
                                            
                                            <p>    <div class="col-lg-12">
                                                   <div class="panel panel-primary">

    <?php 
    if(isset($_GET['viewpending'])){
    $dbapplicant=mysqli_query($db,"SELECT * FROM candidates join applications using (reference_no) where application_status='pending'") or die(mysqli_error($db));
    $counter=mysqli_num_rows($dbapplicant);
  echo'<div class="panel-heading"><br><center>'.$counter.' Pending Applications </center><br></div><div class="panel-body">
  <div class="table-responsive"><center><table class="table">';      
echo'<thead><tr><th>Applicants code</th><th>Full Names</th><th>Telephone</th><th>Email</th><th>Program</th></tr></thead><tbody>';
                    while($res=mysqli_fetch_array($dbapplicant)){
echo"<tr>
<td>".$res['reference_no']."</td>
<td>".$res['first_name']." ".$res['last_name']."</td>
<td>".$res['candidate_telephone']."</td>
<td class='center'>".$res['candidate_email']."</td>
<td class='center'>".$res['program_id']."</td>
</tr>";
}}
if(isset($_GET['viewallocated'])){
$lecturer=mysqli_query($db,"select * from users join modules_programs USING(user_id) JOIN modules USING (module_id) join programs using (program_id) where responsability='Lecturer'")or die(mysqli_error($db));
$counter=mysqli_num_rows($lecturer);
echo'<div class="panel-heading"><br><center>'.$counter.'  Allocated Module </center><br></div><div class="panel-body">
  <div class="table-responsive"><center><table class="table">';
echo'<thead><tr><th>Full Names</th><th>Email</th><th>Telephone</th><th>Module code</th><th>Module Name</th><th>Program</th>
</tr></thead><tbody>';
 if($counter>0){
            while($lines=mysqli_fetch_array($lecturer)){
                echo " <tr class='success'><td>".$lines['first_name']."  ".$lines['last_name']."</td><td>".$lines['email']."</td>
                <td>".$lines['telephone']."</td><td>".$lines['module_code']."</td><td>".$lines['module_name']."</td><td>".$lines['program_code']."</td></tr>";
                
                
            }
            
            
        }
    else{
echo '<tr><td colspan=6><center>No records found</center></td></tr>';
    }
    
}
if(isset($_GET['viewprograminfo'])){
$dbapplicant=mysqli_query($db,"select * from programs") or die(mysqli_error($db));
$counter=mysqli_num_rows($dbapplicant);
echo'<div class="panel-heading"><br><center>'.$counter.'   School Program infos</center><br></div><div class="panel-body">
  <div class="table-responsive"><center><table class="table">';
echo'<thead><tr><th>Program Name</th><th>Learning period</th><th>Program description</th><th>Program code</th></tr></thead><tbody>';

                    while($res=mysqli_fetch_array($dbapplicant)){
 echo"<tr class='panel panel-info'>
 <td>".$res['program_name']."</td><td>".$res['number_of_levels']."</td><td>".wordwrap($res['description'],30,"<br>",true)."</td><td>".$res['program_code']."</td></tr>";
    
}}
if(isset($_GET['viewunassigned'])){
$lecturer=mysqli_query($db,"SELECT * FROM `modules` WHERE module_id not in(select module_id from modules_programs)")or die(mysqli_error($db));
    $counter=mysqli_num_rows($lecturer);
echo'<div class="panel-heading"><br><center>'.$counter.'    Modules that have not yet been Assigned to Programs</center><br></div><div class="panel-body">
  <div class="table-responsive"><center><table class="table">';
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
echo'<div class="panel-heading"><br><center>'.$counter.'    University Branches</center><br></div><div class="panel-body">
  <div class="table-responsive"><center><table class="table">';
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
  <div class="table-responsive"><center><table class="table">';
echo'<thead><tr><th>Applicant Refence number</th><th>Full Names</th><th>Telephone</th><th>E-mail</th><th>Program </th></tr></thead><tbody>';
if($dbapplicant and $counter>0){
            while($res=mysqli_fetch_array($dbapplicant)){
                        echo"<tr>
<td>".$res['reference_no']."</td>
<td>".$res['first_name']." ".$res['last_name']."</td>
<td>".$res['candidate_telephone']."</td>
<td class='center'>".$res['candidate_email']."</td>
<td class='center'>".$res['program_id']."</td>
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
echo'<div class="panel-heading"><br><center>'.$counter.'   Currently Registered students</center><br></div><div class="panel-body">
  <div class="table-responsive"><center><table class="table">';
echo'<thead><tr><th>Registration NUmber</th><th>Full Names</th><th>Telephone</th><th>E-mail</th><th>Program </th><th>Branch Code</th></tr></thead><tbody>';
                    while($res=mysqli_fetch_array($dbapplicant)){
echo"<tr>
<td>".$res['registration_no']."</td>
<td>".$res['first_name']." ".$res['last_name']."</td>
<td>".$res['candidate_telephone']."</td>
<td class='center'>".$res['candidate_email']."</td>
<td class='center'>".$res['program_id']."</td>
<td class='center'>".$res['branch_code']."</td>
</tr>";
}
}
if(isset($_GET['viewstatus'])){
$students=mysqli_query($db,"select * from learning_status join students USING(registration_no) join candidates USING(reference_no)")or die(mysqli_error($db));
  $counter=mysqli_num_rows($students);  
echo'<div class="panel-heading"><br><center> Record of '.$counter.' students Learning status </center><br></div><div class="panel-body">
  <div class="table-responsive"><center><table class="table">';
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
<td>".$read['program_id']."</td>
</tr>";
               
                                                                                                    
                        }}
    
    
    
}                                                                

    

                                                                             
?></tbody></table>
                                            
            <?php 
$userdetails=mysqli_query($db,"select * from users where username='$user'");
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
