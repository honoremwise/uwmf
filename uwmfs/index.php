<?php  session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>University of World Mission Frontier</title>
    <link rel="stylesheet" type="text/css" href="../css_scripts/vendor/bootstrap/css/bootstrap.min.css">
    <link href="../css_scripts/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="../css_scripts/dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../css_scripts/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
    <?php
    $msg="";
   include("dboperations.php");
    if(isset($_POST['loginbutton']))
        {
 	$username =$_POST['Useridname'];
 	$password =$_POST['useridPassword'];
	             //to find admin users
$user_result = mysqli_query($db,"select * from users join users_responsabilities using(user_respo_id) where users.email='$username' and users.password='$password' and users.status='Active'") or die(mysqli_error($db));
$userrecs = mysqli_num_rows($user_result);
$std_result = mysqli_query($db,"select * from students join candidates USING(reference_no)where students.registration_no='$username' and candidates.password='$password'") or die(mysqli_error($db));
$strecs = mysqli_num_rows($std_result);
        if($userrecs>0)
        {
	    $_SESSION['username'] = $username;
$res=mysqli_fetch_array($user_result);
            $resp=$res['responsability'];
            //echo $resp;

if($resp=="Lecturer"){
echo "<script>
window.location='lecturer/';
</script>";
}
if($resp=="Dean"){
   echo "<script>
window.location='dean/';
</script>";

}
if($resp=="As_registror"){
echo "<script>
window.location='assistant/';
</script>";

}
if($resp=="Accountant"){
echo "<script>
window.location='accountant/';
</script>";

}
if($resp=="Academic_registror"){
echo "<script>
window.location='registror/';
</script>";

}

    }
 if($strecs==1)
 {
     $_SESSION['registration_no'] = $username;
     echo "<script>
window.location='students/';
</script>";
 }
else{
	 $msg="<center><font color='red'><h3> Unauthorised Access</h3></font></center>
     <script>function redirect(){
     window.location='index.php';
   }
   setInterval(redirect,1000);
   </script>
     ";

	}

    }
           ?>


<body background="#000">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-primary">
                      <div class="panel-heading">
                  <h3 class="panel-title"><center>User Login</center></h3>
                    </div>
                <div class="panel-body">
                    <?php echo $msg?>
                    <center>
                        <form role="form" action="#" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <label for="Username"></label>
                                    <input class="form-control" placeholder="Email" name="Useridname" type="text" autofocus required>
                                </div>
                                <div class="form-group">
                                    <label for="Password"></label>
                                    <input class="form-control" placeholder="Password" name="useridPassword" type="password" required>
                                </div>
                                <div form-group>
                                </div><center>
                                <input type="submit" name="loginbutton" class="btn btn-lg btn-primary" value="Sign-in">
                                </center>
                            </fieldset>
                        </form>
                </div>
              </div>
              <h5 style="color: black;">&copy;<?php echo date('Y'); ?>&nbsp;&nbsp;University of World Mission Frontier</h5>
            </div>
        </div>
    </div>
</body>
</html>
