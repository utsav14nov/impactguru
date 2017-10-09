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
		function makeAjaxCall(){
		 $.ajax({
		  type: "post",
		  url: "http://localhost/impactguru/index.php/citizen/create",
		  cache: false,    
		  data: $('#citizenForm').serializeArray(),
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
	    	<input type="text" placeholder="Enter Email" name="email" required><br>
	    	<label><b>Name</b></label>
	    	<input type="text" placeholder="Enter Name" name="name" required><br>
	    	<label><b>Date of birth</b></label>
	    	<input type="date" name="dob"><br>
	    	<label><b>Mobile</b></label>
	    	<input type="text" placeholder="Enter Mobile Number" name="mobile"><br>
	    	<label><b>Qualification</b></label>
	    	<select name="qualification">
			  <option value="B.tech">B.tech</option>
			  <option value="M.tech">M.tech</option>
			  <option value="BCA">BCA</option>
			  <option value="MCA">MCA</option>
			</select><br>
			<label><b>pincode</b></label>
	    	<input type="text" placeholder="Enter Pincode" name="pincode"><br>
	    	<label><b>Address Line 1</b></label>
	    	<input type="text" placeholder="Enter Pincode" name="address_line_1"><br>
	    	<label><b>Address Line 2</b></label>
	    	<input type="text" placeholder="Enter Pincode" name="address_line_2"><br>
	    	<label><b>City</b></label>
	    	<input type="text" placeholder="Enter Pincode" name="city"><br>
	    	<label><b>State</b></label>
	    	<input type="text" placeholder="Enter Pincode" name="state"><br>
	    	<label><b>Country</b></label>
	    	<input type="text" placeholder="Enter City" name="country"><br>
	    	<label><b>Id type</b></label>
	    	<select name="profile_id_type">
			  <option value="Pan">Pan</option>
			  <option value="Aadhar Card">Aadhar Card</option>
			  <option value="Driving Lincense">Driving Lincense</option>
			</select><br>
	    	<input type="button" onclick="makeAjaxCall();" value="Submit"/>
	    </form>
	</div>
</body>
</html>