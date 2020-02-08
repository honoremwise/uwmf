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
                      Borrow book
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
              <div class="col-lg-12">
                <div>
                  <table width="" id="Tablesbook">
                    <thead>
                      <tr>
                        <th>Book code</th>
                        <th>Student number</th>
                        <th>Return date</th>
                        <th></th>
                        <th></th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <form class="" action="<?php echo site_url()?>Library/addBorrow" method="post">
                        <td>
                          <input type="text" name="bookid" id="bookid" class="form-control" value="<?php echo $bookcode ?>">
                        </td>
                        <td>
                          <input type="text" name="studentid" id="studentregno" class="form-control" placeholder="Enter registration number">
                        </td>
                        <td>
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
                        </td>
                        <td>
                          <select name="datereturnid" class="form-control pull-right" id="datereturnid">
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
                        <td>
                          <input type=text name="yearback" size=4 value=<?php echo date('Y'); ?> class="form-control pull-right" id="yearbackid">
                        </td>
                        <td>
                          <input type="submit" name="savebook" value="Borrow" class="btn btn-outline btn-primary">
                        </td>
                      </form>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
        </div>
    </div>
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
