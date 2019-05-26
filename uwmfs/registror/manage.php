<?php
include'../access.php';
include("../dboperations.php");
include("header.php");
$user=$_SESSION["username"];
$date=date('Y-m-d');
?>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Academic Registrar Dashboard</h1>
                </div>
              
            </div>
            <!-- /.row -->
            <div class="row">
              <div class="panel-body">
                  <div class="panel-group" id="accordion">
                       <?php 
if(isset($_POST['addprogram']))
{
    $dt=date('Y-m-d');
    $program=$_POST['program'];$levels=$_POST['levels'];$desc=$_POST['desc'];$code=$_POST['code'];$max=$_POST['max'];
    $ins=mysqli_query($db,"insert into programs (program_name,number_of_levels,description,starting_date,program_code,maximum_modules)values
    ('$program',$levels,'$desc','$dt','$code',$max)");
if($ins) 
{
echo"<div class='alert alert-info alert-dismissable'>
                            <center>Program successfully recorded<i class='fa fa-check'></i>  <center>
                            
                        <script>function goto(){
                        window.location='manage.php';
                        
                        }
                        setInterval(goto,2000);
                        </script>
                              </div>";
} 
else{
echo"<div class='alert alert-info alert-dismissable'>
                            <i class='fa fa-times'></i>something went wrong with insertion ,program already existin the database.                      
                              <script>function goto(){
                        window.location='manage.php';
                        
                        }
                        setInterval(goto,2000);
                        </script>
                              </div>";
   }      
 }
if(isset($_POST['savemodule'])){
    
$program=$_POST['program'];
$levels=$_POST['levels'];
$course=$_POST['course'];
$lecturers=$_POST['lecturers'];
$ms=mysqli_query($db,"insert into modules_programs(program_id,module_id,level_of_study,addition_date,user_id)values
    ($program,$course,$levels,'$date',$lecturers)");
    if($ms){
        echo"<div class='alert alert-info alert-dismissable'>
                            <center>Program successfully recorded<i class='fa fa-check'></i>  <center>
                            
                        <script>function goto(){
                        window.location='manage.php';
                        
                        }
                        setInterval(goto,2000);
                        </script>
                              </div>";
    }
    else{
        echo mysqli_error($db);
    }
}                     
if(isset($_GET['change']))
     {
$change=mysqli_query($db,"update users set telephone='{$_GET['tel']}',last_name='{$_GET['lname']}',email='{$_GET['email']}',first_name='{$_GET['fname']}',password='{$_GET['pswd']}' where email='$user'");
    if($change){
        echo"<div class='alert alert-info alert-dismissable'>
                            <center><i class='fa fa-check'></i>Dear {$user} your information have been updated successfully!</center> 
                            
                        <script>function goto(){
                        window.location='manage.php';
                        
                        }
                        setInterval(goto,2000);
                        </script>
                              </div>";
        
    }
    else {
        echo"<div class='alert alert-danger alert-dismissable'>
                            <center><i class='fa fa-check'></i>Dear {$user} somthing went wrong may be email or tel already exisit!</center> 
                            
                        <script>function goto(){
                        window.location='manage.php';
                        
                        }
                        setInterval(goto,2000);
                        </script>
                              </div>";
        
    }
             
     } 
 if(isset($_POST['cancel'])){
        echo"<script>
                        window.location='manage.php';
                   </script>
                ";  
     } 
if(isset($_GET['reject'])){
     echo" <div class='alert alert-danger alert-dismissable'>
                                  <Center>
                                Are you sure you want to reject this applicant with this {$_GET['reject']}?
                                 reference number? <a href='manage.php?reject1={$_GET['reject']}' title='Reject this candidate'><i class='btn btn-outline btn-danger fa fa-check'> </i></a>|<a href='manage.php' title='cancel Rejection of this applicant'><i class='btn btn-outline btn-primary fa fa-times'>  </i></a><Center>
                              </div>";
}
 if(isset($_GET['reject1'])){
    $reject=mysqli_query($db,"update applications set application_status='rejected' where reference_no={$_GET['reject1']}");
     if($reject){
  echo"<div class='alert alert-info alert-dismissable'>
                            <i class='fa fa-times'></i>Rejected 
                            <script>function goto(){
                        window.location='manage.php';
                        
                        }
                        setInterval(goto,1000);
                        </script>
                              </div>"; 
    }
     else
     {
        echo mysqli_error($db)." <script>function goto(){
                        window.location='manage.php';
                        
                        }
                        setInterval(goto,3000);
                        </script>";
     }
     
 }           
  if(isset($_POST['addmodule']))
  {
       $Module_name=$_POST['Module_name'];$credits=$_POST['credits'];$modulehours=$_POST['modulehours'];$Module_code=$_POST['Module_code'];
    $insert=mysqli_query($db,"insert into modules (module_code,module_name,module_credits,study_hours)values
    ('$Module_code','$Module_name',$credits,$modulehours)");
         if($insert) {
              echo"<div class='alert alert-info alert-dismissable'>
                            <center><i class='fa fa-check'></i> module inserted successfully!</center> 
                            
                        <script>function goto(){
                        window.location='manage.php';
                        
                        }
                        setInterval(goto,1000);
                        </script>
                              </div>";
         } 
                                                            else{
                                                                
     echo"<div class='alert alert-danger alert-dismissable'>
                            <center><i class='fa fa-close'></i> module name or module code already exist please look for a new name or new code for this module !</center> 
                            
                        <script>function goto(){
                        window.location='manage.php';
                        
                        }
                        setInterval(goto,3000);
                        </script>
                              </div>"; 
                                                            }
                                                            
                                                            
                                                        }
                                                        
                                                        ?>
<?php
                                                    if(isset($_POST['savebranch'])){
    $branch_name=$_POST['branch_name'];$branch_district=$_POST['branch_district'];$branch_code=$_POST['branch_code'];$branch_country=$_POST['branch_country'];
    $insert=mysqli_query($db,"insert into branches (branch_name,branch_code,branch_location,branch_country)values
    ('$branch_name','$branch_code','$branch_district','$branch_country')");
         if($insert) {
              echo"<div class='alert alert-info alert-dismissable'>
                            <center><i class='fa fa-check'></i> branch inserted successfully!</center> 
                            
                        <script>function goto(){
                        window.location='manage.php';
                        
                        }
                        setInterval(goto,1000);
                        </script>
                              </div>";
                                                        
                                                        
                                                    }
     echo"<div class='alert alert-danger alert-dismissable'>
                            <center><i class='fa fa-check'></i>". mysqli_error($db)."</center> 
                            
                        <script>function goto(){
                        window.location='manage.php';
                        
                        }
                        setInterval(goto,2000);
                        </script>
                              </div>";
                                                        
                                                        
                                                    
                                                    }
                      
                      if(isset($_POST['allocate'])){
                          $user=$_POST['user'];
                          $module=$_POST['module'];
                          $fac=explode('-',$module);                 
                          $qry=mysqli_query($db,"update modules_programs set user_id=$user where program_id=$fac[1] and module_id=$fac[0]");
                          if($qry){
                              echo"<div class='alert alert-info alert-dismissable'>
                            <center><i class='fa fa-check'></i> Module allocation done success fully !</center> 
                            
                        <script>function goto(){
                        window.location='manage.php';
                        
                        }
                        setInterval(goto,1000);
                        </script>
                              </div>";
                              
                          }
                          else{
                              echo mysqli_error($db);
                          }
    
                          
                      }
                    if(isset($_GET['dealocate'])){
                        $vars=explode('-',$_GET['dealocate']); 
        $dealacate=mysqli_query($db,"update modules_programs set user_id=0 where program_id=$vars[2] and module_id=$vars[1]");
    if($dealacate){
                              echo"<div class='alert alert-info alert-dismissable'>
                            <center><i class='fa fa-check'></i> Module Deallocation done success fully !</center> 
                            
                        <script>function goto(){
                        window.location='manage.php';
                        
                        }
                        setInterval(goto,1000);
                        </script>
                              </div>";
                              
                          }
                          else{
                              echo mysqli_error($db);
                          }
                        
                    }
        if(isset($_GET['editmodule'])){
            
                echo" <div class='alert alert-warning alert-dismissable'>
                                  <center>
                                 Proceed to update the module with id {$_GET['editmodule']}?<i class='btn btn-outline btn-info fa fa-check' data-toggle='modal' data-target='#abcd' title='view more details about applicants with id {$_GET['editmodule']}'>  </i><a href='manage.php' title='view more details about applicants with id {$_GET['editmodule']}'><i class='btn btn-outline btn-primary fa fa-times'>  </i></a><center>
                              </div>";

            
        }
if(isset($_GET['updatemodule'])){
    $hours=$_GET['hours'];
    $credits=$_GET['credits'];
    $code=$_GET['code'];
    $mdl=$_GET['mdl'];
    $module_id=$_GET['module_id'];
    $qry=mysqli_query($db,"update modules set module_code='$code',module_name='$mdl',module_credits=$credits,	study_hours=$hours where module_id=$module_id");
    if($qry){   
    echo"<div class='alert alert-info alert-dismissable'>
                            <center>Module edited successfully recorded<i class='fa fa-check'></i>  <center>
                            
                        <script>function goto(){
                        window.location='manage.php';
                        
                        }
                        setInterval(goto,2000);
                        </script>
                              </div>";}
    else{
        echo mysqli_error($db);
    }
    
}
                      if(isset($_GET['back'])){
                          echo"<script>function goto(){
                        window.location='manage.php';
                        
                        }
                        setInterval(goto,100);
                        </script>";
                          
                      }
 if(isset($_GET['updatethis'])){
                                   
                                    
$program=$_GET['program'];
$levels=$_GET['levels'];
$code=$_GET['code'];
$desc=$_GET['desc'];
$program_id=$_GET['program_id'];
$modules=$_GET['modules'];

if($desc==""){
$up=mysqli_query($db,"update programs set program_name='$program',maximum_modules=$modules,number_of_levels=$levels,program_code='$code' where program_id=$program_id")or die(mysqli_error($db));
    if($up){
        echo"<div class='alert alert-info alert-dismissable'>
                            <center>Program successfully Updated<i class='fa fa-check'></i>  <center>
                            
                       
        <script>function goto(){
                        window.location='manage.php';
                        
                        }
                        setInterval(goto,1000);
                        </script>
                              </div>";
       
    }
 else{
            echo mysqli_error($db);
        }
}
    
    else if($desc!="")
      { 
    $up2=mysqli_query($db,"update programs set program_name='$program',description='$desc',number_of_levels=$levels,program_code='$code' where program_id=$program_id")or die(mysqli_error($db));
    if($up2){
        echo" <div class='alert alert-info alert-dismissable'>
                            <center>Program successfully Updated<i class='fa fa-check'></i>  <center>
                            <script>function goto(){
                        window.location='manage.php';
                        
                        }
                        setInterval(goto,1000);
                        </script>
                              </div>";
    
    }
        else
{
    echo mysqli_error($db);
}
    
}

                                    
  }  
if(isset($_GET['editbranch'])){
    
  echo" <div class='alert alert-warning alert-dismissable'>
                                  <Cente>
                                 Proceed to update the Branch with id {$_GET['editbranch']}?<i class='btn btn-outline btn-info fa fa-check' data-toggle='modal' data-target='#abcde' title='view more details about applicants with id {$_GET['editbranch']}'>  </i><a href='manage.php' title='view more details about applicants with id {$_GET['editbranch']}'><i class='btn btn-outline btn-primary fa fa-times'>  </i></a><Cente>
                              </div>";
    
}
if(isset($_GET['updatebranch']))
{
$branch_name=$_GET['branch_name'];
$branch_id=$_GET['branch_id'];
$branch_code=$_GET['branch_code'];
$branch_location=$_GET['branch_location'];
$branch_country=$_GET['branch_country'];
$qery=mysqli_query($db,"update branches set branch_name='$branch_name',branch_code='$branch_code',branch_location='$branch_location',branch_country='$branch_country' where branch_id=$branch_id");
    if($qery){
 echo" <div class='alert alert-info alert-dismissable'>
                            <center>Branch successfully Updated<i class='fa fa-check'></i>  <center>
                            <script>function goto(){
                        window.location='manage.php';
                        
                        }
                        setInterval(goto,1000);
                        </script>
                              </div>";    
    }
}
                      if(isset($_GET['programdetails'])){
 echo" <div class='alert alert-warning alert-dismissable'>
                                  <Cente>
                                 Proceed to update the Program with id {$_GET['programdetails']}?<i class='btn btn-outline btn-info fa fa-check' data-toggle='modal' data-target='#ab' title='view more details about applicants with id {$_GET['programdetails']}'>  </i><a href='manage.php' title='view more details about applicants with id {$_GET['programdetails']}'><i class='btn btn-outline btn-primary fa fa-times'>  </i></a><Cente>
                              </div>";                        
                      }
                      
                      
                                                    ?>
                      
                      <div class="panel panel-primary">
                                            <div id="collapseOne" class="panel-collapse collapse in">
                              <div class="panel-body">
                                                          <!-- Nav tabs -->
                                    <ul class="nav nav-tabs">
                                  <li class="active"><a href="#teach-pills" data-toggle="tab">Lecturers Module allocation</a>
                                        </li>
                                        <li><a href="#SchoolProgram-pills" data-toggle="tab">Manage School programs </a>
                                        </li>
                                        <li><a href="#Module-pills" data-toggle="tab">Manage Modules </a>
                                        </li>
                                         <li><a href="#Branches-pills" data-toggle="tab">Manage Branches </a>
                                        </li>

                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div class="tab-pane fade" id="Lecturer-pills">
                                            <h4></h4>
                                            <p>  <div class="col-lg-12">
                                  <div class="panel panel-primary">
                              <div class="panel-heading">
                                                                                        Students records
                          </div>
                          <form role="form" method="post">
                                              <br>
                                              <div class="form-group">

                                              <input type="text" class="form-control" placeholder="Firstname" name="lecturerf" required>

                                              </div>
                                              <div class="form-group">
                                               <input type="text" class="form-control" placeholder="Last Name" name="lname" required>
                                              </div> 
                                                    <div class="form-group">
                                               <input type="text" class="form-control" placeholder="Branch Code" name="branch_code" required>
                                              </div>
                                            <div class="form-group">
                                               <input type="text" class="form-control" placeholder="Branch Country" name="email" required>
                                              </div>


                                              <center>
                                              <button type="submit" class="btn btn-outline btn-primary btn-sm " name="savebranch">Save</button></center>

                                              <br>
                                              </form>
                                                                                      </div>
                                                                                    </div>
                                                                                    </p>
                                    </div>
                                        <div class="tab-pane fade in active" id="teach-pills">
                                            <h4></h4>
                                            <p><div class="col-lg-2"> </div>
                                                   <div class="col-lg-8"> 
                                                  <div class="panel panel-primary">
                                                                  <div class="panel-heading">
                                                                    <center>  Allocate modules to a specific Lecturer</center>
                                                                  </div>
                                                  


<form role="form" method="post" action="#">
<br>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-user"></i></span>
    <select class="form-control" name="user">
    <?php      

    $qry=mysqli_query($db,"select * from users join users_responsabilities USING(user_respo_id) where responsability='Lecturer'")or die(mysqli_query($db));
    if(mysqli_num_rows($qry)>0)
    {
    while($pro=mysqli_fetch_array($qry))
    {
echo "<option value=".$pro['user_id'].">".$pro['first_name']." ".$pro['last_name']."</option>";
        
    }}
    else{
      echo "<option>no programs in db</option>";  
    }

    ?>
    
</select>
</div>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-book"></i></span>
<select class="form-control" name="module">
<?php  

$mdl=mysqli_query($db,"select * from modules JOIN modules_programs USING (module_id) JOIN programs USING(program_id) WHERE user_id=0");
    if(mysqli_num_rows($mdl)>0)
    {
    while($pro=mysqli_fetch_array($mdl))
    {
echo "<option value=".$pro['module_id']."-".$pro['program_id'].">".$pro['program_code']."-".$pro['module_name']."</option>";
        
    }}
    else{
      echo "<option>No records found in db</option>";  
    }
    
    ?>
</select>
   </div><center>
<br>
    <button type="submit" name="allocate" class="btn btn-outline btn-primary">Allocate Module</button></center>
                                                     
                                                              </form>
 

 <br>
                                                  
                                                            </div></div>

                                            <div class="col-lg-12"><br></div>
                                                          <div class="col-lg-12">
                                                              <div class="table-responsive">
                                                              <div class="panel panel-primary">
                                                                  <div class="panel-heading">
                                                                        <center>
     <?php
   $lecturer=mysqli_query($db,"select * from users join modules_programs USING(user_id) JOIN modules USING (module_id) join programs using (program_id) join users_responsabilities using(user_respo_id) where users_responsabilities.responsability='Lecturer'")or die(mysqli_error($db));
    $counter=mysqli_num_rows($lecturer);
    echo "&nbsp;&nbsp;&nbsp;<a href='reports.php?viewallocated=pending' style='color:white;'><i class='btn btn-outline btn-yellow fa fa-print fa-2x'>  </i></a>";                                                                        
                                                                         
                                                                         
                                                                         ?>
                                                                    
     
                                                                        </center>
                                                                  </div>
                                                                  <!-- /.panel-heading -->
                                                                  <div class="panel-body">
                                                                      <div class="table-responsive">
                                                                          <table class="table">
                                                                              <thead>
                                                                                  <tr>
                                                                                      <th>Full Names</th>
                                                                                      <th>Email</th>
                                                                                      <th>Telephone</th>
                                                                                      <th>Module code</th>
                                                                                      <th>Module Name</th>
                                                                                      <th>Program</th>
                                                                                      <th>Deallocation</th>
                                                                                  </tr>
                                                                              </thead>
                                                                              <tbody>
                                                                                  
        <?php 
                                                                                  
        if($counter>0){
            while($lines=mysqli_fetch_array($lecturer)){
                echo " <tr class='info'><td>".$lines['first_name']."  ".$lines['last_name']."</td><td>".$lines['email']."</td>
                <td>".$lines['telephone']."</td><td>".$lines['module_code']."</td><td>".$lines['module_name']."</td><td>".$lines['program_code']."</td><td><a href='manage.php?dealocate=".
                $lines['user_id']."-".$lines['module_id']."-".$lines['program_id']."'title='Click to Deallocate this module to this lecturer'><i class='btn btn-outline btn-danger fa fa-trash'>  </i></a></td></tr>";
                
                
            }
            
            
        }
else{
                                                                                      
  echo"<tr><td colspan='6'><b><center>no data found in the db</center></b></td></tr>";                                                                                      
}
                                                                                
                                                                                  
                                                                                  ?>
                                                                               
                                                                               
                                                                              </tbody>
                                                                          </table>
                                                                      </div>
                                                                      <!-- /.table-responsive -->
                                                                  </div>
                                                                  <!-- /.panel-body -->
                                                              </div>
                                                              <!-- /.panel -->
                                                          </div>  </div>
                                  </p>
                                  </div>

                                            
                                        
                                        <div class="tab-pane fade" id="SchoolProgram-pills">
                                            <h4></h4>
                                            <p>
                                              <div class="col-lg-3">
                                                <div class="panel panel-primary">
                                                    <div class="panel-heading">
                                                        
                                                    <center> Add New  Program</center>
                                                    </div>
                                                    
                                                   
                                                <form role="form" method="post">
                                              <br>
                                              <div class="form-group input-group">
                                              <span class="input-group-addon"><i class="fa fa-graduation-cap"></i></span>
                                              <input type="text" class="form-control" placeholder="program name" name="program" required>

                                              </div>
                                              <div class="form-group input-group">
                                              <span class="input-group-addon"><i class="fa fa-road"></i></span>
                                              <select class="form-control" name="levels" required><option>Program levels</option>
                                                  <option>1</option>
                                                  <option>2</option>
                                                  <option>3</option>
                                                  <option>4</option></select>
                                              </div>
                                         <div class="form-group">
                                                 <input type="text" class="form-control" placeholder="program code" name="code" required>

                                              </div> 
                                            <div class="form-group">
                                                 <input type="text" class="form-control" placeholder="Required modules" name="max" required>

                                              </div>
                                             <div class="form-group">
                                                 <textarea rows='6' class="form-control" placeholder="briefly write short description about this program eg: like expected learners's output and so on" name="desc" required></textarea>

                                              </div>
                                       

                                              <center>
                                              <button type="submit" class="btn btn-outline btn-primary btn-sm " name="addprogram" required>Save</button></center>

                                              <br>
                                              </form>
                                              </div></div>
                                              <div class="col-lg-9">
                                              <div class="panel panel-primary">
                                                  <div class="panel-heading">
                                                      <center>School Program infos <?php echo "&nbsp;&nbsp;&nbsp;<a href='reports.php?viewprograminfo=pending' style='color:white;'><i class='fa fa-print fa-2x'></i></a>";?></center>
                                                  </div>
                                                  <!-- /.panel-heading -->
                                                  <div class="panel-body">
                                                      <div class="table-responsive">
                                                          <table class="table">
                                                              <thead>
                                                                  <tr class="panel panel-info">
                                                                      <th>Name</th>
                                                                      <th>Period</th>
                                                                      <th>Program description</th>
                                                                    <th>Code</th>
                                                                      <th>Mandatory Modules</th>
                                                                      <th>Manage</th>
                                                                  </tr>
                                                              </thead>
                                                              <tbody>
                                                             
                                                                      <?php                                              
                                                                  
    $dbapplicant=mysqli_query($db,"select * from programs") or die(mysqli_error($db));
                    while($res=mysqli_fetch_array($dbapplicant)){
    echo"<tr class='panel panel-info'>
                                                                      <td>".$res['program_name']."</td>
                                                                      <td>".$res['number_of_levels']."</td>
                                                                      <td>".wordwrap($res['description'],30,"<br>",true)."</td><td>".$res['program_code']."</td><td>".$res['maximum_modules']."</td>
                                                                        <td>
                                                                        <a href='manage.php?programdetails={$res['program_id']}' title='edit this'><i class='btn btn-outline btn-warning fa fa-edit'>  </i></a>
                                                                         </td>

                                                                  </tr>";                                                    
                    }
                                                                  
                                                                      
                                                                      
                                                                      ?>                                              
                                                                      
                                                                      
                                                                  
                                                                 
                                                              </tbody>
                                                          </table>
                                                      </div>
                                                      <!-- /.table-responsive -->
                                                  </div>
                                                  <!-- /.panel-body -->
                                              </div></div></p>
                                        </div>
                           <div class="tab-pane fade" id="Branches-pills">
                                            <h4></h4>
                                            <p>
                                              <div class="col-lg-3">
                                                <div class="panel panel-primary">
                                                    <div class="panel-heading">
                                                    <center> Add New  Branch</center>

                                                    </div>

                                                <form role="form" method="post">
                                              <br>
                                              <div class="form-group">

                                              <input type="text" class="form-control" placeholder="Branch Name" name="branch_name" required>

                                              </div>
                                              <div class="form-group">
                                               <input type="text" class="form-control" placeholder="Branch District Location" name="branch_district" required>
                                              </div> 
                                                    <div class="form-group">
                                               <input type="text" class="form-control" placeholder="Branch Code" name="branch_code" required>
                                              </div>
                                            <div class="form-group">
                                               <input type="text" class="form-control" placeholder="Branch Country" name="branch_country" required>
                                              </div>


                                              <center>
                                              <button type="submit" class="btn btn-outline btn-primary btn-sm " name="savebranch">Save</button></center>

                                              <br>
                                              </form>
                                              </div></div>
                                              <div class="col-lg-9">
                                              <div class="panel panel-primary">
                                                  <div class="panel-heading">
                                                     <center>University Branches
                                                      <?php  echo "&nbsp;&nbsp;&nbsp;<a href='reports.php?viewbranches=pending' style='color:white;'><i class='fa fa-print fa-2x'></i></a>"; ?>
                                                      </center> 
                                                  </div>
                                                    <div class="panel-body">
                                                      <div class="table-responsive">
                                                          <table class="table">
                                                              
                                                                  <tr>
                                                                      <thead>
                                                                      <th>Branch</th>
                                                                      <th>Code</th>
                                                                      <th>District</th>
                                                                      <th>Country</th>
                                                                    <th>Option</th>
                                                                         
                                                                      </thead>
                                                                  </tr>
   
                                                              
                                                              <tbody>
   <?php                                              
                                                                  
    $dbbranches=mysqli_query($db,"select * from branches") or die(mysqli_error($db));
               if(mysqli_num_rows($dbbranches)>0){                                                  
                    while($res=mysqli_fetch_array($dbbranches)){
    echo"<tr class='panel panel-info'>
   <td>".$res['branch_name']."</td>
  <td>".$res['branch_code']."</td>
 <td>".$res['branch_location']."
<td class='center'>".$res['branch_country']."</td>
<td class='center'>
<a href='manage.php?editbranch={$res['branch_id']}' title='edit this'><i class='btn btn-outline btn-warning fa fa-edit'>  </i></a></td></tr>";                                                    
                    }} 
                                                                  
            else
            {
              echo"<tr><td colspan='4'>no data selected</td></tr>";  
            }
                                                                      
                                                                      ?> 
                                                              </tbody>
                                                          </table>
                                                      </div>
                                                      <!-- /.table-responsive -->
                                                  </div>
                                                 
                                              </div></div></p>
                                        </div>           
                      <div class="tab-pane fade" id="Module-pills">
                                            <h4></h4>
                                           
                                              <div class="col-lg-6">
                                                <div class="panel panel-primary">
                                                    <div class="panel-heading">
                                                    <center> Add New  Module</center>
                                                        
                                                    </div>
                                                  <form role="form" method="post">
                                              <br>
                                              <div class="form-group">

                                              <input type="text" class="form-control" placeholder="Module Name" name="Module_name" required>

                                              </div>
                                              <div class="form-group">
                                               <input type="number" class="form-control" placeholder="Credits" name="credits" required>
                                              </div> 
                                                    <div class="form-group">
                                               <input type="number" class="form-control" placeholder="learning hours" name="modulehours" required>
                                              </div>
                                            <div class="form-group">
                                               <input type="text" class="form-control" placeholder="Module Code" name="Module_code" required>
                                              </div>


                                              <center>
                                              <button type="submit" class="btn btn-outline btn-primary btn-sm " name="addmodule">Save</button></center>

                                              <br>
                                              </form>
                                              </div></div>
                                              <div class="col-lg-6">
                                              <div class="panel panel-primary">
                                                    <div class="panel-heading">
                                                    <center> Assign Module To a program and a lecturer</center>
                                                        
                                                    </div>
                                                  
                                                                                               
<form role="form" method="post" action="#">
<br>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-graduation-cap"></i></span>
    <select class="form-control" name="program" id="program">
            <?php
    $qry=mysqli_query($db,"select * from programs")or die(mysqli_query($db));
    if(mysqli_num_rows($qry)>0)
    {
    while($pro=mysqli_fetch_array($qry))
    {
echo "<option value=".$pro['program_id'].">".$pro['program_name']."</option>";
        
    }}
         else{
      echo "<option>no program record found</option>";  
    }
    
    ?>
    
</select>
</div>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-road"></i></span>
<select class="form-control" name="levels" id="levels">
    <option>1</option><option>2</option><option>3</option><option>4</option></select>
</div>
<div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-book"></i></span>
<select class="form-control" name="course" id="course">
      <?php
    $mqry=mysqli_query($db,"SELECT * FROM `modules` WHERE module_id not in(select module_id from modules_programs)")or die(mysqli_query($db));
    if(mysqli_num_rows($mqry)>0)
    {
    while($mrec=mysqli_fetch_array($mqry))
    {
echo "<option value=".$mrec['module_id'].">".$mrec['module_name']."</option>";
        
    }}
    else{
      echo "<option>All module have been assigned</option>";  
    }
    
    ?>
    
    
    </select>
   </div>
 <div class="form-group input-group">
<span class="input-group-addon"><i class="fa fa-user"></i></span>
     
<select class="form-control" name="lecturers" id="lecturers">
    <option value="0"></option>
      <?php
    $Lqry=mysqli_query($db,"select * from users join users_responsabilities USING(user_respo_id) where users_responsabilities.responsability='Lecturer'")or die(mysqli_query($db));
    if(mysqli_num_rows($Lqry)>0)
    {
    while($Lrec=mysqli_fetch_array($Lqry))
    {
echo "<option value=".$Lrec['user_id'].">".$Lrec['last_name']."</option>";
        
    }}
   ?>
     </select>
</div>
<center>
 <button type="submit" name="savemodule" class="btn btn-outline btn-primary ">Record</button></center>

                                              <br>
                                                              </form>
                                              </div>
                      
                      </div>
 <div class="col-lg-12">
                                                              <div class="table-responsive">
                                                              <div class="panel panel-red">
                                                                  <div class="panel-heading">
                                                                        <center>
     <?php
   $lecturer=mysqli_query($db,"SELECT * FROM `modules` WHERE module_id not in(select module_id from modules_programs)")or die(mysqli_error($db));
    $counter=mysqli_num_rows($lecturer);
            if($counter>0){
    echo $counter."Modules added but not yet been assigned to any univeristiy program ";
    echo "&nbsp;&nbsp;&nbsp;<a href='reports.php?viewunassigned=pending' style='color:white;'><i class='fa fa-print fa-2x'></i></a>";
                                                                         
                                                                         
                                                                         ?>
                                                                    
     
                                                                        </center>
                                                                  </div>
                                                                  <!-- /.panel-heading -->
                                                                  <div class="panel-body">
                                                                      <div class="table-responsive">
                                                                          <table class="table">
                                                                              <thead>
                                                                                  <tr>
                                                                                      <th>Module Code</th>
                                                                                      <th>Module Name</th>
                                                                                      <th>Course Units</th>
                                                                                      <th>Hours</th>
                                                                                      <th>Edit </th>
                                                                                      
                                                                                  </tr>
                                                                              </thead>
                                                                              <tbody>
                                                                                  
        <?php 
                                                                                  
        
            while($lines=mysqli_fetch_array($lecturer)){
                echo " <tr class='red'><td>".$lines['module_code']."</td><td>".$lines['module_name']."</td>
            <td>".$lines['module_credits']."</td><td>".$lines['study_hours']."</td><td><a href='manage.php?editmodule=".$lines['module_id']."'title='Click to edit this module to this lecturer'><i class='btn btn-outline btn-danger fa fa-edit'>  </i></a></td></tr>";
                
                
            }
            
            
        }
        else{
            echo '<tr><td colspan=5><center>All modules have been assigned to their corresponding program</center></td><tr>';
        }
                                                                                  
                                                                                  ?>
                                                                               
                                                                               
                                                                              </tbody>
                                                                          </table>
                                                                      </div>
                                                                      <!-- /.table-responsive -->
                                                                  </div>
                                                                  <!-- /.panel-body -->
                                                              </div>
                                                              <!-- /.panel -->
                                                          </div>  </div> </div>
                      
                      
                                      
                                     
<!--
                                        <div class="tab-pane fade in active" id="applicants-pills">
                                            
                                              ss</div>
-->

 
        <!-- /#page-wrapper -->

  
<div class="row">
                <div class="modal fade" id="abcd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel"><center>Update Module</center></h4>
                                        </div>
                                        <div class="modal-body">
                                           <?php
                                            if(isset($_GET['editmodule'])){
                                                
$getmdl=mysqli_query($db,"select * from modules where module_id={$_GET['editmodule']}");
    if($getmdl){
$fetch=mysqli_fetch_array($getmdl); 
    $module_code=$fetch['module_code'];
    $module_name=$fetch['module_name'];
    $module_credits=$fetch['module_credits'];
    $study_hours=$fetch['study_hours'];
    $module_id=$fetch['module_id'];

    }
                                                
   }
                                            
                                            ?>
<form role="form" method="get" action="manage.php">
                                              <br>
     <input type="text"  placeholder="program name" name="module_id" value="<?php echo $module_id ?>" hidden>
    <div class="form-group">
    <label>Module identification no:</label>
    <input type="text"  class="form-control" placeholder="program name" name="mdl" value="<?php echo $module_id ?>" disabled>
    </div><div class="form-group">
    <label>Module Name:</label>
    <input type="text"  class="form-control" placeholder="program name" name="mdl" value="<?php echo $module_name ?>" >
    </div>
                                                <div class="form-group">
    <label>Module Code:</label>
    <input type="text"  class="form-control" placeholder="program name" name="code" value="<?php echo $module_code ?>">
                                                        </div>
    
                                              
    <div class="form-group">
        <label>Course units:</label>
<input type="text" class="form-control" placeholder="program name" name="credits" value="<?php echo $module_credits ?>"required></div> 
    <div class="form-group">
        <label>learning hours</label>
<input type="text" class="form-control" placeholder="program name" name="hours" value="<?php echo $study_hours ?>" required></div>
<br>
                                             
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-default" name="back">Close</button>
                                            <button type="submit" class="btn btn-primary" name="updatemodule">Save changes</button>
                                        </div> </form>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div> 
    <div class="modal fade" id="abcde" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel"><center>Update Branch infos</center></h4>
                                        </div>
                                        <div class="modal-body">
                                           <?php
                                            if(isset($_GET['editbranch'])){
                                                
$getmdl=mysqli_query($db,"select * from branches where 	branch_id={$_GET['editbranch']}");
    if($getmdl){
$fetch=mysqli_fetch_array($getmdl); 
    $branch_id=$fetch['branch_id'];
    $branch_name=$fetch['branch_name'];
    $branch_code=$fetch['branch_code'];
    $branch_location=$fetch['branch_location'];
    $branch_country=$fetch['branch_country'];
    
    }
                                                
   }
                                            
                                            ?>
<form role="form" method="get" action="#">
                                              <br>
     <input type="text"  placeholder="program name" name="branch_id" value="<?php echo $branch_id ?>" hidden>
    <div class="form-group">
    <label>Branch Identification No:</label>
    <input type="text"  class="form-control" placeholder="program name" name="branch_id" value="<?php echo $branch_id ?>" disabled>
    </div>
    <div class="form-group">
    <label>Branch name:</label>
    <input type="text"  class="form-control" placeholder="program name" name="branch_name" value="<?php echo $branch_name ?>" >
    </div>
    <div class="form-group">
    <label>Branch Code:</label>
    <input type="text"  class="form-control" placeholder="program name" name="branch_code" value="<?php echo $branch_code ?>" >
    </div>
                                                <div class="form-group">
    <label>Branch Location:</label>
    <input type="text"  class="form-control" placeholder="program name" name="branch_location" value="<?php echo $branch_location ?>">
                                                        </div>
    
                                              
    <div class="form-group">
        <label>Branch Country</label>
<input type="text" class="form-control" placeholder="program name" name="branch_country" value="<?php echo $branch_country ?>"required></div> 

<br>
                                             
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" name="back" class="btn btn-default" >Close</button>
                                            <button type="submit" class="btn btn-primary" name="updatebranch">Save changes</button>
                                        </div> </form>
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
                                            <h4 class="modal-title" id="myModalLabel">Existing Program details</h4>
                                        </div>
                                        <div class="modal-body">

                                          <div class="panel-body">
                                              <?php
     if(isset($_GET['programdetails']))
                            {                         
                                 
$vars=mysqli_query($db,"select * from programs where program_id={$_GET['programdetails']}");
                                 
  if($vars){
      $retr=mysqli_fetch_array($vars);
      $program_name=$retr['program_name'];
      $number_of_levels=$retr['number_of_levels']; 
      $description=$retr['description'];
      $program_code=$retr['program_code'];
      $program_id=$retr['program_id'];
      $maximum_modules=$retr['maximum_modules'];
  }}?>
<form role="form" method="get" action="#">
                                              <br>
     <input type="text"  placeholder="program name" name="program_id" value="<?php echo $program_id ?>" hidden>
                                                <div class="form-group input-group">
    <span class="input-group-addon"><i class="fa fa-key"></i></span>
    <input type="text"  class="form-control" placeholder="program name" value="<?php echo $program_id ?>" disabled>
                                                        </div>
                                              <div class="form-group input-group">
                                              <span class="input-group-addon"><i class="fa fa-graduation-cap"></i></span>
                                              <input type="text" class="form-control" placeholder="program name" name="program" value="<?php echo $program_name ?>"required>

                                              </div> 
                                            
                                              <div class="form-group ">
                                                  <label>Learning Period</label>
                                                <select class="form-control" name="levels" required>
                                                  <option value="<?php echo $number_of_levels ?>"><?php echo $number_of_levels ?></option> 
                                                  <option value="1">1</option>
                                                  <option value="2">2</option>
                                                  <option value="3">3</option>
                                                  <option value="4">4</option>
                                                  </select>
                                              </div>
                                         <div class="form-group">
                                             <label>Program code:</label>
                                                 <input type="text" class="form-control" placeholder="program code" name="code" required value="<?php echo $program_code ?>">

                                              </div>
                                        <div class="form-group">
                                            <label>Number of modules:</label>
                                                 <input type="text" class="form-control" placeholder="program code" name="modules" required value="<?php echo $maximum_modules ?>">

                                              </div>
                                             <div class="form-group">
                                                 <textarea rows="6" class="form-control" placeholder="new program descriptions" name="desc"></textarea>

                                              </div>
                                       

                                              <center>
                                              <input type="submit" class="btn btn-outline btn-primary btn-sm" name="updatethis">|<input type="submit" class="btn btn-outline btn-primary btn-sm" name="back" value="Back"></center>

                                              <br>
                                              </form>
                                            
                                          </div>
                                                                        </div>

                                        
                                    </div>
                                </div>
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
                                              <button type="submit" class="btn btn-outline btn-info btn-sm " name="change" required>Save update</button>|
                                                    <button type="submit" class="btn btn-outline btn-primary btn-sm " name="cancel" required>Back</button>
                                                    
                                                    
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
</div>


	<script type="text/javascript" src="jquery.min.js"></script>
<script type="text/javascript" src="js.js"></script>
<?php include("footer.php");?>
