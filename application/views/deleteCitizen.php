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
		function deleteCitizen(){

		 $.ajax({
		  type: "get",
		  url: "http://localhost/impactguru/index.php/citizen/delete",
		  cache: false,    
		  data: {
		  	email :	$('#email').val()
		  },
		  success: function(json){      
		  try{  
		 
		   $('#display').text(json);
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

			<label><b>Email</b></label>
	    	<input type="text" placeholder="Enter Email" name="email" id="email" required><br>
	    	<input type="button" onclick="deleteCitizen();" value="Submit"/>
	</div>
	<div>
		<span id="display"></span>
	</div>
</body>
</html>