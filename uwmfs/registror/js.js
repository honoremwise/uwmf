$(document).ready(function() {


	//Change in continent dropdown list will trigger this function and
	//generate dropdown options for county dropdown
	$(document).on('change','#continent', function() {
		var continent_id = $(this).val();
		if(continent_id != "") {
			$.ajax({
				url:"get_data.php",
				type:'POST',
				data:{continent_id:continent_id},
				success:function(response) {
					//var resp = $.trim(response);
					if(response != '') {
						$("#country").removeAttr('disabled','disabled').html(response);
						$("#state").attr('disabled','disabled').html("<option value=''>------- Select --------</option>");
					} else {
						$("#country, #state, #city").attr('disabled','disabled').html("<option value=''>------- Select --------</option>");
					}
				}
			});
		} else {
			$("#country, #state, #city").attr('disabled','disabled').html("<option value=''>------- Select --------</option>");
		}
	});


	//Change in coutry dropdown list will trigger this function and
	//generate dropdown options for state dropdown
	$(document).on('change','#country', function() {
		var country_id = $(this).val();
		if(country_id != "") {
			$.ajax({
				url:"get_data.php",
				type:'POST',
				data:{country_id:country_id},
				success:function(response) {
					//var resp = $.trim(response);
					if(response != '') $("#state").removeAttr('disabled','disabled').html(response);
					else $("#state, #city").attr('disabled','disabled').html("<option value=''>------- Select --------</option>");
				}
			});
		} else {
			$("#state, #city").attr('disabled','disabled').html("<option value=''>------- Select --------</option>");
		}
	});



	//Change in state dropdown list will trigger this function and
	//generate dropdown options for city dropdown
	$(document).on('change','#state', function() {
		var state_id = $(this).val();
		if(state_id != "") {
			$.ajax({
				url:"get_data.php",
				type:'POST',
				data:{state_id:state_id},
				success:function(response) {
					if(response != '') $("#city").removeAttr('disabled','disabled').html(response);
					else $("#city").attr('disabled','disabled').html("<option value=''>------- Select --------</option>");
				}
			});
		} else {
			$("#city").attr('disabled','disabled').html("<option value=''>------- Select --------</option>");
		}
	});


});
function validation(){
    var program=doucment.getElementById(levels).value;
    var level=document.getElementById(program).value;
    if((program=="MASTERS" && level>2) or program=="MASTERS" && level>2 )
        {
            alert("for masters it is only 2 academic years");
            
        }
    if(program=="Certificate" >1)
        {
            
        }
    
    
}