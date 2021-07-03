$(document).ready(function() {
$( "#submitloginform" ).on( "click", function() {
	
	var email = $("#emailid").val();
	var password = $("#userpassowrd").val();	
	
   if(email == "" ){
	  $(".errorMsg").show().css("background-color", "#ffcccc");
	  $(".errorMsg").html("*Please enter email id"); 	   
   }
   else if(password == "" ){
	  $(".errorMsg").show().css("background-color", "#ffcccc"); 
	  $(".errorMsg").html("*Please enter password"); 	   
   }
   else if(grecaptcha && grecaptcha.getResponse().length == 0){
	  $(".errorMsg").show().css("background-color", "#ffcccc"); 
	  $(".errorMsg").html("*Please verify the captcha");      
   }
   else{
	   $(".errorMsg").html("");  
	   
	   var dataString = 'email='+ email + '&userpassowrd=' + password + '&g-recaptcha-response='+ grecaptcha.getResponse() ;
		$.ajax({
			type: "POST",
			url: "CaptchaValidation.php",
			data: dataString,
			cache: false,
			beforeSend: function() 
			{   $(".errorMsg").show().css("background-color", "#FFFFE0");
				$(".errorMsg").html("Please Wait...");
			},
			success: function(response)
			{
				$(".errorMsg").show().css("background-color", "#d5fdd5");
				$(".errorMsg").html(response);
				var str = "http://localhost/skptricks/php%20google%20recaptcha/";				
				window.location.href = str+"success.php";
			}
		}); 	   
   } 
});
});