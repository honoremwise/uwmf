<?php
/**
 *This class deals with uploading files for existing students who did not apply using the system
 */
class Files extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->helper('file');
    $this->load->library('form_validation');
    $this->load->model('Certificate_saveFiles');
    $this->load->model('SelectPrograms');
    $this->load->model('TempModels');
    $this->load->model('Student');
  }
  public function index()
  {
    if (!isset($_SESSION['username'])){
      $data=array('session' => 'You are logged out');
      $this->load->view('index.php',$data);
    }else {
      $data=array('session' => 'You are logged out');
      $this->load->view('index.php',$data);
    }
  }//end of function
  //function definition
  public function saveid() //upload id/passport
  {
    if (count($_FILES)==1){
      foreach ($_FILES as $key => $value) {
        $fileuse=$key;
      }
      $config['upload_path'] ='./profiles/';
      $config['allowed_types']='pdf|png|gif|jpeg|jpg';
      $config['max_size']      =500;
      $file=$_FILES[$fileuse]['name'];
      //$this->load->library('upload', $config);
      $this->form_validation->set_rules($fileuse, '', 'callback_checkfile');
      if ($this->form_validation->run()==TRUE && $_FILES[$fileuse]['size']<=300000){
        $reference=$this->Certificate_saveFiles->retrieveReference(); //getting current student reference
        if ($reference!=false) { //correct reference number
          $type= pathinfo($_FILES[$fileuse]['name'], PATHINFO_EXTENSION);
          $config["file_name"] = $file= $reference.$fileuse.".".$type;
          //$file= $reference."_".$fileuse;
          $file= $reference.$fileuse.".".$type;
          $this->load->library('upload', $config);
          $checkExisting=$config['upload_path'].$file;
          $path=$config['upload_path'];
          if (file_exists($checkExisting)){
            //delete the file
            unlink($checkExisting);
            //check if there is file in database with different extension
            $this->deleteExisting($file,$reference,$path);
            //upload the required file
            $save = $this->upload->do_upload($fileuse);
            //call to function to update database table
            $this->savefile($save,$file);
          }else{
            //check if there is file in database with different extension
            $this->deleteExisting($file,$reference,$path);
            //upload the required file
            $save = $this->upload->do_upload($fileuse);
            //call to function to update database table
            $this->savefile($save,$file);
          }
        }else {//error of getting reference
  				$data=array(
  					'error'=>'Invalid upload, try again and upload a file of less than 3Mb',
  				);
  				$this->load->view('user/index.php', $data);
        }
      } else {
        $data=array(
          'error'=>'Invalid upload, try again and upload a file of less than 3Mb',
        );
        $this->load->view('user/index.php',$data);
      }
    } else {
      $data=array(
        'error'=>'Invalid upload, try again',
      );
      $this->load->view('user/index.php',$data);
    }
  }//end of function
  //function to validate file
  public function checkfile(){
    if (count($_FILES)==1) {
      foreach ($_FILES as $key=>$value) {
        $name=$key;
      }
      $allowed_mime_type_arr= array('application/pdf','image/jpg','image/png','image/gif','image/jpeg');
      //get all files required to be uploaded
      if (isset($_FILES[$name]['name']) && $_FILES[$fileuse]['size']<300000){
        $mime=get_mime_by_extension($_FILES[$name]['name']);
        if (isset($_FILES[$name]['name']) && $_FILES[$name]['name']!="") {
          if (in_array($mime,$allowed_mime_type_arr)) {
            return true;
          }else {
            $this->form_validation->set_message('checkfile', 'Please select only  file of type pdf');
            return false;
          }
        } else {
          $this->form_validation->set_message('checkfile','upload required file');
          return false;
        }
      } else {
        $this->form_validation->set_message('checkfile', 'Please choose a file to upload.');
        return false;
      }
    } else {
      $data=array(
        'error'=>'Upload error occured, try again',
      );
      $this->load->view('user/index.php', $data);
    }
  }//end of function
  function savefile($save,$file)
  {
    if ($save==FALSE) {
      $error = array('error' => $this->upload->display_errors());
      //redirect to uploads page display and correct errors
      $this->load->view('user/index.php',$error);
    }else
      if (strpos($file,"photo")) {
        $field="photo";
        //update the current field to empty
        $changefield=$this->Student->changefield($field);
        //save the file name in database
        $save=$this->Student->profilepicture($file,$field);
        if ($save!=false){
          $data=array(
            'success'=>'File successfuly uploaded',
          );
          $this->load->view('user/index.php',$data);
        }else{
          $data=array(
            'error'=>'File upload error, try again',
          );
          $this->load->view('user/index.php', $data);
        }//end of inner if
      }
      if (strpos($file,"identity")) {
        $field='scanned_id';
        //update the current field to empty
        $changefield=$this->Student->changefield($field);
        //save the file name in database
        $save=$this->Student->profilepicture($file,$field);
        if ($save!=false){
          $data=array(
            'success'=>'File successfuly uploaded',
          );
          $this->load->view('user/index.php',$data);
        }else{
          $data=array(
            'error'=>'File upload error, try again',
          );
          $this->load->view('user/index.php', $data);
        }
      } if (strpos($file,"candidatediploma")) {
        $field='degree_copy';
        //update the current field to empty
        $changefield=$this->Student->changefield($field);
        //save the file name in database
        $save=$this->Student->profilepicture($file,$field);
        if ($save!=false){
          $data=array(
            'success'=>'File successfuly uploaded',
          );
          $this->load->view('user/index.php',$data);
        }else{
          $data=array(
            'error'=>'File upload error, try again',
          );
          $this->load->view('user/index.php', $data);
        }
      }if (strpos($file,"candidateRecomm")) {
        $field='recomm_letter';
        //update the current field to empty
        $changefield=$this->Student->changefield($field);
        //save the file name in database
        $save=$this->Student->profilepicture($file,$field);
        if ($save!=false){
          $data=array(
            'success'=>'File successfuly uploaded',
          );
          $this->load->view('user/index.php',$data);
        }else{
          $data=array(
            'error'=>'File upload error, try again',
          );
          $this->load->view('user/index.php', $data);
        }
      }if (strpos($file,"candidatereport")) {
        $field="transcript";
        //update the current field to empty
        $changefield=$this->Student->changefield($field);
        //save the file name in database
        $save=$this->Student->profilepicture($file,$field);
        if ($save!=false){
          $data=array(
            'success'=>'File successfuly uploaded',
          );
          $this->load->view('user/index.php',$data);
        }else{
          $data=array(
            'error'=>'File upload error, try again',
          );
          $this->load->view('user/index.php', $data);
        }
      }if (strpos($file,"candidatestatement")){
        $field="statement_faith";
        //update the current field to empty
        $changefield=$this->Student->changefield($field);
        //save the file name in database
        $save=$this->Student->profilepicture($file,$field);
        if ($save!=false){
          $data=array(
            'success'=>'File successfuly uploaded',
          );
          $this->load->view('user/index.php',$data);
        }else{
          $data=array(
            'error'=>'File upload error, try again',
          );
          $this->load->view('user/index.php', $data);
        }
      }if (strpos($file,"candidatemotivation")) {
        $field="motivation_letter";
        //update the current field to empty
        $changefield=$this->Student->changefield($field);
        //save the file name in database
        $save=$this->Student->profilepicture($file,$field);
        if ($save!=false){
          $data=array(
            'success'=>'File successfuly uploaded',
          );
          $this->load->view('user/index.php',$data);
        }else{
          $data=array(
            'error'=>'File upload error, try again',
          );
          $this->load->view('user/index.php', $data);
        }
      }if (strpos($file,"candidateBirth")){
        $field="birth_certificate";
        //update the current field to empty
        $changefield=$this->Student->changefield($field);
        //save the file name in database
        $save=$this->Student->profilepicture($file,$field);
        if ($save!=false){
          $data=array(
            'success'=>'File successfuly uploaded',
          );
          $this->load->view('user/index.php',$data);
        }else{
          $data=array(
            'error'=>'File upload error, try again',
          );
          $this->load->view('user/index.php', $data);
        }
      }
    }//end of function
    function removefile($file)
    {
      if (strpos($file,"photo")) {
        $field='photo';
        //update the current field to empty
        $changefield=$this->Student->changefield($field);
        //go back to index
        $this->load->view('user/index.php');
      }
      if (strpos($file,"identity")) {
        $field='scanned_id';
        //update the current field to empty
        $changefield=$this->Student->changefield($field);
        //go back to index
        $this->load->view('user/index.php');
      } if (strpos($file,"candidatediploma")) {
        $field='degree_copy';
        //update the current field to empty
        $changefield=$this->Student->changefield($field);
        //go back to index
        $this->load->view('user/index.php');
      }if (strpos($file,"candidateRecomm")) {
        $field='recomm_letter';
        //update the current field to empty
        $changefield=$this->Student->changefield($field);
        //go back to index
        $this->load->view('user/index.php');
      }if (strpos($file,"candidatereport")) {
        $field="transcript";
        //update the current field to empty
        $changefield=$this->Student->changefield($field);
        //go back to index
        $this->load->view('user/index.php');
      }if (strpos($file,"candidatestatement")){
        $field="statement_faith";
        //update the current field to empty
        $changefield=$this->Student->changefield($field);
        //go back to index
        $this->load->view('user/index.php');
      }if (strpos($file,"candidatemotivation")) {
        $field="motivation_letter";
        //update the current field to empty
        $changefield=$this->Student->changefield($field);
        //go back to index
        $this->load->view('user/index.php');
      }if (strpos($file,"candidateBirth")){
        $field="birth_certificate";
        //update the current field to empty
        $changefield=$this->Student->changefield($field);
        //go back to index
        $this->load->view('user/index.php');
      }else {
        $this->load->view('user/index.php');
      }
    }//end of function
    function deleteExisting($file,$reference,$path)
    {
      if (strpos($file,"photo")) {
        $field='photo';
        //get current file
        $file=$this->Student->deleteExisting($field,$reference);
        $unlink=$path.$file;
        unlink($unlink);
      }
      if (strpos($file,"identity")) {
        $field='scanned_id';
        //get the current file
        $file=$this->Student->deleteExisting($field,$reference);
        $unlink=$path.$file;
        unlink($unlink);
      } if (strpos($file,"candidatediploma")) {
        $field='degree_copy';
        //get the current file
        $file=$this->Student->deleteExisting($field,$reference);
        $unlink=$path.$file;
        unlink($unlink);
      }if (strpos($file,"candidateRecomm")) {
        $field='recomm_letter';
        //get the current file
        $file=$this->Student->deleteExisting($field,$reference);
        $unlink=$path.$file;
        unlink($unlink);
      }if (strpos($file,"candidatereport")) {
        $field="transcript";
        //get the current file
        $file=$this->Student->deleteExisting($field,$reference);
        $unlink=$path.$file;
        unlink($unlink);
      }if (strpos($file,"candidatestatement")){
        $field="statement_faith";
        //get the current file
        $file=$this->Student->deleteExisting($field,$reference);
        $unlink=$path.$file;
        unlink($unlink);
      }if (strpos($file,"candidatemotivation")) {
        $field="motivation_letter";
        //get the current file
        $file=$this->Student->deleteExisting($field,$reference);
        $unlink=$path.$file;
        unlink($unlink);
      }if (strpos($file,"candidateBirth")){
        $field="birth_certificate";
        //get the current file
        $file=$this->Student->deleteExisting($field,$reference);
        $unlink=$path.$file;
        unlink($unlink);
      }
    }//end of function
  }
?>
