<?php
/**
 *load index view for system users login
 */
class Users extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
  }
  public function index()
	{
		header('location:../uwmfs/');
	}
}
 ?>
