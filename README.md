# impactguru
Assignment of impact guru
CodeIgniter assignment

The project should be kept in apache root (/var/www/html/).
The folder name is impactguru.

The poject can be started at the following link of localhost :

http://localhost/impactguru/ 

1) Controller : application/controllers/Citizen.php
2) Model : application/models/Citizen_model.php
3) views : application/views/citizenIndexView.php
	    application/views/citizenForm.php
	    application/views/getCitizen.php
	    application/views/deleteCitizen.php
	    application/views/updateCitizen.php
	    application/views/uploadDocuments.php	

The Creat,Read,Update,Delete api’s are called using Jquery Ajax.

Upload File is done using file element in html and php file object.

Uploaded documents are saved in following location :
	application/assets/img/

Database :

New database : impactguru
Three tables : citizen,citizen_address,citizen_documents

CREATE TABLE citizen(
         id INT NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'unique ID for each citizen entry',
         name VARCHAR(255) NOT NULL COMMENT 'name of the citizen',
	 dob DATE NOT NULL COMMENT 'date of birth of citizen',
	 email VARCHAR(255) NOT NULL UNIQUE COMMENT 'email id of the citizen',
	 mobile VARCHAR(20) DEFAULT NULL COMMENT 'mobile number of the citizen',
 	 city VARCHAR(255) DEFAULT NULL COMMENT 'city of the citizen',
	 address_id INT DEFAULT NULL COMMENT 'foreign key from the customer_address table',
	 document_id INT DEFAULT NULL COMMENT 'forign key from the the customer_documents table',
	 qualification VARCHAR(255) DEFAULT NULL COMMENT 'qualification of the citizen Masters/Bachelors etc',
	 CONSTRAINT fk_citizen_address FOREIGN KEY (address_id) REFERENCES citizen_address(id),
         CONSTRAINT fk_citizen_documents FOREIGN KEY (document_id) REFERENCES citizen_documents(id)
)

CREATE TABLE citizen_address(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'unique ID for each citizen address entry',
	citizen_id INT COMMENT 'foreign key from the citizen table',
	pincode VARCHAR(20) NOT NULL COMMENT 'pincode of the citizen',
	address_line_1 VARCHAR(255) DEFAULT NULL COMMENT 'address line 1 of the citizen',
	address_line_2 VARCHAR(255) DEFAULT NULL COMMENT 'adress line 2 of the citizen',
	city VARCHAR(255) DEFAULT NULL COMMENT 'city of the citizen ,same as citizen table city',
	state VARCHAR(255) DEFAULT NULL COMMENT 'state of the citizen',
	country VARCHAR(255) DEFAULT NULL COMMENT 'country of the citizen'
)

CREATE TABLE citizen_documents(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY COMMENT 'unique ID for each citizen document entry',
	citizen_id INT COMMENT 'foreign key from the citizen table',
	profile_photo_link VARCHAR(255) DEFAULT NULL COMMENT 'location of the image file',
	profile_id_link VARCHAR(255) DEFAULT NULL COMMENT 'location of the image file',
	profile_id_type VARCHAR(255) DEFAULT NULL COMMENT 'type of the ID like Pan,Aadhar etc.'
)

ALTER TABLE citizen_documents ADD CONSTRAINT fk_citizen FOREIGN KEY (citizen_id) REFERENCES citizen(id);
ALTER TABLE citizen_documents ADD CONSTRAINT fk_citizen_1 FOREIGN KEY (citizen_id) REFERENCES citizen(id);

	



Sample data :

citizen table :

     id: 2
     name: Utsav Agarwal
     dob: 1992-11-14
     email: utsav141192@gmail.com
     mobile: 8840374205
     city: Jabalpur
     address_id: 2
     document_id: 2
     qualification: NULL

citizen_address table :

     id: 3
     citizen_id: 2
     pincode: 284001
     address_line_1: Subhash Gunj
     address_line_2: Jhansi
     city: Jhansi
     state: 284001
     country: India

citizen_documents table:
	id: 2
 citizen_id: 2 profile_photo_link:/var/www/html/impactguru/application/assets/img/blackTshirt.png 
 profile_id_link: /var/www/html/impactguru/application/assets/img/HAPPINESS is a habit.png
 profile_id_type: pan
