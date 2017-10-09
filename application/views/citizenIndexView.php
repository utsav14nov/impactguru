<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
</head>
<body>
	<div id="container">
		<?php echo anchor('citizen/createForm', 'Create citizen new account', 'title="create"');?><br>
		<?php echo anchor('citizen/getCitizen', 'Get citizen info', 'title="get"');?><br>
		<?php echo anchor('citizen/updateCitizen', 'Update citizen', 'title="Update"');?><br>
		<?php echo anchor('citizen/deleteCitizen', 'Delete citizen', 'title="delete"');?><br>
		<?php echo anchor('citizen/UploadDocuments', 'Upload Profile Photo and Document', 'title="uploadDoc"');?><br>
	</div>
</body>
</html>