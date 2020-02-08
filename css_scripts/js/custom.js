$(function(){
  $("#program_err_msg").hide();
  $("#password_err_msg").hide();
  $("#retypepassword_err_msg").hide();
  $("#email_err_msg").hide();
  var err_password=false;
  var err_retype_password=false;
  var err_email=false;
  var err_program=false;
  $("#CandidateEmail").focusout(function(){
    check_email();
  });
  $("#CandidatePassword").focusout(function(){
    check_password();
  });
  $("#CandidatePasswordConf").focusout(function(){
    check_passwordconfirm();
  });

  $("#program").focusout(function(){
    check_program();
  });
  //function definition for email
  function check_email() {
    var email_length=$("#CandidateEmail").val().length;
    if (email_length==0) {
      $("#email_err_msg").html("Enter email address");
      $("#email_err_msg").show();
      err_email=true;
    }else {
      $("#email_err_msg").hide();
    }
  }
  //function definition for password
  function check_password(){
    var password_length=$("#CandidatePassword").val().length;
    if (password_length==0) {
      $("#password_err_msg").html("Enter password");
      $("#password_err_msg").show();
      err_password=true;
    }else {
      $("#password_err_msg").hide();
    }
  }
  //function definition for Confirm password
  function check_passwordconfirm() {
    var password=$("#CandidatePassword").val();
    var retypepassword=$("#CandidatePasswordConf").val();
    if (password!=retypepassword) {
      $("#retypepassword_err_msg").html("Passwords do not match");
      $("#retypepassword_err_msg").show();
      err_retype_password=true;
    }else {
      $("#retypepassword_err_msg").hide();
    }
  }
  //function to check program
  function check_program() {
    var inputProgram=$("#program").val();
    var inputText=$("#program option:selected").text();
    if (inputProgram==0) {
      $("#program_err_msg").html('Select a program to study');
      $("#program_err_msg").show();
      err_program=true;
    }else {
      $("#program_err_msg").hide();
    }
  }
  $("#userregistermain").submit(function(){
    err_password=false;
    err_retype_password=false;
    err_email=false;
    err_program=false;
    check_email();
    check_password();
    check_passwordconfirm();
    check_program();
    if (err_email==false) {
      if (err_password==false) {
        if (err_retype_password==false) {
          if (err_program==false) {
            return true;
          } else {
            return false;
          }
        } else {
          return false;
        }
      } else {
        return false;
      }
    } else {
      return false;
    }
  });
});
//user login
$(function(){
  function getuserinputs(){
    var usernameinput=$("#Useridname").val(); var passwordinput=$("#useridPassword").val();
    if (usernameinput!="" && passwordinput!="") {return true;} else {return false;}
  }
  $("#loginuser").submit(function(){
    var getsubmit=getuserinputs();
    if (getsubmit==true){return true;} else {$("#errorlogin").html("Please fill out all fields!");return false;}
  });
});
