<?php
/**
 * add students marks
 */
class Addmarks extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
		$this->load->helper('url');
		$this->load->library('form_validation');
    $this->load->model('SelectModels');
    $this->load->model('TempModels');
    $this->load->model('SelectPrograms');
  }
  public function index()
  {
    $this->load->view('tempuser/home.php');
  }
  public function studentMarks()
  {
    // validate form for input
    $this->form_validation->set_rules('candidatenumberid','Student number','trim|required');
    $this->form_validation->set_rules('moduleidcode','Module Code'.'trim|required');
    $this->form_validation->set_rules('marksdataid','Marks','trim|required|is_natural|min_length[2]|max_length[3]');
    $this->form_validation->set_rules('marksdatetime','Marks submited date','trim|required');
    if ($this->form_validation->run()!=FALSE) {
      $studentnumber=$this->input->post('candidatenumberid');
      $modulecode=$this->input->post('moduleidcode');
      $marks=$this->input->post('marksdataid');
      $marksgetdate=$this->input->post('marksdatetime');
      //check if student number already in database
      $data=array(
        'registration_no'=>$studentnumber,
        'points'=>$marks,
        'user'=>$_SESSION['validuser'],
        'date'=>$marksgetdate,
    );
      $check=$this->TempModels->checkuser($data);
      if ($check!=FALSE) {
        // insert marks
        $data=array('registration_no'=>$studentnumber,
        'points'=>$marks,
        'addition_date'=>$marksgetdate,
        'module_id'=>$modulecode,
        'user_id'=>$check[0],
        'grade'=>$check[1],
      );
      $insert=$this->TempModels->addMarks($data);
      if ($insert==false) {
        $data=array(
  				'groups'=>$this->SelectPrograms->university_programs(),
  				'branches'=>$this->SelectPrograms->university_branches(),
  				'modules'=>$this->SelectPrograms->university_modules(),
  				'students'=>$this->SelectPrograms->university_students(),
  				'recorderror'=>'Unable to save marks try again');
  			  $this->load->view('tempuser/index.php',$data);
      }else {
        $data=array(
  				'groups'=>$this->SelectPrograms->university_programs(),
  				'branches'=>$this->SelectPrograms->university_branches(),
  				'modules'=>$this->SelectPrograms->university_modules(),
  				'students'=>$this->SelectPrograms->university_students(),
  				'success'=>'Marks saved');
  			  $this->load->view('tempuser/index.php',$data);
      }
    }else {
        //go back to index
        $data=array(
  				'groups'=>$this->SelectPrograms->university_programs(),
  				'branches'=>$this->SelectPrograms->university_branches(),
  				'modules'=>$this->SelectPrograms->university_modules(),
  				'students'=>$this->SelectPrograms->university_students(),
  				'recorderror'=>'Invalid data');
  			  $this->load->view('tempuser/index.php',$data);
      }
   }else {
     $data=array(
       'groups'=>$this->SelectPrograms->university_programs(),
       'branches'=>$this->SelectPrograms->university_branches(),
       'modules'=>$this->SelectPrograms->university_modules(),
       'students'=>$this->SelectPrograms->university_students(),
     );
       $this->load->view('tempuser/index.php',$data);
    }
  }//end of function
  public function editmarks()
  {
    if (isset($_SESSION['validuser'])) {
      $this->form_validation->set_rules('candidatenumberid','Student number','trim|required');
      $this->form_validation->set_rules('moduleidcode','Module Code'.'trim|required');
      $this->form_validation->set_rules('marksdataid','Marks','trim|required|is_natural|min_length[2]|max_length[3]');
      $this->form_validation->set_rules('marksdatetime','Marks submited date','trim|required');
      if ($this->form_validation->run()!=FALSE) {
        //check if student has marks in the submitted module
        $data=array(
        'registration_no'=>$this->input->post('candidatenumberid'),
        'module_id'=>$this->input->post('moduleidcode'),
        'marks'=>$this->input->post('marksdataid'),
        'date'=>$this->input->post('marksdatetime'),
        );
        $check=$this->TempModels->checkMarks($data);//check and update marks
        if ($check!=FALSE) {
          $data=array(
    				'groups'=>$this->SelectPrograms->university_programs(),
    				'branches'=>$this->SelectPrograms->university_branches(),
    				'modules'=>$this->SelectPrograms->university_modules(),
    				'students'=>$this->SelectPrograms->university_students(),
    				'success'=>'Marks updated');
    			  $this->load->view('tempuser/index.php',$data);
        } else {
          $data=array(
    				'groups'=>$this->SelectPrograms->university_programs(),
    				'branches'=>$this->SelectPrograms->university_branches(),
    				'modules'=>$this->SelectPrograms->university_modules(),
    				'students'=>$this->SelectPrograms->university_students(),
    				'recorderror'=>'Data do not match previous record to update');
            unset($_SESSION['username']);
    			  $this->load->view('tempuser/index.php',$data);
        }
      }else {
        $data=array(
  				'groups'=>$this->SelectPrograms->university_programs(),
  				'branches'=>$this->SelectPrograms->university_branches(),
  				'modules'=>$this->SelectPrograms->university_modules(),
  				'students'=>$this->SelectPrograms->university_students(),
        );
  			  $this->load->view('tempuser/index.php',$data);
      }
    }else {
      $this->load->view('tempuser/home.php');
    }
  }//end of function
}
 ?>
