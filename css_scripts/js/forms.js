$(function(){
  $("#error_fname").hide();$("#error_lname").hide();$("#error_email").hide();$("#error_telephone").hide();$("#error_idnumber").hide();
  $("#error_gender").hide();$("#error_date").hide();$("#error_nationality").hide();$("#error_province").hide();$("#error_district").hide();
  $("#error_address").hide();$("#error_branch").hide();$("#error_english").hide();$("#error_native").hide();$("#error_level").hide();
  $("#error_fieldstudy").hide();$("#error_graduatedate").hide();$("#error_schoolname").hide();$("#error_schoollocation").hide();$("#error_degree").hide();
// error variables
  var error_fname=false;var error_lname=false;var error_email=false;var error_telephone=false;var error_idnumber=false;var error_gender=false;
  var error_date=false;var error_nationality=false;var error_province=false;var error_district=false;var error_address=false;
  var error_branch=false;var error_english=false;var error_native=false;var error_level=false;var error_fieldstudy=false;
  var error_graduatedate=false;var error_schoolname=false;var error_schoollocation=false;var error_degree=false;
//bind events to form elements
  //$("#CandidateEmail").prop("disabled",true);
  $("#CandidateFname").focusout(function(){check_firstname();});
  $("#CandidateLname").focusout(function(){check_lastname();});
  $("#CandidatePhone").focusout(function(){check_telephone();});
  $("#CandidateIDnumber").focusout(function(){check_passport();});
  $("#CandidateGender").focusout(function(){check_gender();});
  $("#CandidateBirthDate").focusout(function(){check_date();});
  $("#CandidateNationality").focusout(function(){check_nationality();});
  $("#CandidateProvince").focusout(function(){check_pro();});
  $("#CandidateDistrict").focusout(function(){check_dist();});
  $("#candidateaddress").focusout(function(){check_address()});
  $("#Candidatebranch").focusout(function(){check_branch();});
  $("#Candidateenglish").focusout(function(){check_english()});
  $("#CandidateNative").focusout(function(){check_native()});
  $("#Candidatestudy").focusout(function(){check_studylevel()});
  $("#candidatemajor").focusout(function(){check_subject()});
  $("#candidategraduation").focusout(function(){check_graduateDate();});
  $("#candidateschool").focusout(function(){check_school();});
  $("#candidatelocation").focusout(function(){check_schoollocation();});
  $("#studydegree").focusout(function(){check_degree();});
  function testvalue(value) {
    var splitvalues=value.split("");
    var regex =new RegExp(/^([a-zA-Z]{1})$/i);
    var sparegex=new RegExp(/^[\s]$/i);
    var errs=0; //no errors
    for (var i = 0; i < splitvalues.length; i++) {
      if (regex.test(splitvalues[i])==true ||sparegex.test(splitvalues[i])==true) {
        errs=errs+0;
      }else {
        errs=errs+1;
      }
    }
    return errs;
  }
  //validate firstname
  function check_firstname() {
    var fname_length=$("#CandidateFname").val().length;
    var data=$("#CandidateFname").val();
    var result=testvalue(data);
    if (fname_length!=0) {
      if (result>0) {
        $("#error_fname").html("Enter valid name");
        $("#error_fname").show()
        $("#error_fname").addClass("spanclass");
        error_fname=true;
      }else {
        $("#error_fname").hide();
      }
    }else {
      $("#error_fname").html("Enter valid name");
      $("#error_fname").show()
      $("#error_fname").addClass("spanclass");
      error_fname=true;
      }
    }
//validate lastname
function check_lastname() {
  var lname_length=$("#CandidateLname").val().length;
  var data=$("#CandidateLname").val();
  var result=testvalue(data);
  if (lname_length!=0) {
    if (result>0) {
      $("#error_lname").html("Enter valid name");
      $("#error_lname").show();
      $("#error_lname").addClass("spanclass");
      error_lname=true;
    }else {
      $("#error_lname").hide();
    }
  }else {
    $("#error_lname").html("Enter valid name");
    $("#error_lname").show();
    $("#error_lname").addClass("spanclass");
    error_lname=true;
  }
}
//validate telephone
function check_telephone() {
  var telephone_length=$("#CandidatePhone").val().length;
  var regex =new RegExp(/^[0-9]{10}$/i);
  var data=$("#CandidatePhone").val();
  var result=regex.test(data);
  if (telephone_length<10) {
    $("#error_telephone").html("Enter valid telephone number");
    $("#error_telephone").show();
    $("#error_telephone").addClass("spanclass");
    error_telephone=true;
  }else {
    $("#error_telephone").hide();
  }
}
//check passport
function check_passport() {
var passport_length=$("#CandidateIDnumber").val().length;
if (passport_length==0 || passport_length<5) {
  $("#error_idnumber").html("Enter your valid ID or Passport number");
  $("#error_idnumber").show();
  $("#error_idnumber").addClass("spanclass");
  error_idnumber=true;
}else {
  $("#error_idnumber").hide();
}
}
//check gender selection
function check_gender(){
  var gender=$("#CandidateGender").val();
  var regex =new RegExp(/^[a-zA-Z]{4,6}$/i);
  var data=$("#CandidateGender").val();
  var result=regex.test(data);
  if (gender!=0) {
    if (result==false) {
      $("#error_gender").html("Select gender");
      $("#error_gender").show();
      $("#error_gender").addClass('spanclass');
      error_gender=true;
    }else {
      $("#error_gender").hide();
    }
  }else {
    $("#error_gender").html("Select gender");
    $("#error_gender").show();
    $("#error_gender").addClass('spanclass');
    error_gender=true;
  }
}
//function to check valid date
function check_date() {
  var date_lenght=$("#CandidateBirthDate").val().length;
  var date=$("#CandidateBirthDate").val();
  var regex =new RegExp(/^((19[4-9][0-9])|(200[0-5]))\-((0[1-9])|(1[0-2]))\-((0[1-9])|(1[0-9])|(2[0-9])|(3[0-1]))$/i);
  var result = regex.test(date);
  var datepart=date.split('-');
  if (datepart[0]<=2005 || datepart[0]>=1940) {
    if (date_lenght==0 || result==false) {
      $("#error_date").html("Enter valid date ");
      $("#error_date").show();
      $("#error_date").addClass('spanclass');
      error_date=true;
    }else {
      $("#error_date").hide();
    }
  } else {
    $("#error_date").html("Enter valid date ");
    $("#error_date").show();
    $("#error_date").addClass('spanclass');
    error_date=true;
  }
}
//function to check nationality input
function check_nationality(){
  var nationality=$("#CandidateNationality").val().length;
  var regex =new RegExp(/^[a-zA-Z]{4,}$/i);
  var data=$("#CandidateNationality").val();
  var result=regex.test(data);
  if (nationality!=0) {
    if (result==false) {
      $("#error_nationality").html('Enter your valid nationality');
      $("#error_nationality").show();
      $("#error_nationality").addClass('spanclass');
      error_nationality=true;
    }else {
      $("#error_nationality").hide();
    }
  }else {
    $("#error_nationality").html('Enter your valid nationality');
    $("#error_nationality").show();
    $("#error_nationality").addClass('spanclass');
    error_nationality=true;
  }
}
//check Province input
function check_pro(){
var input_pro=$("#CandidateProvince").val().length;
var regex =new RegExp(/^[a-zA-Z]{4,}$/i);
var data=$("#CandidateProvince").val();
var result=regex.test(data);
if (input_pro!=0) {
  if (result==false) {
    $("#error_province").html('Enter valid provice/city of birth');
    $("#error_province").show();
    $("#error_province").addClass('spanclass');
    error_province=true;
  }else {
    $("#error_province").hide();
  }
}else {
  $("#error_province").html('Enter valid provice/city of birth');
  $("#error_province").show();
  $("#error_province").addClass('spanclass');
  error_province=true;
}
}
//check district input
function check_dist() {
  var input_dist=$("#CandidateDistrict").val().length;
  var regex =new RegExp(/^[a-zA-Z]{4,}$/i);
  var data=$("#CandidateDistrict").val();
  var result=regex.test(data);
  if (input_dist!=0) {
    if (result==false) {
      $("#error_district").html("Please enter valid district");
      $("#error_district").show();
      $("#error_district").addClass('spanclass');
      error_district=true;
    }else {
      $("#error_district").hide();
    }
  }else {
    $("#error_district").html("Please enter valid district");
    $("#error_district").show();
    $("#error_district").addClass('spanclass');
    error_district=true;
  }
}
//check address
function check_address(){
  var address=$("#candidateaddress").val().length;
  var regex =new RegExp(/^[a-zA-Z]{4,}$/i);
  var data=$("#candidateaddress").val();
  var result=regex.test(data);
  if (address!=0) {
    if (result==false && data.indexOf("/")==-1) {
      $("#error_address").html('Enter Current address');
      $("#error_address").show();
      $("#error_address").addClass('spanclass');
      error_address=true;
    }else {
      $("#error_address").hide();
    }
  }else {
    $("#error_address").html('Enter Current address');
    $("#error_address").show();
    $("#error_address").addClass('spanclass');
    error_address=true;
  }
}
//check branch
function check_branch(){
  var gender=$("#Candidatebranch").val().length;
  var regex =new RegExp(/^[a-zA-Z]{3,}$/i);
  var data=$("#Candidatebranch").val();
  var result=regex.test(data);
  if (gender!=0) {
    if (result==false) {
      $("#error_branch").html("Select Branch to attend");
      $("#error_branch").show();
      $("#error_branch").addClass('spanclass');
      error_gender=true;
    }else {
      $("#error_branch").hide();
    }
  }else {
    $("#error_branch").html("Select Branch to attend");
    $("#error_branch").show();
    $("#error_branch").addClass('spanclass');
    error_gender=true;
  }
}
//check english level
function check_english(){
  var engl=$("#Candidateenglish").val().length;
  var data=$("#Candidateenglish").val();
  var result=testvalue(data);
  if (engl!=0) {
    if (result>0) {
      $("#error_english").html("Select level of english");
      $("#error_english").show();
      $("#error_english").addClass('spanclass');
      error_english=true;
    }else {
      $("#error_english").hide();
    }
  }else {
    $("#error_english").html("Select level of english");
    $("#error_english").show();
    $("#error_english").addClass('spanclass');
    error_english=true;
  }
}
//check native languages
function check_native() {
  var language=$("#CandidateNative").val().length;
  var regex =new RegExp(/^[a-zA-Z]{4,}$/i);
  var data=$("#CandidateNative").val();
  var result=regex.test(data);
  if (language!=0) {
    if (result==false) {
      $("#error_native").html('Enter native language');
      $("#error_native").show();
      $("#error_native").addClass('spanclass');
      error_native=true;
    }else {
      $("#error_native").hide();
    }
  }else {
    $("#error_native").html('Enter native language');
    $("#error_native").show();
    $("#error_native").addClass('spanclass');
    error_native=true;
  }
}
//check study level
function check_studylevel(){
  var studyLevel=$("#Candidatestudy").val().length;
  if (studyLevel==0) {
    $("#error_level").html("Select study level");
    $("#error_level").show();
    $("#error_level").addClass('spanclass');
    error_level=true;
  }else {
    $("#error_level").hide();
  }
}
//check subject/major field
function check_subject() {
  $subject=$("#candidatemajor").val().length;
  var data=$("#candidatemajor").val();
  var result=testvalue(data);
  if ($subject!=0) {
    if (result>0) {
      $("#error_fieldstudy").html('Enter subject/field of study');
      $("#error_fieldstudy").show();
      $("#error_fieldstudy").addClass('spanclass');
      error_fieldstudy=true;
    }else {
    $("#error_fieldstudy").hide();
    }
  }else {
    $("#error_fieldstudy").html('Enter subject/field of study');
    $("#error_fieldstudy").show();
    $("#error_fieldstudy").addClass('spanclass');
    error_fieldstudy=true;
  }
}
//check graduation date
function check_graduateDate(){
  var datelen=$("#candidategraduation").val().length;
  var date=$("#candidategraduation").val();
  var regex =new RegExp(/^((19[7-9][0-9])|(200[0-9])|(201[0-9])|(202[0-9]))\-((0[1-9])|(1[0-2]))\-((0[1-9])|(1[0-9])|(2[0-9])|(3[0-1]))$/i);
  var result = regex.test(date);
  if (datelen==0 || result==false) {
    $("#error_graduatedate").html("Enter valid graduation date");
    $("#error_graduatedate").show();
    $("#error_graduatedate").addClass('spanclass');
    error_graduatedate=true;
  }else {
    $("#error_graduatedate").hide();
  }
}
//check school name
function check_school() {
  var inputschool=$("#candidateschool").val().length;
  var data=$("#candidateschool").val();
  var result=testvalue(data);
  if (inputschool!=0) {
    if (result>0) {
      $('#error_schoolname').html("Enter graduate College/University");
      $("#error_schoolname").show();
      $("#error_schoolname").addClass('spanclass');
      error_schoolname=true;
    }else {
      $("#error_schoolname").hide();
    }
  }else {
    $('#error_schoolname').html("Enter graduate College/University");
    $("#error_schoolname").show();
    $("#error_schoolname").addClass('spanclass');
    error_schoolname=true;
  }
}
//check school location
function check_schoollocation(){
  var school_length=$("#candidatelocation").val().length;
  if (school_length==0) {
    $("#error_schoollocation").html("Enter location of the school");
    $("#error_schoollocation").show();
    $("#error_schoollocation").addClass('spanclass');
    var error_schoolname=true;
  }else {
    //var error_schoolname=false;
    $("#error_schoollocation").hide();
  }
}
//check degree selection
function check_degree() {
  var input_degree=$("#studydegree").val().length;
  var regex =new RegExp(/^[a-zA-Z]{4,}$/i);
  var data=$("#studydegree").val();
  var result=regex.test(data);
  if (input_degree==0) {
    $("#error_degree").html("Select degree awarded");
    $("#error_degree").show();
    $("#error_degree").addClass("spanclass");
    error_degree=true;
  }else {
    $("#error_degree").hide();
  }
}
function submitform() {
  error_fname=false;error_lname=false;error_email=false;error_telephone=false;error_idnumber=false;error_gender=false;
  error_date=false;error_nationality=false;error_province=false;error_district=false;error_address=false;error_branch=false;
  error_english=false;error_native=false;error_level=false;error_graduatedate=false;
  error_fieldstudy=false;error_schoolname=false;error_schoollocation=false;error_degree=false;
  check_firstname();check_lastname();check_telephone();check_passport();check_gender();check_degree();
  check_date();check_nationality();check_pro();check_dist();check_address();check_branch();check_schoollocation();
  check_english();check_native();check_studylevel();check_subject();check_graduateDate();check_school();
  var errors=[error_fname,
  error_lname,
  error_email,
  error_telephone,
  error_idnumber,
  error_gender,
  error_date,
  error_nationality,
  error_province,
  error_district,
  error_address,
  error_branch,
  error_english,
  error_native,
  error_level,
  error_graduatedate,
  error_fieldstudy,
  error_schoolname,
  error_schoollocation,
  error_degree];
  var checkerrors=0;
  for (var i = 0; i < errors.length; i++) {
    if (errors[i]==true) {
      checkerrors+=1;
    }
  }
  if (checkerrors==0) {
    return true;
  }else {
    return false;
  }
}
$("#userapplicationmain").submit(function(){
  var result=submitform();
  if (result==true) {
    return true;
  }else {
    return false;
  }
});
});
