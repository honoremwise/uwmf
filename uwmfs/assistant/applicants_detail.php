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
                                                 
        <table><tr><td><img src="http://localhost/real/css_scripts/vendor/datatables/images/test.png" width="100" height="80" class="img-circle"></td><td width="20%"></td><td><center><b>UNIVERSITY OF WORLD MISSION FRONTIERS<br>
            Graduate School Of THE THEOGOLOGY</b><br>
            P.O.BOX 5856 KIGALI-RWANDA TEL:(+250)788554109/(+250)781403982<br>
           <b> WEBSITE:hismission.org E-mail:missionfrontiers@yahoo.com
            
           </b></center></td></tr></table><br>
                                                       
  <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title" id="myModalLabel"><center><?php
                                    if(isset($_GET['viewmore']))
                            {
                             echo  "Applicant Details";
                            }                        
                        
                                    
                                    ?>                                   
                                    </center></h4>
                            </div>
                            <div class="modal-body">
                                
                              <?php
                               
                                $msg="";$msgf1="";$msgf2="";$engwritten="";$engoral="";$msgf3="";$msgf4="";$id="";
if(isset($_GET['viewmore']))
{   
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
        $msgf1='<a href=\real/"../../../../../real/profiles/'.$recs["birth_certificate"].'>View File<a/>';
    }

if($recs["motivation_letter"]=="")
{
   $msgf2="<K style='color:red;'>Applicant did not Upload Motivation Letter</K>";  
}
    else
    {
     $msgf2='<a href=\real/"../../../../../real/profiles/'.$recs["motivation_letter"].'>View File<a/>';   
    }
if($recs['english_interview_test']==""){
    $engoral="<K style='color:red;'>No marks available</K>"; 
} 
else{
$engoral="<K style='color:red;'>".$recs['english_interview_test']."</K>"; 
}
if($recs['english_reading_test']==""){
    $engwritten="<K style='color:red;'>No marks available</K>"; 
} 
    else{
        $engwritten="<K style='color:red;'>".$recs['english_reading_test']."</K>"; 
    }
   
echo '<div class="table-responsive">
                                                              <div class="panel panel-info">
                                                                  <div class="panel-heading">
                                                       ('.$recs['first_name'].'  '.$recs['last_name'].')   Application details
                                                                  </div>
                                                                  
                                                                  <div class="panel-body">
                                                                      <div class="table-responsive">
                                                                          <table class="table" border=1 widht=100%>
                                                                              <tbody>
 <tr class=default><td colspan=2>';
 
 echo'</td>
       <td><u>English test Result:</u>
       <br>
       Interview:'.$engoral.'<br>
       Written:'.$engwritten.'
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
<tr class=info><td colspan=2><center>Recommendation  letter file :
<a href=\real"../../../../../real/profiles/'.$recs["recomm_letter"].'>View File <a/></center></td>
<td colspan=1><center>Motivation Letter file  '.$msgf2.'<center></td>
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
                                <?php 
                                if(isset($_GET['viewmore']))
{ 
                                echo "<a href='students.php?approve={$recs['reference_no']}' title='Approve this candidate'><i class='btn btn-outline btn-info fa fa-check'>  </i></a>
                                |<a href='index.php?reject={$recs['reference_no']}' title='Reject this candidate'><i class='btn btn-outline btn-danger fa fa-trash'> </i></a>| <button type='button' onclick='PrintDiv();' class='btn btn-outline btn-info fa fa-print'></button>|
                                <a href='index.php' title='Approve this candidate' class='btn btn-outline btn-info'>back</a>";
                                }?>
                               
                                                          </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>                                                      
                                                       
    
<?php    
                                                       
                                                       
                                                                                                              
$userdetails=mysqli_query($db,"select * from users join users_responsabilities using(user_respo_id) where users.email='$user'");
$recs=mysqli_fetch_array($userdetails);
$user=$recs['responsability'];
                                            
                                            
echo "<center><br><br><br><br><br><br>Done on    ".date('Y-M-d-(D)')."   By The ".$user;?> 
                                            </center>
</div>
    </div></div> </p>
</div>
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
