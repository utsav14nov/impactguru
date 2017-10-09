<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Citizen extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('citizen_model');
		$this->load->helper('url');
		//$this->load->helper('url_helper');
    }

    public function index(){
    	$this->load->view('citizenIndexView');
    }

    public function createForm(){
    	$this->load->view('citizenForm.php');
    }

    public function getCitizen(){
    	$this->load->view('getCitizen.php');
    }

    public function deleteCitizen(){
    	$this->load->view('deleteCitizen.php');
	}

	public function updateCitizen(){
    	$this->load->view('updateCitizen.php');
	}

	public function uploadDocuments(){
    	$this->load->view('uploadDocuments.php');
	}

	public function create(){

		$data = $this->input->post();
		
		try{

			if(!isset($data['name']) || $data['name']==''){
				throw new Exception("Name of the citizen is missing", 1);
			}
			if(!isset($data['email']) || $data['email']==''){
				throw new Exception("Email id of the citizen is missing", 1);
			}
			if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
				throw new Exception("Please specify valid email", 1);
			}

			$citizenId = $this->citizen_model->create_citizen($data);
			$return = ["status" => "success","msg" => "Record succesfully created" ];
			print_r(json_encode($return));


		}catch(Exception $e){
			$return = ["status" => "error","msg" => $e->getMessage()];
			print_r(json_encode($return));
		}
	}

	public function get(){
		$email = $this->input->get("email");
		try{
			$citizenData = $this->citizen_model->get_citizen($email);
			print_r(json_encode($citizenData));
		}catch(Exception $e){
			print_r(json_encode(["status" => "error","msg"=>$e->getMessage()]));
		}
	}

	public function delete(){

		$email = $this->input->get('email', TRUE);
		try{
			$citizenId = $this->citizen_model->delete_citizen($email);
			print_r(json_encode(["status" => "success","msg"=>"Succesfully deleted"]));
		}catch(Exception $e){
			print_r(json_encode(["status" => "error","msg"=>$e->getMessage()]));
		}
	}

	public function update(){
		$email = $this->input->post('email', TRUE);
		$field = $this->input->post('field', TRUE);
		$value = $this->input->post('value', TRUE);
		try{
			$citizenData = $this->citizen_model->update_citizen($email,$field,$value);
			print_r(json_encode(["status" => "success","msg"=>"Succesfully updated"]));
		}catch(Exception $e){
			print_r(json_encode(["status" => "error","msg"=>$e->getMessage()]));
		}
	}

	public function upload(){
		$email = $this->input->post('email', TRUE);
		try{
			$allowed =  array('png' ,'jpg','jpeg');
			$fileName = $_FILES['file1']['name'];
			$ext = pathinfo($fileName, PATHINFO_EXTENSION);
			if (!in_array($ext,$allowed)) {
		        throw new Exception("Please specify correct file format for".$fileName, 1);
		    }
		    else {
		        move_uploaded_file($_FILES['file1']['tmp_name'], APPPATH.'assets/img/'. $_FILES['file1']['name']);
		        $this->citizen_model->save_upload($email,APPPATH.'assets/img/'. $_FILES['file1']['name'],'profile_photo_link');
			}
			$fileName = $_FILES['file2']['name'];
			$ext = pathinfo($fileName, PATHINFO_EXTENSION);
			if (!in_array($ext,$allowed)) {
		        throw new Exception("Please specify correct file format for".$fileName, 1);
		    }
		    else {
		        move_uploaded_file($_FILES['file2']['tmp_name'], APPPATH.'assets/img/'. $_FILES['file2']['name']);
		        $this->citizen_model->save_upload($email,APPPATH.'assets/img/'. $_FILES['file2']['name'],'profile_id_link');
			}
			print_r(json_encode(['status' => 'success','msg' => "succesfully uploaded"]));
		}catch(Exception $e){
			print_r(json_encode(['status' => 'error','msg' => $e->getMessage()]));
		}
	}
}
