<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script>
		function uploadDocuments(){
			var file_data1 = $('#profilephoto').prop('files')[0];
			var file_data2 = $('#docphoto').prop('files')[0];

			var form_data = new FormData();                  
			form_data.append('file1', file_data1);
			form_data.append('file2', file_data2);
			form_data.append('email',$('#email').val())
			
			$.ajax({
				type: "post",
				url: "http://localhost/impactguru/index.php/citizen/upload",
				cache: false, 
				contentType: false,
                processData: false,
                data: form_data,    
				success: function(json){      
				try{  
					var obj = jQuery.parseJSON(json);
					alert( obj['msg']);
				}catch(e) {  
					alert('Exception while request..');
				}  
				},
				error: function(){      
				alert('Error while request..');
				}
			});
		}
	</script>
</head>
<body>
	<div id="form" class = "container">
		<form name="citizenForm" id="citizenForm" action="">

			<label><b>Email</b></label>
	    	<input type="text" placeholder="Enter Email" name="email" id = "email" required><br>
	    	<label><b>Upload Profile photo</b></label>
	    	<input id="profilephoto" type="file" name="profilephoto" />
	    	<label><b>Upload Document photo</b></label>
	    	<input id="docphoto" type="file" name="docphoto" />
	    	<input type="button" onclick="uploadDocuments();" value="Submit"/>
	    </form>
	</div>
</body>
</html>