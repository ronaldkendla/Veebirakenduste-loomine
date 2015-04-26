$(document).ready(function() {
	$("#email").keyup(function() {
		var email = $('#email').val();
		if(email=="") {
			$("#valid").html("");
		} else {
			$.ajax({
				type: "POST",
				url: "ajax_checking.php",
				data: "email="+ email ,
				success: function(html){
					$("#valid").html(html);
				}
			});
			return false;
		}
	});
});