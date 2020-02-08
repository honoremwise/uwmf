<?php
$CI = &get_instance();
$CI->load->database();
$host= $CI->db->hostname;
$pass=$CI->db->password;
$user=$CI->db->username;
print_r($data);
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
    <script type="text/javascript">
    $(document).ready(function(){
      function getcategory(category){
        if (category!=""){
          $("#addcategory").modal("show");
        }
      }
      getcategory("<?php echo $categoryname; ?>");
    });
    </script>
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
                    <h1 class="page-header">All Books categories</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
              <div class="col-lg-12">
                <div class="table-responsive">
                  <table width="100%" class="table table-striped table-bordered table-hover" id="dataTablesbook">
                    <thead>
                      <tr>
                        <th>Category code</th>
                        <th>Category name</th>
                        <th>Number of books in category</th>
                        <th>More</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach ($categories as $key){
                        ?>
                        <tr>
                          <td><?php echo $key->categ_code; ?></td>
                          <td><?php echo $key->categ_name; ?></td>
                          <td>
                            <?php
                            $category=$key->categ_code;
                            $sqlval=$CI->db->query("SELECT * FROM books WHERE categ_code='$category'");
                            $result=$sqlval->result();
                            echo count($result);
                            //echo $key->books;
                            ?>
                          </td>
                          <td>
                            <form action="<?php echo site_url()?>Library/editcategory" method="post">
                              <input type="hidden" name="bookcode" value="<?php echo $key->categ_code;;?>">
                              <span><button type="submit" class="fa fa-edit btn btn-warning" name="btninfoedit"></button>
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
            </div>
            <div class="row">
              <div class="col-lg-12">
                <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addcategory" aria-hidden="true" id="addcategory">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <!-- Modal content/Add a category -->
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Edit a Category</h4>
                        <p id="forminputs"></p>
                      </div>
                      <div class="modal-body">
                        <form action="<?php echo site_url();?>Library/editcategorydata" method="post" id="formbookcategory">
                          <div class="form-group">
                            <label>Category code</label>
                            <input type="text" name="libbookcode" id="idbookcode" value="<?php echo $categoryid; ?>" class="form-control">
                          </div>
                          <div class="form-group">
                            <label>Category name</label>
                            <input type="text" name="libcatename" id="codebookname" value="" class="form-control">
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
              </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    $(document).ready(function(){
      $("#dataTablesbook").DataTable({
        responsive:true
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
    <script src="<?php echo base_url(); ?>/css_scripts/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>/css_scripts/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>/css_scripts/vendor/datatables-responsive/dataTables.responsive.js"></script>
</body>
</html>
