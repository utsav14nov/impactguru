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
		function updateCitizen(){
		 $.ajax({
		  type: "post",
		  url: "http://localhost/impactguru/index.php/citizen/update",
		  cache: false,    
		  data: $('#updateForm').serializeArray(),
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
		<form name="updateForm" id="updateForm" action="">
			<label><b>Email</b></label>
	    	<input type="text" placeholder="Enter Email" name="email" required><br>
	    	<label><b>Field to update</b></label>
	    	<select name="field">
			  <option value="name">Name</option>
			  <option value="dob">Date of birth</option>
			  <option value="email">Email</option>
			  <option value="mobile">Mobile</option>
			  <option value="city">City</option>
			  <option value="qualification">Qualifiation</option>
			</select><br>
			<label><b>Value</b></label>
	    	<input type="text" placeholder="Enter Value" name="value" required><br>
	    	<input type="button" onclick="updateCitizen();" value="Submit"/>
	    </form>
	</div>
</body>
</html>