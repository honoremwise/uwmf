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
                        <th></th>
                        <th>Book code</th>
                        <th>Charged reason</th>
                        <th>Student number</th>
                        <th>Charged fees</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach ($bookscharged as $key){
                        ?>
                        <tr>
                          <td><!--show a button edit pay fees -->
                            <form class="" action="<?php echo site_url()?>Library/viewPay" method="post">
                              <input type="hidden" name="bookcode" value="<?php echo $key->book_code;?>">
                              <input type="hidden" name="studentid" value="<?php echo $key->registration_no; ?>">
                              <input type="hidden" name="pricefees" value="<?php echo $key->amount_charged; ?>">
                              <input type="hidden" name="daysnumber" value="<?php echo $key->number_days; ?>">
                              <?php
                              $paid=$key->amount_charged;
                              $days=$key->number_days;
                              if ((count($paid)>0 && $paid!="")&& $days>0) {
                                ?>
                                <button type="submit" class="fa fa-edit btn btn-warning" name="btnpayedit"></button>
                                <?php
                              } else {
                                // show pay button with disabled attribute
                                ?>
                                <button type="submit" class="fa fa-edit btn btn-warning" name="btnpayedit" disabled></button>
                                <?php
                              }
                               ?>
                            </form>
                          </td>
                          <td><?php echo $key->book_code; ?></td>
                          <td><?php echo $key->fine_reason; ?></td>
                          <td><?php echo $key->registration_no; ?></td>
                          <td><?php echo $key->amount_charged; ?></td>
                          <td>
                            <?php echo $key->status; ?>
                          </td>
                          <td><!--show a button to pay fees when paid or unpaid -->
                            <form action="<?php echo site_url()?>Library/viewPay" method="post">
                              <input type="hidden" name="bookcode" value="<?php echo $key->book_code;?>">
                              <input type="hidden" name="studentid" value="<?php echo $key->registration_no; ?>">
                              <input type="hidden" name="daysnumber" value="<?php echo $key->number_days; ?>">
                              <button type="submit" class="btn btn-outline btn-primary fa fa-eye" title="Details" name="btninfo"></button>
                              <span>
                                <?php
                                $amount=$key->amount_charged;
                                if (count($amount)>0 && $amount!=""){
                                  // show pay button with disabled attribute
                                  ?>
                                  <button type="submit" class="btn btn-outline btn-info fa fa-check" name="" disabled></button>
                                  <?php
                                }else{
                                  // show pay button
                                  ?>
                                  <button type="submit" title="Pay"class="btn btn-outline btn-info fa fa-check" name="btnpay"></button>
                                  <?php
                                }
                                 ?>
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
                <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addcharges" aria-hidden="true" id="editcharges">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <!-- Modal edit paid charges -->
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Edit charges</h4>
                      </div>
                      <div class="modal-body">
                        <form  action="<?php echo site_url();?>Library/editcharges" method="post">
                          <div class="form-group col-md-6">
                            <label>Book code</label>
                            <input type="text" name="bookidcode" value="<?php echo $codeedit; ?>" class="form-control">
                          </div>
                          <div class="form-group col-md-6">
                            <label>Student number</label>
                            <input type="text" name="studentname" value="<?php echo $student; ?>" class="form-control">
                          </div>
                          <div class="form-group col-md-6">
                            <label>Amount paid</label>
                            <input type="number" name="paidamount" class="form-control" value="<?php echo $price; ?>">
                          </div>
                          <div class="form-group col-md-6">
                            <label>Number of days</label>
                            <input type="number" name="daysnumber" value="<?php echo $day; ?>" class="form-control">
                          </div>
                          <center><input type="submit" name="" value="Pay" class="btn btn-outline btn-primary"></center>
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- -->
                <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addcharges" aria-hidden="true" id="bookcharges">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <!-- Modal register paid charges -->
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Register Paid charges</h4>
                        <p id="chargesinput"></p>
                      </div>
                      <div class="modal-body">
                        <form  action="<?php echo site_url();?>Library/bookCharges" method="post">
                          <div class="form-group col-md-6">
                            <label>Book code</label>
                            <input type="text" name="bookidcode" value="<?php echo $codepay; ?>" class="form-control">
                          </div>
                          <div class="form-group col-md-6">
                            <label>Student number</label>
                            <input type="text" name="studentname" value="<?php echo $student; ?>" class="form-control">
                          </div>
                          <div class="form-group col-md-6">
                            <label>Amount paid</label>
                            <input type="number" name="paidamount" class="form-control">
                          </div>
                          <div class="form-group col-md-6">
                            <label>Number of days</label>
                            <input type="number" name="daysnumber" value="<?php echo $day; ?>" class="form-control">
                          </div>
                          <center><input type="submit" name="" value="Pay" class="btn btn-outline btn-primary"></center>
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
        function showinfo(studentinfo){
          if (studentinfo!=""){
            $("#showmoreinfo").modal("show");
          } else {
          }
        }
        function doedit(codeedit,price){
          if (codeedit!="" && price!="") {
            $("#editcharges").modal("show");
          } else {
          }
        }
        function dopay(codebook){
          if (codebook!="") {
            $("#bookcharges").modal("show");
          } else {
          }
        }
        showinfo("<?php echo $studentinfo; ?>")
        doedit("<?php echo $codeedit; ?>","<?php echo $price; ?>");
        dopay("<?php echo $codepay; ?>");
      });
    </script>
    <script type="text/javascript">
    $(document).ready(function(){
      $("#Tablesbook").DataTable({
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
    <script src="<?php echo base_url() ?>/css_scripts/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ?>/css_scripts/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>/css_scripts/vendor/datatables-responsive/dataTables.responsive.js"></script>
</body>
</html>
