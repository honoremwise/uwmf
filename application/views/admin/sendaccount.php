<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="icon" href="<?php  echo base_url() ?>css_scripts/vendor/datatables/images/test.png" width="200" height="150" class="img-circle">
  </head>
  <body>
    <h4>Account Confirmation</h4>
    <p style="text-align:justify;">Dear User, your account to University of World Mission Frontier has been Successfully Created
      <a href="<?php echo base_url()?>index.php/Adminuser/backaccount">click here </a>to Confirm Account with your Username and Password or open the link below into your browser.</br>
    </p>
    <p>
      <?php echo base_url()."index.php/Adminuser/backaccount";
      ?>
    </p>
    <p>Regards,</p>
    <p>University of World Mission Frontier</p>
  </body>
</html>
