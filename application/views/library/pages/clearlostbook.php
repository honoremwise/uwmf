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
          <div class="">

          </div>
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Clear Record</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
              <div class="col-lg-12">
                <div class="table-responsive">
                  <table width="100%" class="table table-striped table-hover">
                    <thead>
                      <tr>
                        <th>Book code</th>
                        <th>Student number</th>
                        <th>Borrowed date</th>
                        <th>Current status</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <td>
                        <?php echo $clearlost; ?>
                      </td>
                      <td>
                        <?php echo $regno; ?>
                      </td>
                      <td id="borroweddate">
                      </td>
                      <td id="currentstatus">
                      </td>
                      <td>
                        <form action="<?php echo site_url()?>Library/saveclearlost" method="post">
                          <input type="hidden" name="bookcode" value="<?php echo $clearlost; ?>" id="bookcodeid">
                          <input type="hidden" name="studentid" value="<?php echo $regno; ?>"  id="regnoid">
                          <input type="hidden" name="dateborrowed"  id="dateborrowedid">
                          <input type="hidden" name="statusid"  id="statusid">
                          <button type="submit" name="editlost" class="btn btn-outline btn-danger fa fa-trash" title="clear"></button>
                        </form>
                      </td>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
      $(document).ready(function(){
        var bookcode=$("#bookcodeid").val();
        if (bookcode!=""){
          $.ajax({
            'type':'POST',
            'url':'<?php echo site_url()?>Library/getalldata',
            'data':{bookid:bookcode},
            'dataType':'json',
            async:true,
            success:function(student){
              var count=student.length;
            if (count>0){
              for (var i = 0; i < count; i++){
                var studentnumber=student[i]['registration_no'];
                $("#regnoid").val(studentnumber);
                var borrowedDate=student[i]['borrowed_date'];
                $("#dateborrowedid").val(borrowedDate);
                $("#borroweddate").html(borrowedDate);
                var currentstatus=student[i]['borrow_status'];
                $("#currentstatus").html(currentstatus);
                $("#statusid").val(currentstatus);
              }
            } else{//empty record returned
            }
            },
            error:function(){
              alert("Error on the page, try again");
            }
          });
        } else{
        }
      });
    </script>
    <script type="text/javascript" src="<?php  echo base_url() ?>css_scripts/vendor/jquery/jquery.js"></script>
    <script src="<?php echo base_url(); ?>application/views/library/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>application/views/library/vendor/metisMenu/metisMenu.min.js"></script>
    <script src="<?php echo base_url(); ?>application/views/library/vendor/raphael/raphael.min.js"></script>
    <script src="<?php echo base_url(); ?>application/views/library/vendor/morrisjs/morris.min.js"></script>
    <script src="<?php echo base_url(); ?>application/views/library/data/morris-data.js"></script>
    <script src="<?php echo base_url(); ?>application/views/library/dist/js/sb-admin-2.js"></script>
    <script src="<?php echo base_url(); ?>/css_scripts/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>/css_scripts/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>/css_scripts/vendor/datatables-responsive/dataTables.responsive.js"></script>
</body>
</html>
