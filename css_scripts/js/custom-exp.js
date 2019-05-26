$(function() {
var error_denomination=false;var error_church=false;var error_churchaddress=false;var error_churchphone=false;
var error_pastor=false;var error_churchexp=false;error_churchposition=false;var error_positiondate=false;
var error_churchprovince=false;var error_churchdistrict=false;
$("#error_denomination").hide();
$("#error_church").hide();
$("#error_churchaddress").hide();
$("#error_churchphone").hide();
$("#error_error_pastor").hide();
$("#error_churchexp").hide();
$("#error_churchposition").hide();
$("#error_error_positiondate").hide();
$("#error_churchprovince").hide();
$("#error_churchdistrict").hide();

$("#candidatedenomination").focusout(function(){
  check_denomination();
});
$("#candidatechurch").focusout(function(){
  check_churchname();
});
$("#churchaddress").focusout(function(){
  check_churchaddress();
});
$("#contactPhone").focusout(function(){
  check_churchphone();
});
$("#pastorName").focusout(function(){
  check_churchpastorName();
});
$("#experiencechurch").focusout(function(){
  check_churchexperience();
});
$("#churchposition").focusout(function(){
  check_churchposition();
});
$("#startdate").focusout(function(){
  check_churchpositiondate();
});
$("#statelocation").focusout(function(){
  check_churchlocationstate();
});
$("#citylocation").focusout(function(){
  check_churchlocationcity();
});
//function to check denomination input
function check_denomination() {
  var denominationinput=$("#candidatedenomination").val().length;
  if (denominationinput==0) {
    $("#error_denomination").html("Enter church denomination");
    $("#error_denomination").show();
    $("#error_denomination").addClass('spanclass');
    error_denomination=true;
  }else {
    $("#error_denomination").hide();
  }
}
//check church input
function check_churchname() {
  var churchinput=$("#candidatechurch").val().length;
  if (churchinput==0) {
    $("#error_church").html("Enter church name");
    $("#error_church").show();
    $("#error_church").addClass('spanclass');
    error_church=true;
  }else {
    $("#error_church").hide();
  }
}
//check church address
function check_churchaddress(){
  var addressinput=$("#churchaddress").val().length;
  if (addressinput==0) {
    $("#error_churchaddress").html("Enter valid location of the church");
    $("#error_churchaddress").show();
    $("#error_churchaddress").addClass('spanclass');
    error_churchaddress=true;
  }else {
    $("#error_churchaddress").hide();
  }
}
//cehck contact telephone
function check_churchphone() {
  var phoneinput=$("#contactPhone").val().length;
  if (phoneinput<10) {
    $("#error_churchphone").html("Enter valid contact telephone number of the church");
    $("#error_churchphone").show();
    $("#error_churchphone").addClass('spanclass');
    error_churchphone=true;
  }else {
    $("#error_churchphone").hide();
  }
}
//check for input of church pastor
function check_churchpastorName(){
  var namepastor=$("#pastorName").val().length;
  if (namepastor==0) {
    $("#error_pastor").html("Enter name of the church Pastor");
    $("#error_pastor").show();
    $("#error_pastor").addClass('spanclass');
    error_pastor=true;
  }else {
    $("#error_pastor").hide();
  }
}
//check experience in church
function check_churchexperience() {
  var experienceinput=$("#experiencechurch").val().length;
  if (experienceinput==0) {
    $("#error_churchexp").html("Enter church name you worked with");
    $("#error_churchexp").show();
    $("#error_churchexp").addClass('spanclass');
    error_churchexp=true;
  }else {
    $("#error_churchexp").hide();
  }
}
//check position in the church
function check_churchposition(){
  var inputposition=$("#churchposition").val(),length;
  if (inputposition==0) {
    $("#error_churchposition").html("Enter position you have/had in the church");
    $("#error_churchposition").show();
    $("#error_churchposition").addClass('spanclass');
    error_churchposition=true;
  }else {
    $("#error_churchposition").hide();
  }
}
//check position start date
function check_churchpositiondate() {
  var inputstartdate=$("#startdate").val().length;
  var date=inputstartdate=$("#startdate").val();
  var regex =new RegExp(/((19[7-9][0-9])|(200[0-9])|(201[0-9])|(202[0-9]))\-((0[1-9])|(1[0-2]))\-((0[1-9])|(1[0-9])|(2[0-9])|(3[0-1]))/);
  var result = regex.test(date);
  if (inputstartdate==0 ||result==false) {
    $("#error_positiondate").html("Enter position start date");
    $("#error_positiondate").show();
    $("#error_positiondate").addClass('spanclass');
    error_positiondate=true;
  }else {
    $("#error_positiondate").hide();
  }
}
//check church province
function check_churchlocationstate(){
  var inputstate=$("#statelocation").val().length;
  if (inputstate==0) {
    $("#error_churchprovince").html("Enter province location of the church");
    $("#error_churchprovince").show();
    $("#error_churchprovince").addClass('spanclass');
    error_churchprovince=true;
  }else {
    $("#error_churchprovince").hide();
  }
}
//check church district
function check_churchlocationcity(){
  var inputcity=$("#citylocation").val().length;
  if (inputcity==0) {
    $("#error_churchdistrict").html("Enter district location of the church");
    $("#error_churchdistrict").show();
    $("#error_churchdistrict").addClass('spanclass');
    error_churchdistrict=true;
  }else {
    $("#error_churchdistrict").hide();
  }
}
//submit button
$("#userchurchexperience").submit(function(){
  error_denomination=false;error_church=false; error_churchaddress=false; error_churchphone=false;
  error_pastor=false;error_churchexp=false;error_churchposition=false;error_positiondate=false;
  error_churchprovince=false;error_churchdistrict=false;
  check_denomination();
  check_churchname();
  check_churchaddress();
  check_churchphone();
  check_churchpastorName();
  check_churchexperience();
  check_churchposition();
  check_churchpositiondate();
  check_churchlocationstate();
  check_churchlocationcity();
  if (error_denomination==false) {
    if (error_church==false) {
      if (error_churchaddress==false) {
        if (error_churchphone==false) {
          if (error_pastor==false) {
            if (error_churchexp==false) {
              if (error_churchposition==false) {
                if (error_positiondate==false) {
                  if (error_churchprovince==false) {
                    if (error_churchdistrict==false) {
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
  }else {
    return false;
  }
});
});
