<?php
/**
 * Library management system
 */
class LibModel extends CI_Model
{
  function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
  }
  public function userLogin($data)
  {
    $query=$this->db->get_where('users',$data);
    $result=$query->result();
    if (count($result)>0){
      return true;
    } else{
      return false;
    }
  }//end of function
  public function getcategories()
  {
    return $this->db->query("SELECT * FROM book_categories")->result();
  }
  public function getLostBooks()
  {
    // get all books with the status lost
    return $this->db->query("SELECT * FROM books join book_borrows using(book_code) WHERE borrow_status='lost'")->result();
  }
  public function checkDate($book,$student)
  {
    //
    $sqlval=$this->db->query("SELECT datediff(current_timestamp,return_date) as dates FROM book_borrows WHERE book_code='$book' AND registration_no='$student'");
    $result=$sqlval->result();
    if (count($result)>0){
      foreach ($result as $value){
        return $value->dates;
      }
    } else{
      return false;
    }
  }//end of function
  public function getStudent($book)
  {
    $sqlval=$this->db->query("SELECT * FROM book_borrows WHERE book_code='$book'");
    $result=$sqlval->result();
    if (count($result)>0){
      foreach ($result as $value){
        return $value->registration_no;
      }
    } else{
      return false;
    }
  }//
  public function getStudentinfo($student)//get complete info of the student borrowed a book
  {
    return $this->db->query("SELECT * from students join candidates using(reference_no) JOIN book_fines using(registration_no) join programs using(program_code) join branches using(branch_code) WHERE registration_no='$student'")->result();
  }
  public function getBookstore()
  {
    return $this->db->query("SELECT * FROM books WHERE book_code NOT IN(SELECT book_code FROM book_borrows)OR book_code IN(SELECT book_code FROM book_borrows WHERE borrow_status='returned')")->result();//revise
  }
  public function getChargesBook()
  {
    // books with due charges paid or unpaid
    return $this->db->query("SELECT * FROM book_fines join books using(book_code)")->result();
  }
  public function getBorrowed()
  {
    return $this->db->query("SELECT * FROM books WHERE book_code in (SELECT book_code FROM book_borrows WHERE borrow_status !='lost')")->result();
  }
  public function insertData($table,$data)
  {
    // insert data in database
    $this->db->insert($table,$data);
    if ($this->db->affected_rows()>0){
      return true;
    } else{
      return false;
    }
  }//end function
  public function addBorrow($table,$data)
  {
    // insert data in database
    $this->db->insert($table,$data);
    if ($this->db->affected_rows()>0){
      return true;//19881
    } else{
      return false;
    }
  }//end of the function
  public function checkData($table,$data)
  {
    // make query to select data from database
    $this->db->where($data);
    $query=$this->db->get($table);
    $result=$query->result();
    $gets=$query->num_rows();
    if ($gets>0){
      return true;
    } else {
      return false;
    }
  }//end of function
  public function doUpdate($table,$dataupdate,$where)
  {
    $this->db->where($where);
    $this->db->update($table,$dataupdate);
    if ($this->db->affected_rows()>0){
      return true;
    } else {
      return false;
    }
  }//end of function
  public function doDelete($table,$where)
  {
    $this->db->where($where);
    $this->db->delete($table);
    if ($this->db->affected_rows()>0){
      return true;
    } else {
      return false;
    }
  }
  public function getAll()
  {
    //get all books in the store
    return $this->db->query("SELECT * FROM books")->result();
  }//end of function
  public function getsearch($title)
  {
    //return $this->db->query("SELECT * FROM books WHERE book_title like '%$title%' OR book_author like '%$title%'")->result();
    $this->db->from("books");
    $this->db->like($title);
    $query=$this->db->get();
    $result=$query->result_array();
    return $result;
  }
  public function getsearchid($search)
  {
    return $this->db->query("SELECT * FROM books WHERE book_code='$search'")->result();
  }
  public function getRecord($book)
  {
    // get a single record book
    return $this->db->query("SELECT * FROM books WHERE book_code='$book'")->result();
  }//end of function
  public function payrecord($student,$book)
  {
    return $this->db->query("SELECT * FROM book_borrows JOIN books using(book_code) join book_categories using(categ_code) WHERE registration_no='$student' AND book_code='$book'")->result();
  }
  public function categories()
  {
    return $this->db->query("SELECT categ_name,categ_code,count(categ_code) as books FROM book_categories join books using (categ_code) GROUP BY categ_code")->result();
    //
  }
}
?>
