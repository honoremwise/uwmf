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
    <script type="text/javascript">
    $(document).ready(function(){
      //more info on booklist display
      function managesbookinfo(bookcode){
        if (bookcode!=""){
          //load ajax data
          $.ajax({
            type:'POST',
            url:'<?php echo site_url()?>Library/getborrow',
            data:{bookid:bookcode},
            dataType:'json',
            async:true,
            success:function(borrowed){
              var size=borrowed.length;
              if (size>0){
                for (var i = 0; i < size; i++) {
                  var returndate=borrowed[i]['return_date'];
                  var borrowdate=borrowed[i]['borrowed_date'];
                  var student=borrowed[i]['registration_no'];
                  var title = "Current borrowed status";
                  $("#borrowid").html(borrowdate);
                  $("#returnid").html(returndate);
                  $("#studentid").html(student);
                  $("#viewinfo .modal-title").html(title);
                  $("#viewinfo").modal("show");
                }
              } else {
                var title = "Borrowed status";
                $("#viewinfo .modal-title").html(title);
                var body = "No current data to show";
                $("#viewinfo .modal-body").html(body);
                $("#viewinfo").modal("show");
              }
            },
            error:function() {
              var title = "Borrowed status";
              $("#viewinfo .modal-title").html(title);
              var body = "No current data to show";
              $("#viewinfo .modal-body").html(body);
              $("#viewinfo").modal("show");
            }
          });
        }else {
        }
      }
      function editrecord(book){
      if (book!=""){
        $("#addbook").modal("show");
      }
      }
      managesbookinfo("<?php echo $bookview;?>");
      editrecord("<?php echo $bookedit;?>")
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
                    <h1 class="page-header">All Books</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
              <div class="col-lg-12">
                <div class="table-responsive">
                  <table width="100%" class="table table-striped table-bordered table-hover" id="dataTablesbook">
                    <thead>
                      <tr>
                        <th>Book code</th>
                        <th>Book name</th>
                        <th>Book Author</th>
                        <th>Book version</th>
                        <th>Price</th>
                        <th>Book Category</th>
                        <th>Publisher</th>
                        <th>Current status</th>
                        <th>More</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach ($viewbooks as $key){
                        ?>
                        <tr>
                          <td><?php echo $key->book_code; ?></td>
                          <td><?php echo $key->book_title; ?></td>
                          <td><?php echo $key->book_author;?></td>
                          <td><?php echo $key->book_version;?></td>
                          <td><?php echo $key->book_price;?></td>
                          <td>
                            <?php
                            $category=$key->categ_code;
                            //get the category name
                            $sqlval=$CI->db->query("SELECT * from book_categories WHERE categ_code='$category'");
                            $result=$sqlval->result();
                            if (count($result)>0){
                              foreach ($result as $value){
                                echo $value->categ_name;
                              }
                            }
                             ?>
                          </td>
                          <td>
                            <?php echo $key->publication_name; ?>
                          </td>
                          <td>
                            <?php
                            $book=$key->book_code;
                            //get the current book status
                            $sqlval=$CI->db->query("SELECT * from book_borrows WHERE book_code='$book'");
                            $result=$sqlval->result();
                            if (count($result)>0){
                              foreach ($result as $key) {
                                echo $key->borrow_status;
                              }
                            } else{
                              echo "In";
                            }
                             ?>
                          </td>
                          <td>
                            <form action="<?php echo site_url()?>Library/viewMore" method="post">
                              <input type="hidden" name="bookcode" value="<?php echo $key->book_code;?>">
                              <button type="submit" class="fa fa-eye btn btn-info" name="btninfo"></button>
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
                <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="viewinfo" aria-hidden="true" id="viewinfo">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <!-- Modal content/Add a category -->
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title"></h3>
                      </div>
                      <div class="modal-body">
                        <table width="100%" class="table table-striped table-bordered table-hover">
                          <thead>
                            <tr>
                              <th>Borrowed date</th>
                              <th>Return date</th>
                              <th>Student number</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td id="borrowid"></td>
                              <td id="returnid"></td>
                              <td id="studentid"></td>
                            </tr>
                          </tbody>
                        </table>
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
                        <h4 class="modal-title">Edit book record</h4>
                        <p id="forminput"></p>
                      </div>
                      <div class="modal-body">
                        <form class="" action="<?php echo site_url();?>Library/editBook" method="post" id="forminputsbook">
                          <div class="form-group col-md-6">
                            <label>Book code</label>
                            <input type="text" name="newbookid" id="newbookcode" class="form-control" value="<?php echo $bookedit;?>">
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
                            <input type="number" name="bookversionid" value="" id="bookversionid" class="form-control">
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
                            <input type="submit" name="" value="edit" class="btn btn-outline btn-primary">
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
    $("#libookname").attr('disabled','disabled');$("#bookwriterid").attr('disabled','disabled');$("#bookversionid").attr('disabled','disabled');$("#priceid").attr('disabled','disabled');$("#publicationid").attr('disabled','disabled');
    //load data by ajax
    $.ajax({
      type:'POST',
      url:'<?php echo site_url()?>Library/getcategories',
      dataType:'json',
      async:true,
      success:function(categories){
        var size=categories.length;
        if (size>0){
          for (var i = 0; i < size; i++){
            var categcode=categories[i]['categ_code'];
            var categname=categories[i]['categ_name'];
            $("#libcatenameid").append("<option value='"+categcode+"'>"+categname+"</option>");
          }
        } else{
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
      } else {
        alert(getversion);
        $("#publicationid").attr('disabled','disabled');
      }
    });
    $(document).on('change','#publicationid',function(){
      var publication=$("#publicationid").val();
      if (publication.length>0){
        $("#priceid").removeAttr('disabled','disabled');
      } else {
        alert(getversion);
        $("#priceid").attr('disabled','disabled');
      }
    });
    </script>
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
