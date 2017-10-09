<?php
class Citizen_model extends CI_Model {

    public function __construct() {
            $this->load->database();
    }

    public function create_citizen($data = FALSE){

    	if($data == FALSE){
    		throw new Exception("Error in creating citizen", 1);
    	}
		$citizenData = array("name" => $data['name'],
			"dob" => $data['dob'],
			"email" => $data['email'],
			"mobile" => $data['mobile'],
			"city" => $data['city'],
			"qualification" => $data['qualification']
		);

		$this->db->trans_start();
		if(!($this->db->insert('citizen', $citizenData))){
			throw new Exception("Citizen not created", 1);
		}    	
		$citizenId = $this->db->insert_id();	
		$this->db->trans_complete();
 		
 		$addressId = NULL;
    	if(isset($data['pincode']) && $data['pincode'] !=''){
    		$addressData = array("citizen_id" => $citizenId,
    			"pincode" => $data['pincode'],
				"address_line_1" => $data['address_line_1'],
				"address_line_2" => $data['address_line_2'],
				"city" => $data['city'],
				"state" => $data['state'],
				"country" => $data['country']
    			);
    		$this->db->trans_start();
    		if(!($this->db->insert('citizen_address', $addressData))){
    			throw new Exception("Citizen address not created", 1);
    		}
    		$addressId = $this->db->insert_id();	
			$this->db->trans_complete();
    	}

		$documentId = NULL;
		$documentData = array("citizen_id" => $citizenId,
			// "profile_photo_link" => ($data['profile_photo'] ? isset($data['profile_photo']):NULL),
			// "profile_id_link" => ($data['profile_id']?isset($data['profile_id_link']):NULL),
			"profile_id_type" => $data['profile_id_type']
			);

		$this->db->trans_start();
		if(!($this->db->insert('citizen_documents', $documentData))){
    		throw new Exception("Citizen documents not created", 1);
		}
		$documentId = $this->db->insert_id();	
		$this->db->trans_complete();
		
		$this->db->where('id',$citizenId);
		$this->db->update('citizen',array("address_id" => $addressId,"document_id" => $documentId));

		return $citizenId;
    }

    public function get_citizen($email = FALSE){
    	if($email == FALSE){
    		throw new Exception("Please specify email of the citizen", 1);
    	}

    	$citizenData = $this -> db
				-> select('*')
				-> where('email', $email)
				-> limit(1)
				-> get('citizen')
				->result();

		if(!isset($citizenData[0])){
			throw new Exception("Please specify the correct email Id", 1);
			
		}

		$citizenId = $citizenData[0]->id;
		$documentId = $citizenData[0] ->document_id;

		$citizenData = (array)$citizenData[0];

    	$citizenAddressData = $this -> db
				-> select('*')
				-> where('citizen_id', $citizenId)
				-> get('citizen_address')
				->result();

		$citizenData['all_address'] = (array)$citizenAddressData;

		$citizenDocumentsData = $this -> db
				-> select('*')
				-> where('id', $documentId)
				-> get('citizen_documents')
				->result()[0];
		$citizenData['documents'] = (array)$citizenDocumentsData;		
    	return $citizenData;
    }

    public function delete_citizen($email = FALSE){

		if($email == FALSE){
    		throw new Exception("Please specify email of the citizen", 1);
    	}

    	$citizen = $this -> db
				-> select('id,address_id,document_id')
				-> where('email', $email)
				-> limit(1)
				-> get('citizen')
				->result();

		if(!isset($citizen[0])){
			throw new Exception("Please specify the correct email Id", 1);
			
		}

		$citizenId = $citizen[0]->id;
		$documentId = $citizen[0]->address_id;

    	$this->db->query("SET FOREIGN_KEY_CHECKS=0");
		$this->db->delete('citizen_address', array('citizen_id' => $citizenId));
		$this->db->delete('citizen_documents', array('id' => $documentId));
		$this->db->delete('citizen', array('id' => $citizenId));
    	$this->db->query("SET FOREIGN_KEY_CHECKS=1");

		return $citizenId;
	}

	public function update_citizen($email = FALSE,$field = FALSE,$value = FALSE){

		if($email == FALSE || $field == FALSE || $value == FALSE){
			throw new Exception("Somethig wrong , Please specify email,field,value", 1);
		}

		$this->db->where('email',$email);
		$citizenData = $this->db->update('citizen',array("$field" => $value));

		return $citizenData;
	}

	public function save_upload($email = FALSE,$file = FALSE,$field =FALSE){
		if($email == FALSE || $field == FALSE || $file == FALSE){
			throw new Exception("Somethig wrong , Please specify email,file,field", 1);
		}

		$citizen = $this -> db
				-> select('document_id')
				-> where('email', $email)
				-> limit(1)
				-> get('citizen')
				->result();

		if(!isset($citizen[0])){
			throw new Exception("Please specify the correct email Id", 1);
			
		}
		$documentId = $citizen[0]->document_id;
		$this->db->where('id',$documentId);
		$citizenData = $this->db->update('citizen_documents',array("$field" => "$file"));		



	}
}