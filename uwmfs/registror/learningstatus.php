<?php
include'../access.php';
include("../dboperations.php");
include("header.php");
$user=$_SESSION["username"];
$date=date('Y-m-d');
$dv=substr($date,0,4);
?> <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Transcript Generation Panel</h1>
                </div>
                <div class="row">
              <div class="panel-body">
                  <div class="panel-group" id="accordion">
        <div class="row">
<div class="col-lg-3">
    <form role="form" method="post" action="reports.php"> 
<div class="form-group input-group">
 <span class="input-group-addon"><button type="submit" name="find" class="fa fa-search"></button></span>
<select class="form-control" name="reason" required>

<option>learning Status</option> 
   

    </select></div>
                          </div>
                      <div class="col-lg-2">
                      
                          <div class="form-group">
                          
                                              <input type="text" class="form-control" placeholder="student Reg no" name="student" required>

                                              </div>
    </form>
    </div> 
            
                     </form></div>
            </div>
            <!-- /.row -->
            <div class="row">
              <div class="panel-body">
                  <div class="panel-group" id="accordion">
                       
                     
                      <div class="panel panel-primary">
                        <div id="collapseOne" class="panel-collapse collapse in">
                              <div class="panel-body">
                                                          <!-- Nav tabs -->
                                    <ul class="nav nav-tabs">
                                      <li class="active"><a href="#all-pills" data-toggle="tab">Students Transcripts</a>
                                      </li>                                   
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div class="tab-pane fade" id="Masters-pills">
                                        
                                        <h4></h4>
                                            <p>  <div class="col-lg-12">
                                                                                        <div class="panel panel-primary">
                                                                                        <div class="panel-heading"><center>
                
                                                                                        Student Transcripts</center>
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
    <tbody>
        <?php
 $result=mysqli_query($db,"SELECT * FROM `marks` join modules using(module_id) join grades USING (grade)");
                                                                  
while($userd=mysqli_fetch_array($result)){
  echo "<tr>
<td>".$userd['registration_no']."</td>
 <td>".strtoupper($userd['module_code'])."</td>
 <td>".$userd['module_name']."</td>
 <td>".$userd['points']."</td>
 <td>".strtoupper($userd['letter'])."</td>
 <td>".$userd['addition_date']."</td>
 
                                                                      
                                                                  </tr>";   }                                                               ?>
 

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
<th>Telephone</th>
<th>Email</th>
<th>Program</th>
<th>Branch</th>
<th>Details</th>
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
                                                             
                                      
                                                      <!-- /.panel-heading -->
                                                      <div class="panel-body">
                                                          <table width="100%" class="table table-striped table-bordered table-hover">
 <table><tr><td><img src="http://localhost/real/css_scripts/vendor/datatables/images/test.png" width="100" height="80" class="img-circle"></td><td width="20%"></td><td><center><b>UNIVERSITY OF WORLD MISSION FRONTIERS<br>
            Graduate School Of THE THEOGOLOGY</b><br>
            P.O.BOX 5856 KIGALI-RWANDA TEL:(+250)788554109/(+250)781403982<br>
           <b> WEBSITE:hismission.org E-mail:missionfrontiers@yahoo.com
            
           </b></center></td></tr></table><br>   
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
$dbapplicant=mysqli_query($db,"select * from candidates join students USING(reference_no) where substr(candidates.year_registered,1,4)<$dv") or die(mysqli_error($db));
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
    
    
    
    
    
    
$applicants=mysqli_query($db,"select * from candidates where candidate_id={$_GET['viewmore']}");

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
    <option>Suspension</option>
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
                                                    <a href="application.php" class="btn btn-outline btn-primary btn-sm " name="cancel" required>Back</a>
                                                    
                                                    
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
