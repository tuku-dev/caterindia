var hostname = $(location).attr('origin') + "/caterindia/";
$('#plus').click(function () {
	var rating = $("#rating").val();
	if(rating <5){
	$("#rating").val(parseInt(rating) + parseInt(1));
	}	
});
$('.minus').click(function () {
    var rating = $("#rating").val();
	if(rating > 1){
	$("#rating").val(parseInt(rating) - parseInt(1));
	}
});

function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}

$('#__category_div').hide();
$('#__subcategory_div').hide();
function select_Restaurant(id){
    if(id!=""){
	 $.ajax({
        type: "POST",
        url: hostname + "findCategory",
        data: 'id=' + id,
        dataType: "JSON",
		beforeSend: function () {
             $("#load").css('display', 'block');
       	},
        success: function(data) {
            if(data!=0){
                setTimeout(function(){ $("#load").css('display', 'none');},500);
                var _data = data.category;
				$('#category_name').empty().append('<option value="">Select Category...</option>');
                $.each(_data, function(key,val){
                    $('#category_name').append($("<option/>", {
                        value: val.category_id,
                        text: val.category_name
                    }));
                });
    			$("#__category_div").show(500)
			}else {
				$("#__category_div").hide(500)
				setTimeout(function(){ $("#load").css('display', 'none');},500);
				}
			
        }
    })
    }else{
        $('#category_name').empty().append('<option value="">Select Category...</option>');
        $('#subcategory_id').empty().append('<option value="">Select Subcategory...</option>');
    }
}

function select_Category(id){
	 $.ajax({
        type: "POST",
        url: hostname + "findSubcategory",
        data: 'id=' + id,
        dataType: "JSON",
		beforeSend: function () {
             $("#load").css('display', 'block');
       	},
        success: function(data) {
            if(data!=0){
                setTimeout(function(){ $("#load").css('display', 'none');},500);
                var _data = data.subcategory;
				$('#subcategory_id').empty().append('<option value="0">Select Subcategory...</option>');
                $.each(_data, function(key,val){
                    $('#subcategory_id').append($("<option/>", {
                        value: val.sub_caid,
                        text: val.subcategory_name
                    }));
                });
    			$("#__subcategory_div").show(500)
			}else {
				$("#__subcategory_div").hide(500)
				setTimeout(function(){ $("#load").css('display', 'none');},500);
				}
			
        }
    })
}