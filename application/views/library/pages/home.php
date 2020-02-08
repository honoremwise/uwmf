<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>UWMF-MIS-Library</title>
    <link rel="icon" href="<?php  echo base_url() ?>css_scripts/vendor/datatables/images/test.png" width="200" height="150" class="img-circle">
    <link href="<?php echo base_url(); ?>application/views/library/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>application/views/library/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>application/views/library/dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>application/views/library/vendor/morrisjs/morris.css" rel="stylesheet">
    <link rel="icon" href="<?php  echo base_url() ?>css_scripts/vendor/datatables/images/test.png" width="200" height="150" class="img-circle">
    <link href="<?php echo base_url(); ?>application/views/library/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?php echo base_url(); ?>application/views/library/vendor/jquery/jquery.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>application/views/library/js/pagesjs.js"></script>
    <script type="text/javascript">
    function validMessage(){
      alert("Data successfuly saved");
    }
    </script>
    <style media="screen">
      .addstyle{
        color: red;
      }
      .not-active{
        pointer-events: none;
        cursor: default;
      }
    </style>
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
          <img class="navbar-brand" src="<?php echo base_url();?>css_scripts/vendor/datatables/images/test.png" alt="logo">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <ul class="nav navbar-top-links navbar-right">
              <li>Logged in as <?php echo $_SESSION['userlogin']; ?></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#addpassword" data-toggle="modal" data-target="#addpassword"><i class="fa fa-edit fa-fw"></i> Change password</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php echo site_url()?>library/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="<?php echo site_url()?>Library"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Manage Books<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#addcategory" data-toggle="modal" data-target="#addcategory">Add New Category</a>
                                </li>
                                <li>
                                    <a href="#addbook" data-toggle="modal" data-target="#addbook">Add New Book</a>
                                </li>
                                <li><a href="#returnbookid" data-toggle="modal" data-target="#returnbookid">Return a Book</a>
                                </li>
                                <li>
                                    <a href="#lostbookid" data-toggle="modal" data-target="#lostbookid">Add Lost Book</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="<?php echo site_url()?>Library/viewList"><i class="fa fa-table fa-fw"></i>View Books&nbsp;<span id="countbook"></span></a>
                        </li>
                        <li>
                            <a href="<?php echo site_url()?>Library/viewCategories"><i class="fa fa-table fa-fw"></i>View Categories&nbsp;<span id="countcategories"></span></a>
                        </li>
                        <li>
                          <a href="#"><i class="fa fa-bar"></i>More Actions<span class="fa arrow"></span></a>
                          <ul class="nav nav-second-level">
                            <li><a href="<?php echo site_url()?>Library/categorylist"><i></i>Books and Categories</a>
                            </li>
                            <li>
                              <a href="#editBook" data-toggle="modal" data-target="#editBook">Edit book</a>
                            </li>
                          </ul>
                        </li>
                        <li>
                          <div class="panel">
                            <li class="sidebar-search nav">
                                <form class="form-horizontal" id="searchform" action="<?php echo site_url(); ?>Library/searchbook" method="post">
                                  <div class=" form-group">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                      <select class="form-control" name="searchoption" id="searchoption">
                                        <option value="0">search a book</option>
                                        <option value="book_code">by book code</option>
                                        <option value="book_title">by title</option>
                                        <option value="book_author">by Author</option>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="form-group" id="search">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                      <input type="text" name="searchinput" class="form-control" id="searchinput">
                                      <center>
                                        <button type="submit" class="btn btn-primary btn-outline">
                                          Search
                                        </button>
                                      </center>
                                    </div>
                                  </div>
                                </form>
                            </li>
                          </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                  <h5 style="color:red;">
                    <?php
                    if(!empty(validation_errors())) {
                      echo "Invalid input/Wrong data";
                    }
                    if (isset($error)) {
                      ?>
                      <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?php
                        echo $error;
                        ?>
                      </div>
                      <?php
                    }
                     ?>
                  </h5>
                  <h5>
                     <?php
                     if (isset($success)) {
                       ?>
                       <div class="alert alert-success alert-dismissable">
                         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                         <?php
                         echo $success;
                         ?>
                       </div>
                       <?php
                     }
                      ?>
                  </h5>
                  <h1 class="page-header"></h1>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
                                      <?php echo count($borrowedbooks); ?>
                                    </div>
                                    <div>Books out</div>
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo site_url();?>Library/viewcateglists?view=out" id="out">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
                                      <?php echo count($currentstore); ?>
                                    </div>
                                    <div>Books In</div>
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo site_url();?>Library/viewcateglists?view=in" id="in">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-shopping-cart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
                                      <?php echo count($charges); ?>
                                    </div>
                                    <div>Due date charges</div>
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo site_url();?>Library/viewcateglists?view=charges" id="charges">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-support fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">
                                      <?php echo count($lostbooks); ?>
                                    </div>
                                    <div>Lost Books</div>
                                </div>
                            </div>
                        </div>
                        <a href="<?php echo site_url();?>Library/viewcateglists?view=lost" id="lost">
                            <div class="panel-footer">
                              <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="alert alert-danger">
                            <i class="">Lost Books</i>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                              <table width="100%" class="table table-striped table-bordered table-hover" id="dataTablesbook">
                                <thead>
                                  <tr>
                                    <th></th>
                                    <th>Book code</th>
                                    <th>Book name</th>
                                    <th>Student number</th>
                                    <td></td>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  foreach ($lostbooks as $values){
                                    ?>
                                    <tr>
                                      <th>
                                        <form action="<?php echo site_url()?>Library/viewPay" method="post">
                                          <input type="hidden" name="studentid" value="<?php echo $values->registration_no; ?>">
                                          <button type="submit" class="btn btn-outline btn-primary fa fa-eye" title="Details" name="btninfo"></button>
                                        </form>
                                      </th>
                                      <td><?php echo $values->book_code; ?></td>
                                      <td><?php echo $values->book_title; ?></td>
                                      <td><?php echo $values->registration_no;?></td>
                                      <td>
                                        <form action="<?php echo site_url()?>Library/clearlost" method="post">
                                          <input type="hidden" name="booklost" value="<?php echo $values->book_code;?>">
                                          <button type="submit" class="btn btn-outline btn-danger fa fa-trash" name="removelost" title="remove"></button>
                                          <span><button type="submit" class="btn btn-outline btn-info fa fa-check" name="btnpaybook" title="pay"></button>
                                          </span>
                                        </form>
                                      </td>
                                    </tr>
                                    <?php
                                  }
                                   ?>
                                </tbody>
                              </table>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
                <!-- /.col-lg-8 -->
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-shopping-cart fa-fw"></i> Borrow a Book
                        </div>
                        <!-- /.panel-heading -->
                        <p id="formerror"></p>
                        <div class="panel-body">
                            <form action="<?php echo site_url(); ?>Library/addBorrow" method="post" id="addborrowform">
                              <div class="form-group">
                                <label for="book name">Book name</label>
                                <input type="text" name="bookid" id="bookid" class="form-control" placeholder="Enter book code">
                              </div>
                              <div class="form-group">
                                <label for="Student">Student number</label>
                                <input type="text" name="studentid" id="studentregno" class="form-control" placeholder="Enter registration number">
                              </div>
                              <div class="form-group">
                                <label for="return date">Return date</label>
                                <table border="0" cellspacing="0" >
                                <tr><td  align=left >Month
                                  <select name="month" class="form-control pull-right" id="monthid">
                                <option></option>
                                <option value='01'>January</option>
                                <option value='02'>February</option>
                                <option value='03'>March</option>
                                <option value='04'>April</option>
                                <option value='05'>May</option>
                                <option value='06'>June</option>
                                <option value='07'>July</option>
                                <option value='08'>August</option>
                                <option value='09'>September</option>
                                <option value='10'>October</option>
                                <option value='11'>November</option>
                                <option value='12'>December</option>
                                </select>
                                </td><td  align=left  >
                                Date<select name="datereturnid" class="form-control pull-right" id="datereturnid">
                                  <option></option>
                                <option value='01'>01</option>
                                <option value='02'>02</option>
                                <option value='03'>03</option>
                                <option value='04'>04</option>
                                <option value='05'>05</option>
                                <option value='06'>06</option>
                                <option value='07'>07</option>
                                <option value='08'>08</option>
                                <option value='09'>09</option>
                                <option value='10'>10</option>
                                <option value='11'>11</option>
                                <option value='12'>12</option>
                                <option value='13'>13</option>
                                <option value='14'>14</option>
                                <option value='15'>15</option>
                                <option value='16'>16</option>
                                <option value='17'>17</option>
                                <option value='18'>18</option>
                                <option value='19'>19</option>
                                <option value='20'>20</option>
                                <option value='21'>21</option>
                                <option value='22'>22</option>
                                <option value='23'>23</option>
                                <option value='24'>24</option>
                                <option value='25'>25</option>
                                <option value='26'>26</option>
                                <option value='27'>27</option>
                                <option value='28'>28</option>
                                <option value='29'>29</option>
                                <option value='30'>30</option>
                                <option value='31'>31</option>
                                </select>
                                </td>
                                <td  align=right>
                                Year(yyyy)<input type=text name="yearback" size=4 value=<?php echo date('Y'); ?> class="form-control pull-right" id="yearbackid">
                              </td>
                                </table>
                                <!--
                                <input type="date" name="datereturnid" class="form-control" id="datereturnid">
                              -->
                              </div>
                              <center>
                                <input type="submit" name="savebook" value="Borrow" class="btn btn-outline btn-primary">
                              </center>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
              <div class="col-lg-12">
                <!-- reset password -->
                <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addpassword" aria-hidden="true" id="addpassword">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <!-- Modal content/Add a category -->
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Change Password</h4>
                        <p id="forminputs"></p>
                      </div>
                      <div class="modal-body">
                        <form class="" action="<?php echo site_url();?>Library/addPassword" method="post" id="formaddpassword">
                          <div class="form-group">
                            <input type="password" name="oldpassword" id="oldpasswordid" class="form-control" placeholder="old password">
                          </div>
                          <div class="form-group">
                            <input type="password" name="newpassword" id="newpassword" class="form-control" placeholder="new password">
                          </div>
                          <div class="form-group">
                            <input type="password" name="newpasswordconf" id="newpasswordconf" class="form-control" placeholder=" confirm password">
                          </div>
                          <center>
                            <input type="submit" name="getadd" value="Save" class="btn btn-outline btn-primary">
                          </center>
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- end -->
                <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addcategory" aria-hidden="true" id="addcategory">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <!-- Modal content/Add a category -->
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add a Category</h4>
                        <p id="forminputs"></p>
                      </div>
                      <div class="modal-body">
                        <form class="" action="<?php echo site_url();?>Library/addCategory" method="post" id="formbookcategory">
                          <div class="form-group">
                            <label>Category code</label>
                            <input type="text" name="libbookcode" id="idbookcode" value="" class="form-control">
                          </div>
                          <div class="form-group">
                            <label>Category name</label>
                            <input type="text" name="libcatename" id="codebookname" value="" class="form-control">
                          </div>
                          <center>
                            <input type="submit" name="getadd" value="Add" class="btn btn-outline btn-primary">
                          </center>
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="lostbookid" aria-hidden="true" id="lostbookid">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <!--  modal content-->
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4>Declare lost</h4>
                        <p id="declarelostinput"></p>
                      </div>
                      <div class="modal-body">
                        <form action="<?php echo site_url();?>Library/lostBook" method="post" id="formlostbook">
                          <div class="form-group">
                            <label for="bookname">Book code</label>
                            <input type="text" name="booklostname" id="booklostid" class="form-control">
                          </div>
                          <div class="form-group">
                            <label for="student name">Student number</label>
                            <input type="text" name="studentlostname" id="studentlostid" class="form-control">
                          </div>
                          <center>
                            <input type="submit" name="addreturned" value="Save" class="btn btn-outline btn-primary">
                          </center>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- edit book -->
                <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editBook" aria-hidden="true" id="editBook">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <!--  modal content-->
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4>edit book</h4>
                        <p id="editbookinput"></p>
                      </div>
                      <div class="modal-body">
                        <form action="<?php echo site_url();?>Library/searchedit" method="post" id="formsearchbook">
                          <div class="form-group">
                            <input type="text" name="searchname" id="booksearchid" class="form-control" placeholder="book code">
                          </div>
                          <center>
                            <input type="submit" name="addreturned" value="check" class="btn btn-outline btn-primary">
                          </center>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="returnbookid" aria-hidden="true" id="returnbookid">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <!--  modal content-->
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4>Returned book</h4>
                        <p id="returninput"></p>
                      </div>
                      <div class="modal-body">
                        <form action="<?php echo site_url();?>Library/returnBorrow" method="post" id="formreturnbook">
                          <div class="form-group">
                            <label for="book code">Book code/name</label>
                            <input type="text" name="bookid" id="returnbookcode" class="form-control" placeholder="Enter book code">
                          </div>
                          <div class="form-group">
                            <label for="registration">Student number</label>
                            <input type="text" name="studentid" id="bookstudentid" class="form-control" placeholder="Enter student number">
                          </div>
                          <center>
                            <input type="submit" name="addreturned" value="Save" class="btn btn-outline btn-primary">
                          </center>
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addbook" aria-hidden="true" id="addbook">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <!-- Modal content/Add a book -->
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add a Book</h4>
                        <p id="forminput"></p>
                      </div>
                      <div class="modal-body">
                        <form class="" action="<?php echo site_url();?>Library/addBook" method="post" id="forminputsbook">
                          <div class="form-group col-md-6">
                            <label>Book code</label>
                            <input type="text" name="newbookid" id="newbookcode" class="form-control">
                          </div>
                          <div class="form-group col-md-6">
                            <label>Book category</label>
                            <select class="form-control" name="libcatenameid" id="libcatenameid">
                              <option></option>
                            </select>
                          </div>
                          <div class="form-group col-md-12">
                            <label>Enter title</label>
                            <input type="text" name="libookname" id="libookname" value="" class="form-control">
                          </div>
                          <div class="form-group col-md-12">
                            <label>Enter Author name</label>
                            <input type="text" name="bookwriterid" value="" id="bookwriterid" class="form-control">
                          </div>
                          <div class="form-group col-md-12">
                            <label>Enter Edition/version</label>
                            <input type="text" name="bookversionid" value="" id="bookversionid" class="form-control">
                          </div>
                          <div class="form-group col-md-12">
                            <label for="publication">Enter Publication</label>
                            <input type="text" name="bookpublication" id="publicationid" class="form-control">
                          </div>
                          <div class="form-group col-md-6">
                            <label>Price</label>
                            <input type="number" name="bookprice" value="" id="priceid" class="form-control">
                          </div>
                          <div class="form-group col-md-6">
                            <label>Currency type</label>
                            <select class="form-control" name="pricecurrencytype" id="pricecurrencyid">
                              <option value="Local Currency">Local Currency</option>
                              <option value="US Currency">US Currency</option>
                            </select>
                          </div>
                          <center>
                            <input type="submit" name="" value="Add" class="btn btn-outline btn-primary">
                          </center>
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    $("#libookname").attr('disabled','disabled');$("#bookwriterid").attr('disabled','disabled');$("#bookversionid").attr('disabled','disabled');$("#priceid").attr('disabled','disabled');$("#search").hide();$("#publicationid").attr('disabled','disabled');
    $(document).ready(function(){
      //load data by ajax
      $.ajax({
        type:'POST',
        url:'<?php echo site_url()?>Library/getcategories',
        dataType:'json',
        async:true,
        success:function(categories){
          var size=categories.length;
          if (size>0) {
            for (var i = 0; i < size; i++){
              var categcode=categories[i]['categ_code'];
              var categname=categories[i]['categ_name'];
              $("#libcatenameid").append("<option value='"+categcode+"'>"+categname+"</option>");
            }
          } else {
            $("#libcatenameid").attr('disabled','disabled');
          }
        },
        error:function(){
          $("#libcatenameid").attr('disabled','disabled');
        }
      });
      //
      $(document).on('change','#libcatenameid',function(){
        var category=$("#libcatenameid").val();
        if (category.length>0 && category!='') {
          $("#libookname").removeAttr('disabled','disabled');
        } else {
          $("#libookname").attr('disabled','disabled');
        }
      });
      $(document).on('change','#libookname',function() {
        var getbookname=$("#libookname").val();
        if (getbookname.length>0){
          $("#bookwriterid").removeAttr('disabled','disabled');
        } else{
          $("#bookwriterid").attr('disabled','disabled');
        }
      });
      $(document).on('change','#bookwriterid',function(){
        var getauthor=$("#bookwriterid").val();
        if (getauthor.length>0) {
          $("#bookversionid").removeAttr('disabled','disabled');
        } else {
          $("#bookversionid").attr('disabled','disabled');
        }
      });
      $(document).on('change','#bookversionid',function(){
        var getversion=$("#bookversionid").val();
        if (getversion.length>0){
          $("#publicationid").removeAttr('disabled','disabled');
        } else{
          //alert(getversion);
          $("#publicationid").attr('disabled','disabled');
        }
      });
      $(document).on('change','#publicationid',function(){
        var pulb=$("#publicationid").val();
        if (pulb.length>0){
          $("#priceid").removeAttr('disabled','disabled');
        } else{
          //alert(getversion);
          $("#priceid").attr('disabled','disabled');
        }
      });
      //return a book
      $(document).on('change','#returnbookcode',function(){
        //check the valid returned book id;
        var returnbook=$("#returnbookcode").val();
        if (returnbook.length>0 && returnbook!=''){
          //check if the book has been borrowed
          $.ajax({
            type:'POST',
            url:'<?php echo site_url()?>Library/getborrow',
            data:{bookid:returnbook},
            dataType:'json',
            async:true,
            success:function(borrowed){
              var size=borrowed.length;
              if (size>0){
                $("#bookstudentid").removeAttr('disabled','disabled');
                $("#bookstudentid").focus();
              } else {
                $("#bookstudentid").attr('disabled','disabled');
              }
            },
            error:function() {
              $("#bookstudentid").attr('disabled','disabled');
            }
          });
        } else {
          $("#bookstudentid").attr('disabled','disabled');
        }
      });
      $(document).on('focusout','#bookstudentid',function() {
        var student=$("#bookstudentid").val();
        var bookcode=$("#returnbookcode").val();
        if (student!="" && bookcode!=""){
          //succes
        } else{
          alert('Please Enter valid student number');
        }
      });
      //borrow a book
      $(document).on('focusout','#bookid',function(){
        var borrowbook=$("#bookid").val();
        //check if the book is ready to be lent
        $.ajax({
          type:'POST',
          url:'<?php echo site_url()?>Library/checkBorrow',
          data:{bookid:borrowbook},
          dataType:'json',
          async:true,
          success:function(books){
            if (books.length>0){
              $("#studentregno").removeAttr('disabled','disabled');
            } else {
              $("#studentregno").attr('disabled','disabled');
            }
          },
          error:function(){
            $("#studentregno").attr('disabled','disabled');
          }
        });
      });
      $("#studentregno").focusout(function(){
        //check if it is a valid student number
        var student=$("#studentregno").val();
        $.ajax({
          type:'POST',
          url:'<?php echo site_url()?>Library/checkStudent',
          data:{studentid:student},
          dataType:'json',
          async:true,
          success:function(students){
            if (students.length>0){
              //valid student found
              $("#datereturnid").removeAttr('disabled','disabled');
            } else{
              alert("Student not Found");
              $("#datereturnid").removeAttr('disabled','disabled');
            }
          },
          error:function(){
            alert("An error occurred, try again");
          }
        });
      });
      //manage book search
      $(document).on('change','#searchoption',function(){
        //get selection
        var searchinput=$("#searchoption").val();
        if (searchinput.length>1){
          $("#search").show();
        } else {
          $("#search").hide();
        }
      });
      //validate search book form
      $("#searchform").submit(function(){
        var searchid=$("#searchinput").val();
        if (searchid.length>0){
          return true;
        } else{
          return false;
        }
      });
      //disable links to view book list categories when empty
      var available="<?php  echo count($currentstore);?>";
      var out="<?php  echo count($borrowedbooks);?>";
      var lost="<?php  echo count($lostbooks);?>";
      var charges="<?php  echo count($charges);?>";
      var booklist={'in':available,'out':out,'lost':lost,'charges':charges};
      function checkavailable(books){
        for(var prop in books){
          if (books[prop]==0){
            $("#"+prop).addClass('not-active');
          }
        }
      }
      checkavailable(booklist);
    });
    </script>
    <script type="text/javascript">
    $(document).ready(function(){
      $("#dataTablesbook").DataTable({
        responsive:true
      });
    });
    //count all available books
    $.ajax({
      type:'POST',
      url:'<?php echo site_url()?>Library/getallbooks',
      dataType:'json',
      async:true,
      success:function(books){
        var countbook=books.length;
        //display the current available books
        $("#countbook").html("("+countbook+")");
      },
      error:function(){
        var countbook=0;
        $("#countbook").html("("+countbook+")");
      }
    });
    //count all available categories
    $.ajax({
      type:'POST',
      url:'<?php echo site_url()?>Library/getallcategories',
      dataType:'json',
      async:true,
      success:function(categories){
        var countcategories=categories.length;
        //display the current available books
        $("#countcategories").html("("+countcategories+")");
      },
      error:function(){
        var countcategories=0;
        $("#countcategories").html("("+countcategories+")");
      }
    });
    </script>
    <script type="text/javascript">
      $(document).ready(function(){
        $(document).on('change','#bookidsearch',function(){
          //development,
        });
      });
    </script>
    <script type="text/javascript" src="<?php  echo base_url() ?>css_scripts/vendor/jquery/jquery.js"></script>
    <script src="<?php echo base_url(); ?>application/views/library/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>application/views/library/vendor/metisMenu/metisMenu.min.js"></script>
    <script src="<?php echo base_url(); ?>application/views/library/vendor/raphael/raphael.min.js"></script>
    <script src="<?php echo base_url(); ?>application/views/library/vendor/morrisjs/morris.min.js"></script>
    <script src="<?php echo base_url(); ?>application/views/library/data/morris-data.js"></script>
    <script src="<?php echo base_url(); ?>application/views/library/dist/js/sb-admin-2.js"></script>
    <script src="<?php echo base_url() ?>/css_scripts/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ?>/css_scripts/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>/css_scripts/vendor/datatables-responsive/dataTables.responsive.js"></script>
</body>
</html>
