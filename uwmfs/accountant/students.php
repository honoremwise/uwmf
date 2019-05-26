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
                  
</nav>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Students Panel</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
              <div class="panel-body">
                  <div class="panel-group" id="accordion">
      
                       <?php
if(isset($_GET['changes']))
     {
$change=mysqli_query($db,"update users set telephone='{$_GET['tel']}',last_name='{$_GET['lname']}',email='{$_GET['email']}',first_name='{$_GET['fname']}',password='{$_GET['pswd']}' where email='$user'");
    if($change){
        echo"<div class='alert alert-info alert-dismissable'>
                            <center><i class='fa fa-check'></i>Dear {$user} your information have been updated successfully!</center> 
                            
                        <script>function goto(){
                        window.location='students.php';
                        
                        }
                        setInterval(goto,1000);
                        </script>
                              </div>";
        
    }
    else {
        echo"<div class='alert alert-danger alert-dismissable'>
                            <center><i class='fa fa-check'></i>Dear {$user} somthing went wrong may be email or tel already exisit!</center> 
                            
                        <script>function goto(){
                        window.location='students.php';
                        
                        }
                        setInterval(goto,2000);
                        </script>
                              </div>";
        
    }
             
     }
if(isset($_GET['approve'])){

                                                                  
    echo" <div class='alert alert-warning alert-dismissable'>
  Are u sure you want to approve the applicants with this {$_GET['approve']} number to students of UWMF?<a href='students.php?approve_applicant={$_GET['approve']}' title='Approve applicant'><i class='btn btn-outline btn-primary fa fa-check'>  </i></a> </i>
or <a href='index.php' title='Reverify this '><i class='btn btn-outline btn-default fa fa-times'>  </i></a>
                              </div>";    
    
}
   
 if(isset($_GET['approve_applicant'])){
$var="";$test=0;$effective="";
  $is=$_GET['approve_applicant'];      
$fetchstudents=mysqli_query($db,"SELECT * FROM candidates join applications using (reference_no) where reference_no=$is");
if($fetchstudents){
$fecth=mysqli_fetch_array($fetchstudents);
$reference_no=$fecth['reference_no'];
$branch_code=$fecth['branch_code'];
$program_id=$fecth['program_code'];
$year_registered=$fecth['year_last_application'];
$code=substr($year_registered,2,2);
$da=mysqli_query($db,"select * from students where substr(reference_no,3,2)=$code");
$effective=mysqli_num_rows($da);
$turn=strlen($effective);
if($turn==1){
$effective=$effective+1;
 $var=$test.$test.$effective;  
}
if($turn==2){
$effective=$effective+1;
 $var=$test.$effective;  
}
if($turn==3){
$effective=$effective+1;
 $var=$effective;  
}
if($da){    
    
$regno=$branch_code.$code.$program_id.$var;  
$add=mysqli_query($db,"insert into students(registration_no,reference_no,year_registered) values('$regno','$reference_no','$year_registered')") or die(mysqli_error($db));
$learning=mysqli_query($db,"insert into learning_status (registration_no,status_date)values('$regno','$date')") or die(mysqli_error($db));
$candidate=mysqli_query($db,"update applications set application_status='approved' where reference_no=$reference_no")or die(mysqli_error($db));
   

    if($add){
return sendMail('iyaremyef@gmail.com',"test", "this is to test whether the msg can be sent on trial ");
    echo"<div class='alert alert-info alert-dismissable'>
                            <center><i class='fa fa-check'></i>Applicants added to student list successfully!</center> 
                            
                        <script>function goto(){
                        window.location='students.php';
                        
                        }
                        setInterval(goto,1000);
                        </script>
                              </div>";
        }
    else{
        echo mysqli_error($db);
    }
    
}
    else{
        echo mysqli_error($db);
    }
    

    
    
}
}
                      if(isset($_GET['learning'])){
                           echo" <div class='alert alert-info alert-dismissable'>
Change learning status of the student with the learning status identification no: {$_GET['learning']}?<i class='btn btn-outline btn-info fa fa-check' data-toggle='modal' data-target='#abcd' title='view more details about {$_GET['learning']} program'>  </i>
or <a href='students.php' title='cancel the process'><i class='btn btn-outline btn-default fa fa-times'>  </i></a>
                              </div>";
                          
                      }
    if(isset($_GET['change'])){
        
        
 $id=$_GET['id'];
$status=$_GET['status'];
$descr=$_GET['descr'];
        //echo $id."hdhhd".$status."ddd".$descr.$date;
$upda=mysqli_query($db,"insert into learning_status (registration_no,status,status_description,status_date)values('$id','$status','$descr','$date')");
if($upda){
    echo" <div class='alert alert-info alert-dismissable'>Learning status Updated Successfully
  <script>function goto(){
                        window.location='students.php';
                        
                        }
                        setInterval(goto,1000);
                        </script>
</div>";
    
}
        else{
           
 echo" <div class='alert alert-info alert-dismissable'>".mysqli_error($db)."
  <script>function goto(){
                        window.location='students.php';
                        
                        }
                        setInterval(goto,1000);
                        </script>
</div>";
        }
        
    }
    
        
                                                    ?>
                     
                      <div class="panel panel-primary">
                        <div id="collapseOne" class="panel-collapse collapse in">
                              <div class="panel-body">
                                                          <!-- Nav tabs -->
                                    <ul class="nav nav-tabs">
                                      <li class="active"><a href="#all-pills" data-toggle="tab">All admitted Students</a>
                                      </li>
                                        <li><a href="#Masters-pills" data-toggle="tab">Masters Students </a>
                                        </li>
                                        <li><a href="#Bachalor-pills" data-toggle="tab">Bachalor students </a>
                                        </li>
                                        <li><a href="#Certificate-pills" data-toggle="tab">Certificate Students</a>
                                        </li>
                                        <li><a href="#Diploma-pills" data-toggle="tab">Diploma students </a>
                                        </li>
                                      
                                        <li><a href="#status-pills" data-toggle="tab">Learning status </a>
                                        </li>
                                        
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div class="tab-pane fade" id="Masters-pills">
                                        
                                        <h4></h4>
                                            <p>  <div class="col-lg-12">
                                                                                        <div class="panel panel-primary">
                                                                                        <div class="panel-heading"><center>
                
                                                                                        Masters Students Records</center>
                                                                                        </div>
                                                                                        <div class="table-responsive">
                                                                                            <table class="table">
<thead>
<tr>
 <th>Reg no</th>
<th>Full Names</th>
<th>Telephone</th>
<th>Email</th>
<th>Program</th>
<th>Branch</th>
<th>Details</th>
</tr>
</thead>
<?php $students=mysqli_query($db,"select * from candidates join students USING(reference_no) where program_code='04'")or die(mysqli_error($db));
if(mysqli_num_rows($students)>0){
 while($res=mysqli_fetch_array($students)){
                            
                    echo"<tr>
<td>".$res['registration_no']."</td>
<td>".$res['first_name']." ".$res['last_name']."</td>
<td>".$res['candidate_telephone']."</td>
<td class='center'>".$res['candidate_email']."</td>
<td class='center'>".$res['program_code']."</td>
<td class='center'>".$res['branch_code']."</td>
<td class='center'>
<a href='students.php?viewmore={$res['candidate_id']}' title='Click to view more Details applicant'><i class='btn btn-outline btn-primary fa fa-eye'>  </i></a></td></tr>";
               
                                                                                                    
                        }
 } 
 else{
echo"<tr><td colspan=7><center>no data found</center><td></tr>";
}                                                                                                  ?>    <tbody>
 

                                                                                                </tbody>
                                                                                            </table>
                                                                                        </div>
                                                                                      </div>
                                                                                    </div>
                                                                                    </p>
                                        
                                        
                                        
                                        </div>
                                        <div class="tab-pane fade" id="Bachalor-pills">
                                        
                                       <h4></h4>
                                            <p>  <div class="col-lg-12">
                                                                                        <div class="panel panel-primary">
                                                                                        <div class="panel-heading"><center>
                
                                                                                        Bachalor Students Records</center>
                                                                                        </div>
                                                                                        <div class="table-responsive">
                                                                                            <table class="table">
 <thead>
<tr>
 <th>Reg no</th>
<th>Full Names</th>
<th>Telephone</th>
<th>Email</th>
<th>Program</th>
<th>Branch</th>
<th>Details</th>
</tr>
</thead>
<?php $students=mysqli_query($db,"select * from candidates join students USING(reference_no) where program_code='03'")or die(mysqli_error($db));
if(mysqli_num_rows($students)>0){
 while($res=mysqli_fetch_array($students)){
                            
                    echo"<tr>
<td>".$res['registration_no']."</td>
<td>".$res['first_name']." ".$res['last_name']."</td>
<td>".$res['candidate_telephone']."</td>
<td class='center'>".$res['candidate_email']."</td>
<td class='center'>".$res['program_code']."</td>
<td class='center'>".$res['branch_code']."</td>
<td class='center'>
<a href='students.php?viewmore={$res['candidate_id']}' title='Click to view more Details applicant'><i class='btn btn-outline btn-primary fa fa-eye'>  </i></a></td></tr>";
               
                                                                                                    
                        }}
  else{
echo"<tr><td colspan=7><center>no data found</center></td></tr>";
}
                                                                                                   ?>    <tbody>
 

                                                                                                </tbody>
                                                                                            </table>
                                                                                        </div>
                                                                                      </div>
                                                                                    </div>
                                                                                    </p>
                                        
                                        
                                        
                                        </div>
                                        <div class="tab-pane fade" id="Certificate-pills">
                                        
                                     <h4></h4>
                                            <p>  <div class="col-lg-12">
                                                                                        <div class="panel panel-primary">
                                                                                        <div class="panel-heading"><center>
                
                                                                                        Certificate students</center>
                                                                                        </div>
                                                                                        <div class="table-responsive">
                                                                                            <table class="table">
                                                                                         <thead>
<tr>
 <th>Reg no</th>
<th>Full Names</th>
<th>Telephone</th>
<th>Email</th>
<th>Program</th>
<th>Branch</th>
<th>Details</th>
</tr>
</thead>
<?php $students=mysqli_query($db,"select * from candidates join students USING(reference_no) where program_code='01'")or die(mysqli_error($db));
if(mysqli_num_rows($students)>0){
 while($res=mysqli_fetch_array($students)){
                            
                    echo"<tr>
<td>".$res['registration_no']."</td>
<td>".$res['first_name']." ".$res['last_name']."</td>
<td>".$res['candidate_telephone']."</td>
<td class='center'>".$res['candidate_email']."</td>
<td class='center'>".$res['program_code']."</td>
<td class='center'>".$res['branch_code']."</td>
<td class='center'>
<a href='students.php?viewmore={$res['candidate_id']}' title='Click to view more Details applicant'><i class='btn btn-outline btn-primary fa fa-eye'>  </i></a></td></tr>";
               
                                                                                                    
                        }}
  else{
echo"<tr><td colspan=7><center>no data found</center></td></tr>";
}
                                                                                                   ?>    <tbody>
 

                                                                                                </tbody>
                                                                                            </table>
                                                                                        </div>
                                                                                      </div>
                                                                                    </div>
                                                                                    </p>
                                        
                                        
                                        
                                        </div> 
                                        <div class="tab-pane fade" id="Diploma-pills">
                                        
                                 <h4></h4>
                                            <p>  <div class="col-lg-12">
                                                                                        <div class="panel panel-primary">
                                                                                        <div class="panel-heading"><center>
                
                                                                                        Diploma Students</center>
                                                                                        </div>
                                                                                        <div class="table-responsive">
                                                                                            <table class="table">
                                                                                               <thead>
<tr>
 <th>Reg no</th>
<th>Full Names</th>
<th>Telephone</th>
<th>Email</th>
<th>Program</th>
<th>Branch</th>
<th>Details</th>
</tr>
</thead>
<?php $students=mysqli_query($db,"select * from candidates join students USING(reference_no) where program_code='02'")or die(mysqli_error($db));
if(mysqli_num_rows($students)>0){
 while($res=mysqli_fetch_array($students)){
                            
                    echo"<tr>
<td>".$res['registration_no']."</td>
<td>".$res['first_name']." ".$res['last_name']."</td>
<td>".$res['candidate_telephone']."</td>
<td class='center'>".$res['candidate_email']."</td>
<td class='center'>".$res['program_code']."</td>
<td class='center'>".$res['branch_code']."</td>
<td class='center'>
<a href='students.php?viewmore={$res['candidate_id']}' title='Click to view more Details applicant'><i class='btn btn-outline btn-primary fa fa-eye'>  </i></a></td></tr>";
               
                                                                                                    
                        }}
    else{
echo"<tr><td colspan=7><center>no data found</center></td></tr>";
}
                                                                                                   ?>    <tbody>
 

                                                                                                </tbody>
                                                                                            </table>
                                                                                        </div>
                                                                                      </div>
                                                                                    </div>
                                                                                    </p>
                                        
                                        
                                        </div>
                                      <div class="tab-pane fade" id="status-pills">
                                            <h4></h4>
                                            <p>  <div class="col-lg-12">
                                                                                        <div class="panel panel-primary">
                                                                                        <div class="panel-heading"><center>
                
                                                                                        Students Learning status Records </center>
                                                                                        </div>
                                                                                        <div class="table-responsive">
                                                                                            <table class="table">
                                                                                                <thead>
<tr>
 <th>Reg no</th>
<th>Full Names</th>
<th>Status</th>
<th>Email</th>
<th>Date</th>
<th>Branch</th>
<th>program</th>
<th>options</th>
</tr>
</thead>
<?php $students=mysqli_query($db,"select * from learning_status join students USING(registration_no) join candidates USING(reference_no)")or die(mysqli_error($db));
if(mysqli_num_rows($students)>0){
 while($read=mysqli_fetch_array($students)){
                            
                    echo"<tr>
<td>".$read['registration_no']."</td>
<td>".$read['first_name']." ".$read['last_name']."</td>
<td>".$read['status']."</td>
<td>".wordwrap($read['status_description'],20,"<br/>",true)."</td>
<td>".$read['status_date']."</td>
<td>".$read['branch_code']."</td>
<td>".$read['program_code']."</td>
<td><a href='students.php?learning=".$read['registration_no']."-".$read['status']."' title='Update student learning status'><i class='btn btn-outline btn-warning fa fa-edit'>  </i></a></td>
</tr>";
               
                                                                                                    
                        }}
else{
echo"<tr><td colspan=8><center>no data found</center></td></tr>";
}
                                                                                                   ?>    <tbody>
 

                                                                                                </tbody>
                                                                                            </table>
                                                                                        </div>
                                                                                      </div>
                                                                                    </div>
                                                                                    </p>
                                    </div>
                                       
                                       
                                        <div class="tab-pane fade" id="Program-pills">
                                            <h4>Notifications</h4>
                                            <p><div class="alert alert-success alert-dismissable">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. <a href="#" class="alert-link">Alert Link</a>.
                                            </div>
                                            <div class="alert alert-info alert-dismissable">
                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. <a href="#" class="alert-link">Alert Link</a>.
                                            </div></p>
                                        </div>
                                        <div class="tab-pane fade in active" id="all-pills">
                                            <h4></h4>
                                            <p>    <div class="col-lg-12">
                                                   <div class="panel panel-primary">
                                                             
                                      
                                                      <div class="panel-heading">
                                                          <center> Students List </center>
                                                     </div>
                                                      <!-- /.panel-heading -->
                                                      <div class="panel-body">
                                                          <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
   <?php if(isset($_GET['viewmore'])){
    echo" <div class='alert alert-info alert-dismissable'>
                                  <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                 continue with record id {$_GET['viewmore']}?<i class='btn btn-outline btn-info fa fa-check' data-toggle='modal' data-target='#abc' title='view more details about applicants with id {$_GET['viewmore']}'>  </i>
|<a href='students.php' title='view more details about applicants with id {$_GET['viewmore']}'><i class='btn btn-outline btn-default fa fa-times'>  </i></a>|
                              </div>";
    
    
} 
                                                             
                                                                                                                        
?>   
<thead>
<tr>
 <th>Reg no</th>
<th>Full Names</th>
<th>Telephone</th>
<th>Email</th>
<th>Program</th>
<th>Branch</th>
<th>Details</th>
</tr>
</thead>
 <tbody>
<?php
$dbapplicant=mysqli_query($db,"select * from candidates join students USING(reference_no)") or die(mysqli_error($db));
                    while($res=mysqli_fetch_array($dbapplicant)){
echo"<tr>
<td>".$res['registration_no']."</td>
<td>".$res['first_name']." ".$res['last_name']."</td>
<td>".$res['candidate_telephone']."</td>
<td class='center'>".$res['candidate_email']."</td>
<td class='center'>".$res['program_code']."</td>
<td class='center'>".$res['branch_code']."</td>
<td class='center'>
<a href='students.php?viewmore={$res['candidate_id']}' title='Click to view more Details applicant'><i class='btn btn-outline btn-primary fa fa-eye'>  </i></a></td></tr>";
}?></tbody></table><!-- /.table-responsive -->
</div><!-- /.panel-body -->
    </div></div></div></div> </p>
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
    <!-- /#wrapper -->
<!-- student learning status model -->
<div class="row">
    <div id="divToPrint" >
    <div class="modal fade" id="abc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel"><center><?php
                                    if(isset($_GET['viewmore']))
                            {
                             echo  "Student info";
                            }
                             ?></center></h4>
                            </div>
                            <div class="modal-body">
                                
                              <?php
                                //retrieve specific applicant records
                                $msg="";$msgf1="";$msgf2="";$engwritten="";$engoral="";$msgf3="";$msgf4="";$id="";
if(isset($_GET['viewmore']))
{

$englishmarks=mysqli_query($db,"select english_interview_test,english_reading_test,reference_no from applications where reference_no in(select reference_no from candidates where candidate_id={$_GET['viewmore']})");
    if($englishmarks){
   if(mysqli_num_rows($englishmarks)>0)
   {
       $en=mysqli_fetch_array($englishmarks);
       $engwritten=$en['english_reading_test'];
       $engoral=$en['english_interview_test'];
       if($engwritten=="NULL"){
           $msgf3="no marks available";
       }
       else{
          $msgf3=$engwritten; 
       }
       if($engoral=="NULL"){
           echo "no marks available";
       }
       else{
          $msgf4=$engoral; 
       }
       
   }}
    else{
        echo mysqli_error($db); 
    } 
    
    
    
    
    
    
$applicants=mysqli_query($db,"SELECT * FROM candidates join applications using (reference_no) join church_information using(reference_no) WHERE candidates.candidate_id={$_GET['viewmore']}");

if($applicants)
{
$recs=mysqli_fetch_array($applicants);{
 $id=$recs['reference_no'];   
 //to find english marks   
   
    
  //to validate output  
 
if($recs["birth_certificate"]=="N/A")
  {
      $msgf1="<K style='color:red;'>Applicant did not Uploa the Birth certificate</K>";
  }
    else
    {
        $msgf1='<a href=\real"../../../../../real/profiles/'.$recs["birth_certificate"].'>View File<a/>';
    }

if($recs["motivation_letter"]=="")
{
   $msgf2="<K style='color:red;'>Applicant did not Upload Motivation Letter</K>";  
}
    else
    {
     $msgf2='<a href=\real"../../../../../real/profiles/'.$recs["motivation_letter"].'>View File<a/>';   
    }
   
echo '<div class="table-responsive">
                                                              <div class="panel panel-info">
                                                                  <div class="panel-heading">
                                                        <center>('.$recs['first_name'].'  '.$recs['last_name'].')   Application details</center>
                                                                  </div>
                                                                  
                                                                  <div class="panel-body">
                                                                      <div class="table-responsive">
                                                                          <table class="table" border=1>
                                                                              <tbody>
 <tr class=default><td colspan=2>';
 
 echo'<img src="\uwmf"../../../../../uwmf/profiles/'.$recs["photo"].'"style="width:113px;height:88px;"/></td>
       <td><u>English test Result:</u>
       <br>
       Interview:'.$msgf4.'<br>
       Written:'.$msgf3.'
       </td></tr>';                                                                          
echo '<tr class=info><td>Reference_no:'.$recs['reference_no'].'</td><td>Branch_code:'.$recs['branch_code'].'</td><td>Program Code:'.$recs['program_code'].'</td>
       </tr>
<tr class=default><td colspan=3><center><b>Applicant Details</b><center></td>
       </tr>
<tr class=success><td>E-mail:<br>'.$recs['candidate_email'].'</td><td>Tel:'.$recs['candidate_telephone'].'</td><td>ID/Passport:'.$recs['id_passport'].'</td>
       </tr>
<tr class=warning><td>Gender:'.$recs['gender'].'</td><td>DOB:'.$recs['dob'].'</td><td>Nationality:'.$recs['nationality'].'</td>
       </tr> 
</tr>
<tr class=info><td>Province:'.$recs['address_province'].'</td><td>District:'.$recs['address_district'].'</td><td>Current Redince:'.$recs['current_address'].'</td>
       </tr>
<tr class=default><td colspan=3><center><b>Education Information</b><center></td>
       </tr>
<tr class=info><td>Education:<br>'.$recs['education_background'].'</td><td>College:'.$recs['college_name'].'</td><td>Option:'.$recs['previous_subject'].'</td>
       </tr>
<tr class=warning><td>Highest Degree:<br>'.$recs['highest_degree'].'</td><td>Graduation Date :'.$recs['date_graduated'].'</td><td>College Location:<br>'.$recs['college_location'].'</td>
       </tr>
<tr class=default><td colspan=3><center><b>Submitted Application documents</b><center></td>
       </tr>
<tr class=Success><td>Id or Passport File:<br><a href=\real"../../../../../real/profiles/'.$recs["scanned_id"].'>View File<a/></td><td>Degree file :<br><a href=\real"../../../../../real/profiles/'.$recs["degree_copy"].'>View File<a/></td>
<td>Birth Certificate :<br>'.$msgf1.'</td>
       </tr>
<tr class=info><td colspan=3><center>Recommendation  letter file :
<a href=\real"../../../../../real/profiles/'.$recs["recomm_letter"].'>View File <a/></center></td></tr>
<tr><td colspan=3><center>Motivation Letter file  '.$msgf2.'<center></td>
       </tr>
 <tr class=default><td colspan=3><center><b>Church information</b><center></td>
       </tr>  
<tr class=warning><td>Denomination:<br>'.$recs['denomination'].'</td><td>Church Name:<br>'.$recs['church_name'].'</td><td>Church Address:'.$recs['church_address'].'</td></tr>
<tr class=info><td>Church Contact:'.$recs['church_phone'].'</td><td colspan=2>Church Pastor:'.$recs['church_pastor'].'</td></tr>
<tr class=warning><td>Other experience:'.$recs['otherwork_cmp'].'</td><td>Started at:'.$recs['otherwork_startdate'].'</td><td>Province:'.$recs['otherwork_province'].'</td></tr>
<tr class=info><td>District:'.$recs['otherwork_district'].'</td><td>Job Not related to Church:'.$recs['realwork_cmp'].'</td><td>Position:'.$recs['realwork_pos'].'</td></tr>
<tr class=warning><td>Date Started:'.$recs['realwork_start'].'</td><td>Province:'.$recs['realwork_pro'].'</td><td>District:'.$recs['realwork_dist'].'</td></tr>
                                                                               
                                                                               
                                                                              </tbody>
                                                                          </table>
                                                                      </div>
                                                                      
                                                                  </div>
                                                                  
                                                              </div>
                                                              
                                                          </div>';        
}
 }   
    
} 
?>
                             
                            </div>
                            <div class="modal-footer">
                                <?php echo "<a href='students.php'>Close</a>";?>
                                <input type="button" value="print" onclick="PrintDiv();" />
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
        
    </div>
                <div class="modal fade" id="abcd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel"><?php
                                                 if(isset($_GET['learning'])){
                                            $va=explode("-",$_GET['learning']);
           
            $v=mysqli_query($db,"select * from learning_status where registration_no='$va[0]'");
        
$mf=mysqli_fetch_array($v); 
$registration_no=$mf['registration_no'];
$status=$mf['status'];
$status_description=$mf['status_description'];
$status_date=$mf['status_date'];

                                            
                                                 }
 echo "<center>".$registration_no." Learning status details</center>";                                                
                                                ?> </h4>
                                        </div>
                                        <div class="modal-body">
                                           
                                            <div class="panel-body">
                                             <form role="form" method="get" action="#">
                                              <br>
                                           
    <input type="text" name="id" value="<?php echo $registration_no;?>" hidden> 
   
        <div class="form-group">
      <label>Student Regno:</label>                                          
    <input type="text" class="form-control" name="regno" value="<?php echo $registration_no;?>" disabled>
  </div> 
<div class="form-group">
<label>Learning Stutas:</label>  
<select type="text" class="form-control" name="status">
    <option><?php echo $status;?></option>
    <option>Dropout</option>
    <option>Suspended</option>
    <option>Returned</option>
    </select>
</div>
<div class="form-group ">
<label>Description:</label> 
<input type="text" class="form-control" name="descr" value="<?php echo $status_description;?>" maxlength="100">
</div> 
<div class="form-group">
<label>Satarted Date:</label>
<input type="text" class="form-control" name="email" value="<?php echo $status_date;?>" disabled>
</div> 
                                                <center>
                                              <button type="submit" class="btn btn-outline btn-info btn-sm " name="change" required>Save update</button>|
                                                    <a href="students.php" class="btn btn-outline btn-primary btn-sm " name="cancel">Back</a>
                                                    
                                                    
                                                    </center>

                                              <br>
                                              </form>
                                            
                                        </div> </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>

                <div class="modal fade" id="ab" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Module Learning Status</h4>
                                        </div>
                                        <div class="modal-body">

                                          <div class="panel-body">
                                              <!-- Nav tabs -->
                                             

                                              <!-- Tab panes -->
                                              
                                          </div>
                                                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                <!-- /.modal -->

            <!-- .panel-body -->

        <!-- /.panel -->

    <!-- /.col-lg-6 -->

    <!-- /.col-lg-6 -->
</div>
<div class="modal fade" id="abp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel"><center> My Credithentials</center></h4>
                                        </div>
                                        <div class="modal-body">

                                          <div class="panel-body">
                                              
        
                                                    
                    <?php
                                                                                            
      $data=mysqli_query($db,"select * from users where email='$user'")or die (mysqli_error($db));
        $ret=mysqli_fetch_array($data); 
        $fname=$ret['first_name'];
        $lname=$ret['last_name'];
       $email=$ret['email'];
    $password=$ret['password'];
    $telephone=$ret['telephone'];
                                                                                             
?>
                                                   
                                                <form role="form" method="get" action="#">
                                              <br>
  <div class="form-group">
      <label>Current Firstname:</label>                                          
    <input type="text" class="form-control" name="fname" value="<?php echo $fname;?>">
  </div> 
<div class="form-group">
<label>Current Lastname:</label>  
<input type="text" class="form-control" name="lname" value="<?php echo $lname;?>">
</div>
<div class="form-group ">
<label>Current Telephone:</label> 
<input type="number" class="form-control" name="tel" value="<?php echo $telephone;?>" maxlength="10">
</div> 
<div class="form-group">
<label>Current Email Address:</label>
<input type="text" class="form-control" name="email" value="<?php echo $email;?>">
</div> 
 <div class="form-group">
<label>Current Password:</label>
<input type="text" class="form-control" name="pswd" value="<?php echo $password;?>"></div>
                                                <center>
                                              <button type="submit" class="btn btn-outline btn-info btn-sm " name="changes" required>Save update</button>|
                                                    <a href="students.php" class="btn btn-outline btn-primary btn-sm " name="cancel" required>Back</a>
                                                    
                                                    
                                                    </center>

                                              <br>
                                              </form>
                                             
                                          </div>
                                                                        </div>

                                     
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>   
<!-- end of student learning stutas  -->
    <!-- jQuery -->
    <!-- Page-Level Demo Scripts - Notifications - Use for reference -->
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
<!--<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>-->
<script type="text/javascript" src="js.js"></script>
<?php include("footer.php");?>
