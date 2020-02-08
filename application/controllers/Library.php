<?php
/**
 * Library management system controller
 */
class Library extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
		$this->load->helper('url');
    $this->load->library('form_validation');
    $this->load->Model('LibModel');
  }
  public function index()
  {
    $validuser=$_SESSION['userlogin'];
    if (isset($validuser)){
      $data = array('lostbooks' => $this->LibModel->getLostBooks(),
      'currentstore'=>$this->LibModel->getBookstore(),
      'borrowedbooks'=>$this->LibModel->getBorrowed(),
      'charges'=>$this->LibModel->getChargesBook(),
    );
      $this->load->view('library/pages/home',$data);
    } else {
      $this->load->view('library/index.php');
    }
  }
  public function categorylist()
  {
    $data = array('categories' =>$this->LibModel->categories(),);
    $this->load->view('library/pages/categories.php',$data);
  }
  public function viewCategories()
  {
    $data = array('categories' =>$this->LibModel->getcategories(),);
    $this->load->view('library/pages/categories.php',$data);
  }
  public function editcategory()
  {
    if(isset($_POST['btninfoedit'])){
      $category=$this->input->post('bookcode');
      $data = array('categoryname' =>$category,
      'categoryid'=>$category,
      'categories' =>$this->LibModel->categories(),
    );
      $this->load->view('library/pages/categories.php',$data);
    } else{
      $data = array('categories' =>$this->LibModel->categories(),);
      $this->load->view('library/pages/categories.php',$data);
    }
  }
  public function searchedit()
  {
    $bookcode=$this->input->post('searchname');
    $this->form_validation->set_rules('searchname','','required|trim');
    if ($this->form_validation->run()==true){
      $record=$this->LibModel->getsearchid($bookcode);
      if(count($record)>0){
        // go the the page to view edit button
        $data = array('viewbooks' =>$record);
        $this->load->view('library/pages/booklist.php',$data);
      } else {
        echo "no match";
      }
    } else {
      $this->getvalidationdata();
    }

  }
  public function editcategorydata()
  {
    //get the submitted data
    $catecode=$this->input->post('libbookcode');
    $catename=$this->input->post('libcatename');
    //do validation check
    $this->form_validation->set_rules('libbookcode','Category code','required|trim');
    $this->form_validation->set_rules('libcatename','Category name','required|trim');
    if ($this->form_validation->run()==true){
      $data = array('categ_code'=>$catecode,
      'categ_name'=>$catename
    );
    $table="book_categories";
    $where = array('categ_code' =>$catecode,);
    $update=$this->LibModel->doUpdate($table,$data,$where);
    if ($update==true){
      $this->getsuccessData();
    }else {
      $this->geterrorData();
    }
    } else {
      $this->getvalidationdata();
    }

  }
  function validatebook()
  {
    $this->form_validation->set_rules('libcatenameid','','required|trim');
    $this->form_validation->set_rules('libookname','','required|trim');
    $this->form_validation->set_rules('bookwriterid','','required|trim');
    $this->form_validation->set_rules('bookversionid','','required|trim|is_natural');
    $this->form_validation->set_rules('bookprice','','required|trim');
    $this->form_validation->set_rules('pricecurrencytype','','required|trim');
    $this->form_validation->set_rules('bookpublication','','required|trim');
    $this->form_validation->set_rules('newbookid','','required');
    if ($this->form_validation->run()==true){
      return true;
    } else {
      return false;
    }
  }//end of function
  public function editBook()
  {
    $validateedit=$this->validatebook();
    if ($validateedit==true){
      //edit book in database
      $table="books";
      $data = array(
      'categ_code' =>$this->input->post('libcatenameid'),
      'book_title'=>$this->input->post('libookname'),
      'book_author'=>$this->input->post('bookwriterid'),
      'book_version'=>$this->input->post('bookversionid'),
      'book_price'=>$this->input->post('bookprice'),
      'currency_type'=>$this->input->post('pricecurrencytype'),
      'publication_name'=>$this->input->post('bookpublication'),
     );
     $where = array('book_code'=>$this->input->post('newbookid'));
     $edit=$this->LibModel->doUpdate($table,$data,$where);
     if ($edit==true){
       $this->getsuccessData();
     }else {
       $this->geterrorData();
     }
    } else{
      $this->getvalidationdata();
    }
  }//end of function
  public function addBook()
  {
    if (isset($_SESSION['userlogin'])){
      // validate user inputs
      $this->form_validation->set_rules('libcatenameid','','required|trim');
      $this->form_validation->set_rules('libookname','','required|trim');
      $this->form_validation->set_rules('bookwriterid','','required|trim');
      $this->form_validation->set_rules('bookversionid','','required|trim');
      $this->form_validation->set_rules('bookprice','','required|trim');
      $this->form_validation->set_rules('pricecurrencytype','','required|trim');
      $this->form_validation->set_rules('bookpublication','','required|trim');
      $this->form_validation->set_rules('newbookid','','required');
      $validate=$this->validatebook();
      if ($validate==true){
        // save new book in database
        $table="books";
        $data = array(
        'categ_code' =>$this->input->post('libcatenameid'),
        'book_title'=>$this->input->post('libookname'),
        'book_author'=>$this->input->post('bookwriterid'),
        'book_version'=>$this->input->post('bookversionid'),
        'book_price'=>$this->input->post('bookprice'),
        'currency_type'=>$this->input->post('pricecurrencytype'),
        'book_code'=>$this->input->post('newbookid'),
        'publication_name'=>$this->input->post('bookpublication'),
       );
       //insert data in database
       $save=$this->LibModel->insertData($table,$data);
       if ($save==true){
         $this->getsuccessData();
       } else {
         $this->geterrorData();
       }
      } else {
        //load data and redirect
        $this->getvalidationdata();
      }
    } else{
      $this->load->view('library/index.php');
    }
  }//end of function
  public function addCategory()
  {
    if (isset($_SESSION['userlogin'])){
      //get the submitted data
      $catecode=$this->input->post('libbookcode');
      $catename=$this->input->post('libcatename');
      //do validation check
      $this->form_validation->set_rules('libbookcode','Category code','required|trim');
      $this->form_validation->set_rules('libcatename','Category name','required|trim');
      if ($this->form_validation->run()==true){
        // save data in databas
        $data = array('categ_code'=>$catecode,
        'categ_name'=>$catename
      );
      $table="book_categories";
      $save=$this->LibModel->insertData($table,$data);
      if ($save==true){
        //load data and redirect
        $this->getsuccessData();
      } else{
        //load data and redirect
        $this->geterrorData();
      }
      }else{
        //load data and redirect
        $this->getvalidationdata();
      }
    } else {
      $this->load->view('library/index.php');
    }
  }
  public function userLogin()
  {
    if(isset($_SESSION['userlogin'])){
      $data = array('lostbooks' => $this->LibModel->getLostBooks(),
      'currentstore'=>$this->LibModel->getBookstore(),
      'borrowedbooks'=>$this->LibModel->getBorrowed(),
      'charges'=>$this->LibModel->getChargesBook(),
    );
      $this->load->view('library/pages/home',$data);
    } else {
      // handle requests of user login
      $this->form_validation->set_rules('Useridname','Username','trim|required|valid_email');
      $this->form_validation->set_rules('useridPassword','Password','trim|required');
      if ($this->form_validation->run()==true){
        //get input data
        $username=$this->input->post('Useridname');
        $password=$this->input->post('useridPassword');
        //check if a user with the username and password exists
        $data = array('email' =>$username,
        'password'=>$password,
        'status'=>'Active',
      );
        $check=$this->LibModel->userLogin($data);
        if ($check==true){
          //set user session
          $this->session->set_userdata('userlogin',$username);
          $data = array('lostbooks' => $this->LibModel->getLostBooks(),
          'currentstore'=>$this->LibModel->getBookstore(),
          'borrowedbooks'=>$this->LibModel->getBorrowed(),
          'charges'=>$this->LibModel->getChargesBook(),
        );
          $this->load->view('library/pages/home',$data);
        } else {
          $data = array('error_login' =>"Invalid username or password");
          $this->load->view('library/index.php',$data);
        }
      } else{
        $data = array('error_login' =>"Invalid username or password");
        $this->load->view('library/index.php',$data);
      }
    }
  }//end of function
  public function logout()
  {
    //destroy available session
    $this->session->sess_destroy();
    $data=array('logout' => 'You are logged out', );
    $this->load->view('library/index.php',$data);
  }//end of function
  public function viewcateglists()
  {
    //view books per category of in, out,lost
    // check if a valid user has logged in
    if (isset($_SESSION['userlogin'])){
      if (!empty($_GET['view']=='out')){
        $data = array(
        'books'=>$this->LibModel->getBorrowed(),
        'title'=>'Borrowed books');
        $this->load->view('library/pages/viewbooks.php',$data);
      } elseif(!empty($_GET['view']=='in')){
        $data = array(
        'books'=>$this->LibModel->getBookstore(),
        'title'=>'Available books');
        $this->load->view('library/pages/viewavailable.php',$data);
      }elseif(!empty($_GET['view']=='charges')){
        $data = array(
        'bookscharged'=>$this->LibModel->getChargesBook(),
        'title'=>'Charged books');
        $this->load->view('library/pages/viewbookscharged.php',$data);
      }elseif(!empty($_GET['view']=='lost')){
        $data = array(
        'books' => $this->LibModel->getLostBooks(),
        'title'=>'Lost books');
        $this->load->view('library/pages/viewlostbooks.php',$data);
      }else{
        $this->load->view('library/index.php');
      }
    } else{
      $this->load->view('library/index.php');
    }
  }//end of function
  public function paylost()
  {
    // pay the lost book
    $book=$this->input->post('bookcode');
    $student=$this->input->post('studentnumber');
    $currency=$this->input->post('currencytype');
    $price=$this->input->post('pricename');
    $this->form_validation->set_rules('bookcode','','required');
    $this->form_validation->set_rules('studentnumber','','required');
    $this->form_validation->set_rules('currencytype','','required');
    $this->form_validation->set_rules('pricename','','required');
    if ($this->form_validation->run()==true){
      //check if the book has been already paid by the same student when lost
      $where = array('registration_no' =>$student ,
      'book_code'=>$book,'fine_reason'=>'Lost',
      'status'=>'Paid');
      $table="book_fines";
      $paid=$this->LibModel->checkData($table,$where);
      if ($paid==false){
        // insert new book fines
        $insert = array('registration_no' =>$student ,
        'book_code'=>$book,'fine_reason'=>'Lost',
        'amount_charged'=>$price."(".$currency.")",
        'status'=>'Paid');
        $table="book_fines";
        $runinsert=$this->LibModel->insertData($table,$insert);
        if ($runinsert==true){
          $this->getsuccessData();
        } else {
          $this->geterrorData();
        }
      } else {
        // the book is already payed
        $this->geterrorData();
      }
    }else {
      $this->getvalidationdata();
    }
  }//end of function
  public function clearlost()
  {
    // get book and student submitted to remove lost data to book gotten
    if (isset($_POST['removelost'])) {
      $book=$this->input->post('booklost');
      $regno=$this->LibModel->getStudent($book);
      $data = array('clearlost' =>$book,'books' => $this->LibModel->getLostBooks(),'regno'=>$regno,'title'=>'Lost books');
      $this->load->view('library/pages/clearlostbook.php',$data);
    } elseif(isset($_POST['btnpaybook'])){
      $book=$this->input->post('booklost');
      $student=$this->LibModel->getStudent($book);
      $data = array('payrecord' =>$this->LibModel->payrecord($student,$book) ,);
      $this->load->view('library/pages/paylost.php',$data);
    }else {
      $this->geterrorData();
    }
  }//end of function
  public function saveclearlost()
  {
    // clear a record to a lost to out instead
    //get submitted data
    $bookid=$this->input->post('bookcode');
    $regno=$this->input->post('studentid');
    $status=$this->input->post('statusid');
    $borrowdata=$this->input->post('dateborrowed');
    $data = array('book_code' =>$bookid ,'registration_no'=>$regno,'borrow_status'=>'out');
    $where = array('book_code' =>$bookid ,'registration_no'=>$regno,'borrow_status'=>$status,'borrowed_date'=>$borrowdata);
    $table="book_borrows";
    $runupdate=$this->LibModel->doUpdate($table,$data,$where);
    if ($runupdate==true){
      $this->getsuccessData();
    } else {
      $this->geterrorData();
    }
  }
  public function viewList()
  {
    if (isset($_SESSION['userlogin'])){
      $data = array('viewbooks' =>$this->LibModel->getAll());
      $this->load->view('library/pages/booklist.php',$data);
    } else {
      $this->load->view('library/index.php');
    }
  }//end of function
  public function addBorrow()
  {
    // get submitted data
    $bookcode=$this->input->post('bookid');
    $student=$this->input->post('studentid');
    $returndate=$this->input->post('datereturnid');
    //validate data
    $this->form_validation->set_rules('bookid','Book name','required');
    $this->form_validation->set_rules('studentid','Student Number','required');
    $this->form_validation->set_rules('month','Month','required');
    $this->form_validation->set_rules('datereturnid','Date','required');
    $this->form_validation->set_rules('yearback','Year','required');
    //now validate each day,month and year
    $checkdates=$this->checkvalidDate();
    if (($this->form_validation->run()==true) && ($checkdates==true)){
      // save data in database
      $day=$this->input->post('datereturnid');
      $month=$this->input->post('month');
      $year=$this->input->post('yearback');
      $returndate=$year."-".$month."-".$day;
      $data = array('registration_no' =>$student,
      'borrow_status'=>'out',
      'borrowed_date '=>date('Y-m-d'),
      'return_date'=>$returndate,
      'book_code'=>$bookcode,
    );
    // check if the book has been borrowed by the entered student
    $borrow = array(
    'book_code'=>$bookcode,
    'borrow_status'=>'out',
   );
   $table="book_borrows";
   //run the query
   $check=$this->LibModel->checkData($table,$borrow);
   if ($check==false){
     $save=$this->LibModel->addBorrow('book_borrows',$data);
     if ($save==true){
       // return home on success;
       $this->getsuccessData();
     } else{
       //return home on failure
       $this->geterrorData();
     }
   } else {
     //return home on failure
     $this->geterrorData();
   }
   }else {
      //load data and redirect
      $this->getvalidationdata();
    }
  }//end od function
  function checkvalidDate()
  {
    // validate the date to be the current date or the future date
    $day=$this->input->post('datereturnid');
    $month=$this->input->post('month');
    $year=$this->input->post('yearback');
    $submitteddate=$year."-".$month."-".$day;
    $datetimestamp1=strtotime($submitteddate);
    $currentdate=date("Y-m-d");
    $datetimestamp2=strtotime($currentdate);
    if ($datetimestamp1>=$datetimestamp2){
      return true;
    } else {
      return false;
    }
  }//end of function
  public function lostBook()
  {
    // get submiited data
    $this->form_validation->set_rules('booklostname','','required');
    $this->form_validation->set_rules('studentlostname','','required');
    if ($this->form_validation->run()==true){
      // update book to lost
      $data = array('borrow_status' =>'lost');
      $where = array('registration_no'=>$this->input->post('studentlostname'),
      'book_code'=>$this->input->post('booklostname'),
      'borrow_status'=>'out',
     );
      $table="book_borrows";
      $update=$this->LibModel->doUpdate($table,$data,$where);
      if ($update==true){
        $this->getsuccessData();
      }else {
        $this->geterrorData();
      }
    } else {
      $this->getvalidationdata();
    }
  }//end of function
  public function getcategories()
  {
    // return all books categories in json data form;
		$sql=$this->db->query("SELECT * FROM book_categories");
		$data=$sql->result();
		echo json_encode($data);
  }//end of function
  public function getallbooks()
  {
    $sqlval=$this->db->query("SELECT * FROM books");
    $data=$sqlval->result();
    echo json_encode($data);
  }
  public function getallcategories()
  {
    $sqlval=$this->db->query("SELECT * FROM book_categories");
    $data=$sqlval->result();
    echo json_encode($data);
  }
  public function getborrow()
  {
    // check if there is valid input
    $bookid=$this->input->post('bookid');
    if (!empty($bookid)){
      // get the book record
      $sql=$this->db->query("SELECT * FROM book_borrows WHERE book_code='$bookid' AND borrow_status='out' OR borrow_status='lost'");
      $data=$sql->result();
      echo json_encode($data);
    } else {
      $data = array();
      echo json_encode($data);
    }
  }//end of function
  public function checkBorrow()
  {
    // check if there is valid input
    $bookid=$this->input->post('bookid');
    if (!empty($bookid)) {
      // get the book record
      $sql=$this->db->query("SELECT * FROM books WHERE book_code NOT IN (SELECT book_code FROM book_borrows) and book_code='$bookid'");
      $data=$sql->result();
      echo json_encode($data);
    } else {
      $data = array();
      echo json_encode($data);
    }
  }//end of function
  public function getalldata()
  {
    // check if there is valid input
    $bookid=$this->input->post('bookid');
    if (!empty($bookid)) {
      // get the book record
      $sql=$this->db->query("SELECT * FROM book_borrows WHERE book_code='$bookid'");
      $data=$sql->result();
      echo json_encode($data);
    } else {
      $data = array();
      echo json_encode($data);
    }
  }//end of function
  public function checkStudent()
  {
    //get submitted student registration number
    $student=$this->input->post('studentid');
    if (!empty($student)){
      $sql=$this->db->query("SELECT reference_no FROM students WHERE registration_no='$student'");
      $data=$sql->result();
      echo json_encode($data);
    } else {
      $data = array();
      echo json_encode($data);
    }
  }//end of function
  function getsuccessData()
  {
    //load data and redirect
    $data = array('lostbooks' => $this->LibModel->getLostBooks(),
    'currentstore'=>$this->LibModel->getBookstore(),
    'borrowedbooks'=>$this->LibModel->getBorrowed(),
    'charges'=>$this->LibModel->getChargesBook(),
    'success'=>'Data successfuly saved',
  );
    $this->load->view('library/pages/home',$data);
  }//end of function
  function geterrorData()
  {
    //load data and redirect
    $data = array('lostbooks' => $this->LibModel->getLostBooks(),
    'currentstore'=>$this->LibModel->getBookstore(),
    'borrowedbooks'=>$this->LibModel->getBorrowed(),
    'charges'=>$this->LibModel->getChargesBook(),
    'error'=>'Unable to save data, try again',
  );
    $this->load->view('library/pages/home',$data);
  }//end of function
  function getvalidationdata()
  {
    $data = array('lostbooks' => $this->LibModel->getLostBooks(),
    'currentstore'=>$this->LibModel->getBookstore(),
    'borrowedbooks'=>$this->LibModel->getBorrowed(),
    'charges'=>$this->LibModel->getChargesBook(),
  );
    $this->load->view('library/pages/home',$data);
  }//end end function
  public function returnBorrow()
  {
    // get submited data
    $bookcode=$this->input->post('bookid');
    $student=$this->input->post('studentid');
    //validate inputs
    $this->form_validation->set_rules('bookid','Book name','required');
    $this->form_validation->set_rules('studentid','Student number','required');
    if ($this->form_validation->run()==true){
      // check if the book has been borrowed by the entered student
      $data = array('registration_no' =>$student,
      'book_code'=>$bookcode,
      'borrow_status'=>'out',
     );
     $table="book_borrows";
     //run the query
     $check=$this->LibModel->checkData($table,$data);
     if ($check==true){
      //check if the return date has been respected;
      $days=$this->LibModel->checkDate($bookcode,$student);
      if ($days>0) {
        //register charges //registration_no 	book_code 	fine_reason 	number_days 	amount_charged 	status
        $datainsert = array('registration_no' => $student,'book_code'=>$bookcode,'fine_reason'=>'Due date charges','number_days'=>$days,'status'=>'Not Paid');
        $insert=$this->LibModel->insertData("book_fines",$datainsert);
        if ($insert==true){
          // Delete record of the borrowed book
          $where = array('registration_no' =>$student,
          'book_code'=>$bookcode,
          'borrow_status'=>'out',
          );
          $delete=$this->LibModel->doDelete($table,$where);
          if ($delete==true){
            //load data and redirect
            $data = array('lostbooks' => $this->LibModel->getLostBooks(),
            'currentstore'=>$this->LibModel->getBookstore(),
            'borrowedbooks'=>$this->LibModel->getBorrowed(),
            'charges'=>$this->LibModel->getChargesBook(),
            'error'=>'Data successfuly saved, the student is late to return the book('.$days.'days)',
          );
            $this->load->view('library/pages/home',$data);
          } else{
            $this->geterrorData();
          }
        } else {
          $this->geterrorData();
        }
      } else {
        //update valid return
        //Delete record of the borrowed book
        $where = array('registration_no' =>$student,
        'book_code'=>$bookcode,
        'borrow_status'=>'out',
        );
        $delete=$this->LibModel->doDelete($table,$where);
        if ($delete==true){
          $this->getsuccessData();
        } else {
          $this->geterrorData();
        }
      }
     } else{
       // return update error;
       $this->geterrorData();
     }
    } else{
      // redirect the page
      $this->getvalidationdata();
    }
  }//end of function
  public function viewMore()
  {
    if (!isset($_SESSION['userlogin']) || !isset($_POST['bookcode'])){
      $data = array('viewbooks' =>$this->LibModel->getAll());
      $this->load->view('library/pages/booklist.php',$data);
    } else{
      //get book code
      $bookid=$this->input->post('bookcode');
      if (isset($_POST['btninfo'])){
        $data = array('viewbooks' =>$this->LibModel->getAll(),
        'bookview'=>$bookid,
      );
        $this->load->view('library/pages/booklist.php',$data);
      }elseif(isset($_POST['btninfoedit'])){
        //get a record of a book to edit
        $data = array('viewbooks' =>$this->LibModel->getAll(),
        'bookedit'=>$bookid,);
        $this->load->view('library/pages/booklist.php',$data);
      }elseif(isset($_POST['returnbook'])){
        $regno=$this->LibModel->getStudent($bookid);
        $data = array('returnedbook' =>$bookid,
        'books'=>$this->LibModel->getBorrowed(),
        'title'=>'Borrowed books',
        'student'=>$regno,
       );
       $this->load->view('library/pages/viewbooks.php',$data);
     } elseif(isset($_POST['lostbook'])){
       $book=$this->input->post('bookcode');
       $student=$this->LibModel->getStudent($book);
       $data = array('payrecord' =>$this->LibModel->payrecord($student,$book) ,);
       $this->load->view('library/pages/addlost.php',$data);
     }else{
        $data = array('viewbooks' =>$this->LibModel->getAll());
        $this->load->view('library/pages/booklist.php',$data);
      }
    }
  }//end of function
  public function viewPay()
  {
    if (!isset($_SESSION['userlogin']) || !isset($_POST['bookcode'])){
      $data = array('viewbooks' =>$this->LibModel->getAll());
      $this->load->view('library/pages/booklist.php',$data);
    } elseif(isset($_POST['btninfo'])){
      $studentid=$this->input->post('studentid');
      //charged books
      $data = array('studentinfo'=>$this->LibModel->getStudentinfo($studentid),
    );
    $this->load->view('library/pages/viewborrowinfo.php',$data);
    }elseif(isset($_POST['btnpay'])){
      $bookid=$this->input->post('bookcode');
      $studentid=$this->input->post('studentid');
      $days=$this->input->post('daysnumber');
      $data = array('codepay' =>$bookid,'title'=>'Charged books',
      'student'=>$studentid,
      'day'=>$days,
      'bookscharged'=>$this->LibModel->getChargesBook(),
    );
      $this->load->view('library/pages/viewbookscharged.php',$data);
    }elseif (isset($_POST['btnpayedit'])){
      // edit the amount of data paid
      $bookid=$this->input->post('bookcode');
      $studentid=$this->input->post('studentid');
      $days=$this->input->post('daysnumber');
      $amount=$this->input->post('pricefees');
      $data = array('codeedit' =>$bookid,'title'=>'Charged books',
      'student'=>$studentid,
      'day'=>$days,
      'price'=>$amount,
      'bookscharged'=>$this->LibModel->getChargesBook(),
    );
      $this->load->view('library/pages/viewbookscharged.php',$data);
    }else{
      $data = array('lostbooks' => $this->LibModel->getLostBooks(),
      'currentstore'=>$this->LibModel->getBookstore(),
      'borrowedbooks'=>$this->LibModel->getBorrowed(),
      'charges'=>$this->LibModel->getChargesBook(),
    );
      $this->load->view('library/pages/home',$data);
    }
  }//end of function
  public function bookCharges()
  {
    // get submited data
    $book=$this->input->post('bookidcode');
    $student=$this->input->post('studentname');
    $amount=$this->input->post('paidamount');
    $number=$this->input->post('daysnumber');
    //validate for empty and wrong data
    $this->form_validation->set_rules('bookidcode','Book code','required');
    $this->form_validation->set_rules('studentname','Student number','required');
    $this->form_validation->set_rules('paidamount','Amount paid','required');
    $this->form_validation->set_rules('daysnumber','Number of days','required');
    if ($this->form_validation->run()==true){
      $data = array('amount_charged' =>$amount,'status'=>'Paid');
      $where = array('registration_no' =>$student,'book_code'=>$book,'number_days'=>$number,'status'=>'Not Paid');
      $table="book_fines";
      //update table with the above information
      $runupdate=$this->LibModel->doUpdate($table,$data,$where);
      if ($runupdate==true){
        $this->getsuccessData();
      } else {
        $this->geterrorData();
      }
    } else {
      $this->getvalidationdata();
    }
  }//end of function
  public function editcharges()
  {
    // get submited data
    $book=$this->input->post('bookidcode');
    $student=$this->input->post('studentname');
    $amount=$this->input->post('paidamount');
    $number=$this->input->post('daysnumber');
    //validate for empty and wrong data
    $this->form_validation->set_rules('bookidcode','Book code','required');
    $this->form_validation->set_rules('studentname','Student number','required');
    $this->form_validation->set_rules('paidamount','Amount paid','required');
    $this->form_validation->set_rules('daysnumber','Number of days','required');
    if ($this->form_validation->run()==true) {
      $data = array('amount_charged' =>$amount);
      $where = array('registration_no' =>$student,'book_code'=>$book,'number_days'=>$number,'status'=>'Paid');
      $table="book_fines";
      //update table with the above information
      $runupdate=$this->LibModel->doUpdate($table,$data,$where);
      if ($runupdate==true){
        $this->getsuccessData();
      } else {
        $this->geterrorData();
      }
    } else{
      $this->getvalidationdata();
    }
  }
  public function searchbook()
  {
    //validate input
    $this->form_validation->set_rules('searchoption','Search option','required|trim');
    $this->form_validation->set_rules('searchinput','','required|trim');
    if ($this->form_validation->run()==true){
      // get submitted data
      $searchoption=$this->input->post('searchoption');
      $searchvalue=$this->input->post('searchinput');
      if ($searchoption=="book_code"){
        // search book based on its code
        $data = array('book_code' =>$searchvalue);
        $table="books";
        $check=$this->LibModel->checkData($table,$data);
        if ($check==true){
          //go to search result view
          $data = array('records' =>$this->LibModel->getsearchid($searchvalue), );
          $this->load->view('library/pages/search.php',$data);
        } else{
          // book code not found
          $data = array('bookcode' =>$searchvalue);
          $this->load->view('library/pages/search.php',$data);
        }
      }elseif($searchoption=="book_title"){
        // search a book based on its title
        $where= array('book_title' =>$searchvalue);
        $books = $this->LibModel->getsearch($where);
        if (count($books)) {
          $data = array('records' =>$this->LibModel->getsearchid($searchvalue), );
          $this->load->view('library/pages/search.php',$data);
        } else{
          $data = array('bookcode' =>$searchvalue);
          $this->load->view('library/pages/search.php',$data);
        }
      }elseif ($searchoption=="book_author"){
        $where= array('book_author' =>$searchvalue);
        $books = $this->LibModel->getsearch($where);
        if (count($books)) {
          $data = array('records' =>$this->LibModel->getsearchid($searchvalue), );
          $this->load->view('library/pages/search.php',$data);
        } else{
          $data = array('bookcode' =>$searchvalue);
          $this->load->view('library/pages/search.php',$data);
        }
      }else{
        $this->getvalidationdata();
      }
    } else {//validation error
      $this->getvalidationdata();
    }
  }//end of function
  public function addPassword()//change the password
  {
    // get submitted
    $this->form_validation->set_rules('oldpassword','','required|trim');
    $this->form_validation->set_rules('newpassword','','required|trim');
    $this->form_validation->set_rules('newpasswordconf','','required|trim|matches[newpassword]');
    if ($this->form_validation->run()==true){
      // code...
      $old=$this->input->post('oldpassword');
      $new=$this->input->post('newpassword');
      //check if the user of the old password exists
      $user=$_SESSION['userlogin'];
      $where = array('password' =>$old,
      'email'=>$user,
    );
    $table="users";
    $check=$this->LibModel->checkData($table,$where);
    if ($check==true) {
      // run update password
      $dataupdate = array('password' =>$new);
      $update=$this->LibModel->doUpdate($table,$dataupdate,$where);
      if ($update==true) {
        $this->getsuccessData();
      } else {
        $this->geterrorData();
      }
    } else {
      $this->geterrorData();
    }
    } else {
      $this->getvalidationdata();
    }
  }//end of function
  public function viewadd()
  {
    // direct to allow borrow book from available books view
    $book = array('bookcode' =>$this->input->post('bookid'));
    $this->load->view('library/pages/viewadd.php',$book);
  }
}
?>
