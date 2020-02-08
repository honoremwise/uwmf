//page forms validation
$(document).ready(function(){
  function validateform() {
    //add category form validation
    var bookcode=$("#idbookcode").val();
    var bookname=$("#codebookname").val();
    var elements=[bookcode,bookname];
    var tests=[];
    for (var i = 0; i < elements.length; i++) {
      //check for empty values
      if (elements[i].length>0){
        continue;
      }else{
        tests[i]=false;
      }
    }
    if (tests.length>0) {
      return false;
    } else {
      return true;
    }
  } //validate category form
  $("#formbookcategory").submit(function () {
    var result=validateform();
    if (result==true){
      return true;
    } else {
      $("#forminputs").html("Please input all required fields");
      $("#forminputs").addClass("addstyle");
      return false;
    }
  });
  function getbookvalidation(){
    var bookcategory=$("#libcatenameid").val();var bookname=$("#libookname").val();var author=$("#bookwriterid").val();
    var version=$("#bookversionid").val();var price=$("#priceid").val();var currency=$("#pricecurrencyid").val();
    //check for empty data in the inputs
    var element=[bookcategory,bookname,author,version,price,currency];
    var tests=[];
    for (var i = 0; i < element.length; i++) {
      if (element[i].length>0 && element[i]!=''){
        continue;
      } else {
        tests[i]=false;
      }
    }
    if (tests.length>0){
      return false;
    } else {
      return true;
    }
  }
  //validate books input
  $("#forminputsbook").submit(function(){
    var result=getbookvalidation();
    if (result==true) {
      return true;
    } else {
      $("#forminput").html("Please input all required fields");
      $("#forminput").addClass("addstyle");
      return false;
    }
  });
  //validate borrow book form
  function getborrowvalidate(){
    var bookcode=$("#bookid").val(); var student=$("#studentregno").val(); var dateback=$("#datereturnid").val();
    var elements=[bookcode,student,dateback];
    var tests=[];
    for (var i = 0; i < elements.length; i++) {
      if (elements[i].length>0) {
        continue;
      } else {
        tests[i]=false;
      }
    }
    if (tests.length>0){
      return false;
    } else {
      return true;
    }
  }
  $("#addborrowform").submit(function(){
    var result=getborrowvalidate();
    if (result==true){
      return true;
    }else {
      $("#formerror").html("Please input all required fields");
      $("#formerror").addClass("addstyle");
      return false;
    }
  });
  //return books;
  $("#formreturnbook").submit(function(){
    var book=$("#returnbookcode").val(); var studentid=$("#bookstudentid").val();if (book!="" && studentid!="") {
      return true;
    } else {
      $("#returninput").html("Please input all required fields");
      $("#returninput").addClass("addstyle");
      return false;
    }
  });
  //lost book
  $("#formlostbook").submit(function(){
    var lostbook=$("#booklostid").val(); var student=$("#studentlostid").val();if(lostbook!="" && student!=""){
      return true;
    } else {
      $("#declarelostinput").html("Please input all required fields");
      $("#declarelostinput").addClass("addstyle");
      return false;
    }
  });
});
