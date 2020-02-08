<?php
$CI = &get_instance();
$CI->load->database();
$host= $CI->db->hostname;
$pass=$CI->db->password;
$user=$CI->db->username;
 ?>
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
    <link href="<?php echo base_url(); ?>application/views/library/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?php echo base_url(); ?>application/views/library/vendor/jquery/jquery.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>application/views/library/js/pagesjs.js"></script>
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="<?php echo site_url()?>Library"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                      <?php echo $title; ?>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
              <div class="col-lg-12">
                <div class="table-responsive">
                  <table width="100%" class="table table-striped table-bordered table-hover" id="Tablesbook">
                    <thead>
                      <tr>
                        <th>Book code</th>
                        <th>Name</th>
                        <th>Publisher</th>
                        <th>Student number</th>
                        <th>Borrowed date</th>
                        <th>Return date</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach ($books as $key){
                        ?>
                        <tr>
                          <td><?php echo $key->book_code; ?></td>
                          <td><?php echo $key->book_title; ?></td>
                          <td><?php echo $key->publication_name; ?></td>
                          <td><?php
                          //get the student number
                          $book=$key->book_code;
                          $sqlval=$CI->db->query("SELECT * from book_borrows WHERE book_code='$book'");
                          $result=$sqlval->result();
                          if (count($result)>0){
                            foreach ($result as $value) {
                              echo $value->registration_no;
                            }
                          } else{
                            echo "No data to show";
                          }
                          ?>
                          </td>
                          <td>
                            <?php
                            //get borrowed date
                            $book=$key->book_code;
                            $sqlval=$CI->db->query("SELECT * from book_borrows WHERE book_code='$book'");
                            $result=$sqlval->result();
                            if (count($result)>0){
                              foreach ($result as $value) {
                                echo $value->borrowed_date;
                              }
                            } else{
                              echo "No data to show";
                            }
                            ?>
                          </td>
                          <td>
                            <?php
                            //get borrowed date
                            $book=$key->book_code;
                            $sqlval=$CI->db->query("SELECT * from book_borrows WHERE book_code='$book'");
                            $result=$sqlval->result();
                            if (count($result)>0){
                              foreach ($result as $value) {
                                echo $value->return_date;
                              }
                            } else{
                              echo "No data to show";
                            }
                            ?>
                          </td>
                          <td>
                            <form action="<?php echo site_url()?>Library/viewMore" method="post">
                              <input type="hidden" name="bookcode" value="<?php echo $key->book_code;?>">
                              <button type="submit" class="btn btn-primary btn-outline" name="returnbook">return</button>
                              <button type="submit" class="btn btn-primary btn-outline" name="lostbook">add lost</button>
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
            </div>
            <div class="row">
              <div class="col-lg-12">
                <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="returnedid" aria-hidden="true" id="returnedid">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <!--  modal content-->
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4>Returned book</h4>
                      </div>
                      <div class="modal-body">
                        <form action="<?php echo site_url();?>Library/returnBorrow" method="post">
                          <div class="form-group">
                            <label for="book code">Book code/name</label>
                            <input type="text" name="bookid" id="returnbookcode" class="form-control" value="<?php echo $returnedbook; ?>">
                          </div>
                          <div class="form-group">
                            <label for="registration">Student number</label>
                            <input type="text" name="studentid" id="bookstudentid" class="form-control" value="<?php echo $student;?>">
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
              </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    $(document).ready(function(){
      $("#Tablesbook").DataTable({
        responsive:true
      });
      function getreturn(value) {
        var getreg=value;
        if (getreg!=""){
          $("#returnedid").modal("show");
        } else {
        }
      }
      getreturn("<?php echo $student;?>");
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
