$(function() {
var error_company=false;
var error_position=false;
var error_startdate=false;
var error_workprovince=false;
var error_district=false;
$("#error_company").hide();
$("#error_position").hide();
$("#error_startdate").hide();
$("#error_workprovince").hide();
$("#error_district").hide();

$("#workcompany").focusout(function(){
  check_companywork();
});
$("#workposition").focusout(function(){
  check_positionname();
});
$("#worklocation").focusout(function(){
  check_workaddress();
});
$("#startworkdate").focusout(function(){
  check_workpositiondate();
});
$("#workcitylocation").focusout(function(){
  check_worklocation();
});
//function to check Company input
function check_companywork() {
  var error_company=$("#workcompany").val().length;
  if (error_company==0) {
    $("#error_company").html("Enter Company/Institution name");
    $("#error_company").show();
    $("#error_company").addClass('spanclass');
    error_company=true;
  }else {
    $("#error_company").hide();
  }
}
//check position input
function check_positionname() {
  var error_position=$("#workposition").val().length;
  if (error_position==0) {
    $("#error_position").html("Enter Position in the Company/Institution");
    $("#error_position").show();
    $("#error_position").addClass('spanclass');
    error_church=true;
  }else {
    $("#error_position").hide();
  }
}
//check church address
function check_workaddress(){
  var addressinput=$("#worklocation").val().length;
  if (addressinput==0) {
    $("#error_workprovince").html("Enter valid location of Company/Institution");
    $("#error_workprovince").show();
    $("#error_workprovince").addClass('spanclass');
    error_workprovince=true;
  }else {
    $("#error_workprovince").hide();
  }
}
//check district
function check_worklocation() {
  var input=$("#workcitylocation").val().length;
  if (input==0) {
    $("#error_district").html("Enter valid district location of the Company");
    $("#error_district").show();
    $("#error_district").addClass('spanclass');
    error_district=true;
  }else {
    $("#error_district").hide();
  }
}

//check position start date
function check_workpositiondate() {
  var inputstartdate=$("#startworkdate").val().length;
  var date=inputstartdate=$("#startworkdate").val();
  var regex =new RegExp(/((19[7-9][0-9])|(200[0-9])|(201[0-9])|(202[0-9]))\-((0[1-9])|(1[0-2]))\-((0[1-9])|(1[0-9])|(2[0-9])|(3[0-1]))/);
  var result = regex.test(date);
  if (inputstartdate==0 ||result==false) {
    $("#error_startdate").html("Enter position start date");
    $("#error_startdate").show();
    $("#error_startdate").addClass('spanclass');
    error_startdate=true;
  }else {
    $("#error_startdate").hide();
  }
}

//submit button
$("#userapplicationexperience").submit(function(){
  error_company=false;error_position=false;error_startdate=false;error_workprovince=false;error_district=false;
  check_companywork();
  check_positionname();
  check_workaddress();
  check_workpositiondate();
  check_worklocation();
  if (error_company==false) {
    if (error_position==false) {
      if (error_startdate==false) {
        if (error_workprovince==false) {
          if (error_district==false) {
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
  } else {
    return false;
  }
});
});
