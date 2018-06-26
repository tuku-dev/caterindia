/*****You know Trideep :) *******/
var hostname = $(location).attr('origin')+"/caterindia";
function validatephone(ph) {
	var maintainplus = '';
 	var numval = ph.value
 	if ( numval.charAt(0)=='+' ){ var maintainplus = '+';}
 	curphonevar = numval.replace(/[\\A-Za-z!"£$%^&*+_={};:'@#~,.¦\/<>?|`¬\]\[]/g,'');
 	ph.value = maintainplus + curphonevar;
 	var maintainplus = '';
 	ph.focus;
}


function validatePrice(e) {
	var maintainplus = '';
 	var numval = e.value
 	curphonevar = numval.replace(/[\\A-Za-z!"£$%^&*+_={};:'@#~,¦\/<>?|`¬\]\[]/g,'');
 	e.value = maintainplus + curphonevar;
 	var maintainplus = '';
 	e.focus;
}
//This function is for username  validation.space special character not allowed
//onKeyUp="checkUserName(this);"
function checkUserName(evt) {
	var maintainplus = '';
 	var numval = evt.value
 	if ( numval.charAt(0)=='+' ){ var maintainplus = '+';}
 	curuservar = numval.replace(/[^a-zA-Z0-9]/g,'');
 	evt.value = maintainplus + curuservar;
 	var maintainplus = '';
 	evt.focus;
}

//This function is for password  validation.space some special character are not allowed
//onKeyUp="checkPassword(this);"
function checkPassword(evt) {
	var maintainplus = '';
 	var numval = evt.value
 	if ( numval.charAt(0)=='+' ){ var maintainplus = '+';}
 	curuservar = numval.replace(/[^a-zA-Z0-9!@#$]/g,'');
 	evt.value = maintainplus + curuservar;
 	var maintainplus = '';
 	evt.focus;
}


function chk_xss(xss){
	var maintainplus = '';
	var numval = xss.value
	curphonevar = numval.replace(/[\\!"£$%^&*+_={};:'#~,.¦\/<>?|`¬\]\[]/g,'');
	xss.value = maintainplus + curphonevar;
	var maintainplus = '';
	xss.focus;
}
/*********News letter***********/
function newsletterValidation(){
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	if($("#news_ltr_email").val()==''){
		$("#news_ltr_email").addClass('error_class');
		$("#news_ltr_email").focus();
		return false;
	}else{
		$("#news_ltr_email").removeClass('error_class');
	}
	if(!($("#news_ltr_email").val()).match(emailExp)){
		$("#news_ltr_email").addClass('error_class');
		$("#news_ltr_email").focus();
		return false;
	}else{
		$("#news_ltr_email").focus();
	}
	postNewsLetterData();
}
function postNewsLetterData(){
	var url = hostname + "/save-nl-data";
	$.ajax({
		type: "GET",
		cache: false,
		url: url, // success.php
		data: {'news_ltr_email':$('#news_ltr_email').val()},
		success: function (data) {
			console.log(data);
			if(data==0){
				$("#nl_msg").css('color','#fff').html('Please enter valid email address.');
			}
			if(data==1){
				$("#nl_msg").css('color','#fff').html('You have already sybscribed to our news letter.');
			}
			if(data=='success'){
				$("#news_ltr_email").val('');
				$("#nl_msg").css('color','#fff').html('You have subscribed to our newsletter successfully.');
			}
	  }
  });
}
/******Conatct form validation*******/
function contactValidation(){
 if($('#cr').val() =='0'){
	  $('#cap_error').html('This field is required.');
	  return false;
  }
}
/******Datepicker******/
$(function () {
$('#datepicker').datepicker({
	dateFormat: 'dd-mm-yy',
	startDate: '-0m',
	endDate: '-1d',
	autoclose: true,
	clearBtn: true,
	todayHighlight: true
});
});

/*******Number event******/
function isNumber(evt) {
evt = (evt) ? evt : window.event;
var charCode = (evt.which) ? evt.which : evt.keyCode;
if (charCode > 31 && (charCode < 48 || charCode > 57)) {
	return false;
}
return true;
}

/******User Registration********/
$('#otp_verification').hide();
function registration(){
		var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
		var name = $('#full_name').val();
		var contact_no = $('#contact_no').val();
		var user_email = $('#user_email').val();
		var user_password = $('#user_psw').val();
		if(name == ""){
				$('#full_name').addClass('error_class');
				$('#full_name').focus();
				return false;
			}else{
				$('#full_name').removeClass('error_class');
				}
		if(contact_no == ""){
				$('#contact_no').addClass('error_class');
				$('#contact_no').focus();
				return false;
			}else{
				$('#contact_no').removeClass('error_class');
				}
		if(user_email == ""){
				$('#user_email').addClass('error_class');
				$('#user_email').focus();
				return false;
			}else{
				$('#user_email').removeClass('error_class');
				}
		if(!($('#user_email').val()).match(emailExp)){
			  $("#user_email").addClass('error_class');
			  $('#user_email').focus();
			  return false;
		}else{
			  $("#fgemail").removeClass('error_class');
		}
		if(user_password == ""){
				$('#user_psw').addClass('error_class');
				$('#user_psw').focus();
				return false;
			}else{
				$('#user_psw').removeClass('error_class');
				}
		var error = 0;
        if (!($('#terms').is(':checked'))) {
            error = 1
            alert("Please Tick the Agree to Terms of Use");
			return false;
        }
		userRegistration();
	}

function userRegistration(){
	var contact_no = $('#contact_no').val();
	$.ajax({
            type: "POST",
            url: hostname + "/user-registration",
            data: $('#user_Reg').serialize(),
            beforeSend: function () {
				$('#register').html("Please Wait...")
            },
            success: function (data) {
				if(data==1){
					$("#user_Reg").fadeOut("slow");
					$('#Reg_error').html("");
					$("#verify_mobile").val(contact_no);
					$("#otp_verification").fadeIn("slow");
				}else if(data==0){
					$('#Reg_error').html("Please enter all * marked controls values.");
					$('#register').html("Sign Up");
				}else if(data==2){
					$('#Reg_error').html("This mobile no already Registed.");
					$('#register').html("Sign Up");
				}else if(data==4){
					$('#Reg_error').html("Invalid Email address.");
					$('#register').html("Sign Up");
				}else if(data==5){
					$('#Reg_error').html("Invalid Mobile no.");
					$('#register').html("Sign Up");
				}else{
					$('#Reg_error').html("This email id already Registed.");
					$('#register').html("Sign Up");
					}
            }
        });
}

function otpVerify(){
		var otp = $("#otp").val();
		if(otp!=""){
			$.ajax({
            type: "POST",
            url: hostname + "/otp-varification",
            data: $('#otp_verification').serialize(),
            beforeSend: function () {
				$('#otp_verify').html("Please Wait...")
            },
            success: function (data) {
				if(data==1){
					$('#reg_heading').html("");
					$("#otp_verification").fadeOut("slow");
					$('#Reg_error').html("");
					$("#Reg_succ").html("Registration completed successfully...");
					setTimeout(function(){ window.location.href = "home"; }, 3000);
				}else{
				$('#Reg_succ').html("");
				$('#Reg_error').html("OTP not match.");
				$('#otp_verify').html("Verify OTP");
					}
            }
        });
		}else{
			$('#Reg_error').html("Enter your OTP.");
			$('#otp_verify').html("Verify OTP");
			}
	}

$(".resend").click(function(){
  $.ajax({
		type: "POST",
		url: hostname + "/resend-otp",
		success: function (data) {
			if(data==1){
				$('#otp').val("");
				$('#Reg_error').html("");
				$("#Reg_succ").html("A OTP has been send to your mobile no.");
			}
		}
     });
});
$(".forgot-password").hide();
$(".forgoten").click(function(){
	$(".form-login").hide('slow');
	$(".forgot-password").show('slow');
	});
	
$(".login-page").click(function(){
	$(".forgot-password").hide('slow');
	$(".form-login").show('slow');
	});

function userForgotValidation(){
	var phone = $("#phone").val();
	if(phone != ""){
		$.ajax({
            type: "POST",
            url: hostname + "/forgot-otp",
            data: $('#forgot-otp').serialize(),
            beforeSend: function () {
				$('#btn-forgot').html("Please Wait...")
            },
            success: function (data) {
				if(data==1){
					$('#phone').removeClass('error_class');
					$('#forgot_error').html("");
					$("#forgot_succ").html("OTP send your mobile number.");
					$("#forgot-otp").fadeOut("slow");
					$("#forgototp_verification").fadeIn();
					$("#forgototp_mobile").val(phone);
				}else{
				$('#forgot_error').html("Mobile number not registed.");
				$("#btn-forgot").html("Get Password");
					}
            }
        });
		}else{
		$('#phone').addClass('error_class');
		$('#phone').focus();
		return false;
	}
 }
$("#forgototp_verification").hide();
function otpverify_forgot(){
		var forgototp_confirm = $("#forgototp_confirm").val();
		if(forgototp_confirm!=""){
			$.ajax({
            type: "POST",
            url: hostname + "/otp-varification-changepassword",
            data: $('#forgototp_verification').serialize(),
            beforeSend: function () {
				$('#otp_verifyforgotbtn').html("Please Wait...")
            },
            success: function (data) {
				if(data==1){
					$('#forgot_error').html("");
					$(".forgot-password").fadeOut("slow");
					$(".change-passworddiv").fadeIn("slow");
				}else{
				$('#forgot_succ').html("");
				$('#forgot_error').html("OTP not match.");
				$('#otp_verifyforgotbtn').html("Verify OTP");
					}
            }
        });
		}else{
			$('#forgot_error').html("Enter your OTP.");
			$('#otp_verifyforgotbtn').html("Verify OTP");
			}
	
	}
	
$(".change-passworddiv").hide();
function userChangepassword(){
	var password = $("#password").val();
	var repeat_password = $("#repeat_password").val();
	if(password == ""){
		$('#password').addClass('error_class');
		$('#password').focus();
		return false;
		}else {
		$('#password').removeClass('error_class');
		}
	if(repeat_password == ""){
		$('#repeat_password').addClass('error_class');
		$('#repeat_password').focus();
		return false;
		}else {
		$('#repeat_password').removeClass('error_class');
		}
	if(password != repeat_password){
		$("#chgpass_error").html("Password and Reapeat password is not match!");
		$("#btn-changepass").html("Change Password");
		}
	if(password != "" && repeat_password !=""){
		$.ajax({
            type: "POST",
            url: hostname + "/change-password",
            data: $('#change-password').serialize(),
            beforeSend: function () {
				$('#btn-changepass').html("Please Wait...")
            },
            success: function (data) {
				if(data==1){
					$('#chgpass_error').html("");
					$("#chgpass_succ").html("Your password was successfully changed.");
					$('#change-password')[0].reset();
					setTimeout(function(){ window.location.href = "home"; }, 3000);
				}else{
				$('#chgpass_error').html("Password and Reapeat password is not match!");
				$("#btn-changepass").html("Change Password");
					}
            }
        });
		}
	}

$(document).ready(function(){
	$("#location").keyup(function(){
		var that = this,
        value = $(this).val();
        
		$.ajax({
		type: "POST",
		url: hostname + "/searchArea",
		data:{
                'keyword' : value
            },
		beforeSend: function(){
			$("#location").css("background","#FFF url('public/images/Disk.gif') no-repeat 92%");
		},
		success: function(data){
			$("#area").show();
			$("#area").html(data);
			$("#location").css("background","#FFF");
		}
		});
	});
});

function selectCountry(val) {
$("#location").val(val);
$("#area").hide();
$("._3iFC5").html("<img src= " + hostname + "/public/images/Rolling.gif />");
setTimeout(function(){window.location.href = hostname + "/restaurants/" + val; }, 2000);
}


/**************Add to cart**************/
$(document.body).on('click', '#pro-add-to-cart', function() {
	var prdid = $(this).data('id');
	var img = $("#img_"+prdid).val();
	var name = $("#name_"+prdid).val();
	var price = $("#price_"+prdid).val();
	var desc = $("#desc_"+prdid).val();
	var qnty = $("#qnty_"+prdid).val();
	var type = $("#type_"+prdid).val();
 	var category = $("#category_"+prdid).val();
 	var subcategory = $("#subcategory_"+prdid).val();
 	var rest = $("#rest_"+prdid).val();
	
	$.ajax({
		type: "POST",
		url: hostname + "/add_cart",
		dataType: 'json',
		data: "prdid="+prdid+"&img="+img+"&name="+name+"&price="+price+"&desc="+desc+"&qnty="+qnty+"&type="+type+"&category="+category+"&subcategory="+subcategory+"&rest="+rest,
		success: function(data) {
			if(data["resp"]=="success")
			{
				$("#crt-count").html(data["quantity"]);
				//alert(data["resptopdyn"]);
				$("#displaytopcart").html(data["resptopdyn"]);
				//$("#cart_"+prdid).html('<i class="fa fa-check"></i> Added Successfully');
				//$("#cart_"+prdid).show();
				//setTimeout(function() { $("#cart_"+prdid).fadeOut(); }, 3000);
				$("#productsadded").html('<div class="add-cart"><div class="add-cart-txticon"> <i class="fa fa-check"></i></div><div class=" add-cart-txt"> Products Added Successfully.</div></div>');
				$("#productsadded").show();
				setTimeout(function() { $("#productsadded").fadeOut(); }, 8000);
			}
			else if(data["resp"]=="error")
			{
				//$("#cart_"+prdid).html('<i class="fa fa-check"></i> Not Added');
				//$("#cart_"+prdid).show();
				//setTimeout(function() { $("#cart_"+prdid).fadeOut(); }, 3000);
				$("#productsadded").html('<div class="add-cart"><div class="add-cart-txticon"> <i class="fa fa-check"></i></div><div class=" add-cart-txt"> Products Could not Added to Cart.</div></div>');
				$("#productsadded").show();
				setTimeout(function() { $("#productsadded").fadeOut(); }, 8000);
			}
		}
	});
});