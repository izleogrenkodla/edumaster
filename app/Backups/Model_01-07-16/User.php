<?php
class User extends AppModel
{
    public $name = 'User';
    public $useTable = 'users';
    public $primaryKey = 'ID';

    public function parentNode() {
        if (!$this->id && empty($this->data)) {
            return null;
        }
        if (isset($this->data['User']['ROLE_ID'])) {
            $groupId = $this->data['User']['ROLE_ID'];
        } else {
            $groupId = $this->field('ROLE_ID');
        }
        if (!$groupId) {
            return null;
        } else {
            return array('Role' => array('ID' => $groupId));
        }
    }

    public function beforeSave()
    {
        if (isset($this->data[$this->alias]['PASSWORD'])) {
            $this->data[$this->alias]['PASSWORD'] = Security::hash($this->data[$this->alias]['PASSWORD'], null, true);
        }
        return true;
    }

    public $belongsTo = array(
        'AcademicClass' => array(
            'className' => 'AcademicClass',
            'foreignKey' => 'CLASS_ID',
            'fields' => array('CLASS_ID', 'CLASS_NAME'),
        ),
        'Role' => array(
            'className' => 'Role',
            'foreignKey' => 'ROLE_ID',
            'fields' => array('ID', 'ROLE_NAME'),
        ),
        'CastCategory' => array(
            'className' => 'CastCategory',
            'foreignKey' => 'CAST_CAT_ID',
            'fields' => array('CAST_CAT_ID', 'CAST_CAT_NAME'),
        ),
        'Transport' => array(
            'className' => 'Transport',
            'foreignKey' => 'TRANSPORT_ID',
            'fields' => array('TRANSPORT_ID', 'VEHICLE_NUMBER'),
        ),
        'Subject' => array(
            'className' => 'Subject',
            'foreignKey' => 'SUBJECT_ID',
            'fields' => array('SUBJECT_ID', 'TITLE'),
        ),
        'Medium' => array(
            'className' => 'Medium',
            'foreignKey' => 'MEDIUM_ID',
            'fields' => array('MEDIUM_ID', 'MEDIUM_NAME'),
        ),
        'Country' => array(
            'className' => 'Country',
            'foreignKey' => 'COUNTRY_ID',
            'fields' => array('COUNTRY_ID', 'COUNTRY_NAME'),
        ),
        'State' => array(
            'className' => 'State',
            'foreignKey' => 'STATE_ID',
            'fields' => array('STATE_ID','COUNTRY_ID','STATE_NAME'),
        ),
        'City' => array(
            'className' => 'City',
            'foreignKey' => 'CITY_ID',
            'fields' => array('CITY_ID','STATE_ID','CITY_NAME'),
        ),
        'BloodGroup' => array(
            'className' => 'BloodGroup',
            'foreignKey' => 'BLOOD_GROUP_ID',
            'fields' => array('BLOOD_GROUP_ID','BLOOD_GROUP_NAME'),
        ),
		'Group' => array(
            'className' => 'Group',
            'foreignKey' => 'GROUP',
            'fields' => array('GROUP_ID','GROUP_NAME'),
        ),
    );



    var $validate = array();

    function attendance_listing_validate()  {
        $validate1 = array(
            'START_DATE' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please select date',
                    'last' => true)
            ),
            'END_DATE' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please select end date',
                    'last' => true)
            ),

            'CLASS_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '!=', 0),
                    'message' => 'Please select class',
                    'last' => true)
            ),
        );
        $this->validate = $validate1;
        return $this->validates();
    }


    function Login_Validation()
    {
        $validate1 = array(
            /*'user_id' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter user id',
                    'last' => true)
            ),*/
            'USERNAME' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter user id',
                    'last' => true)
            ),
            'PASSWORD' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter last name',
                    'last' => true)
            ),
        );
        $this->validate = $validate1;
        return $this->validates();
    }

    public function ledger_validation() {
        $validate1 = array(
            'AMOUNT' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter Amount',
                    'last' => true),
            ),
            'FEES_TYPE' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please select Fee Type',
                    'last' => true),
            ),
            'PAYMENT_TERM' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '!=', 0),
                    'message' => 'Please select Payment Terms',
                    'last' => true)
            ),

        );
        $this->validate = $validate1;
        return $this->validates();
    }

    /*
    Registration Validation Function
    */
    function Validation()
    {
        $validate1 = array(
            'FIRST_NAME' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'First name could not be blank',
                    'last' => true)
            ),
            
            'DOB' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Date Of Birth could not be blank',
                    'last' => true)
            ),
            'FATHER_NAME' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Father Name could not be blank',
                    'last' => true)
            ),
            'RELIGION' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Religion could not be blank',
                    'last' => true)
            ),
            'CAST' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Cast could not be blank',
                    'last' => true)
            ),
            'SUB_CAST' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Sub Cast could not be blank',
                    'last' => true)
            ),
            'CAST_CAT_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '!=', 0),
                    'message' => 'Please select Cast Category',
                    'last' => true)
            ),
            'CLASS_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '!=', 0),
                    'message' => 'Please select Class',
                    'last' => true)
            ),
            'MEDIUM_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '!=', 0),
                    'message' => 'Please select Medium',
                    'last' => true)
            ),
            'PASSWORD' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter password',
                    'allowEmpty' => true,
                    'on' => 'create',
                    'last' => true),
                'between' => array(
                    'rule' => array('between', 6, 25),
                    'message' => 'Password between 6 and 25 chars',
                    'required' => false,
                    'allowEmpty' => true,
                ),
            ),
            'CONFIRM_PASSWORD' => array(
                'mustMatch' => array(
                    'rule' => array('verifies'),
                    'message' => 'Both passwords must match',
                    'last' => true),
            ),
           'COUNTRY_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '!=', 0),
                    'message' => 'Please select Country',
                    'last' => true)
            ),
			 'GROUP' => array(
              'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Group could not be blank',
                    'last' => true),
			  'mustNotEmpty' => array(
                    'rule' => array('comparison', '!=', 0),
                    'message' => 'Please select Group',
                    'last' => true)
           		 ),
            
            
           
        );
        $this->validate = $validate1;
        return $this->validates();
    }
    
     function valid_extentions($ext,$obj) { 
		$key = key($ext);
		if(isset($ext[$key])) {
			$img =$ext[$key];
			$extentions = explode(",",$obj["extentions"]);
			$file_ext = explode(".",strtolower($img["name"])); 
			if(!in_array($file_ext[1],$extentions)) { 
				return false;			
			}

			if($img["size"] > $obj["size"]) { 
				return false;
			}
			return true;
		}			
    }// end of functions
  
    function New_Validation()
    {
        $validate1 = array(
            'USER_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'User ID could not be blank',
                    'last' => true),
                /*
                'uniqueEmailRule' => array(
                    'rule' => 'isUnique',
                    'message' => 'User Id already registered'
                )*/
            ),
            'ROLE_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '!=', 0),
                    'message' => 'Please select location',
                    'last' => true)
            ),
            'FIRST_NAME' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'First name could not be blank',
                    'last' => true)
            ),
            'LAST_NAME' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Last name could not be blank',
                    'last' => true)
            ),
            'MOBILE_NO' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Mobile No. could not be blank',
                    'last' => true)
            ),
            'PASSWORD' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter password',
                    'allowEmpty' => true,
                    'on' => 'create',
                    'last' => true),
                'between' => array(
                    'rule' => array('between', 6, 25),
                    'message' => 'Password between 6 and 25 chars',
                    'required' => false,
                    'allowEmpty' => true,
                ),
            ),
            'file_upload' => array(
                'extension' => array(
                    'rule' => array('extension', array('jpeg', 'jpg', 'gif', 'png')),
                    'message' => 'You must supply a GIF, PNG or JPG file up to 10 Mb',
                    'on' => 'create'
                ),
                'upload-file' => array(
                    'rule' => array('uploadFile'),
                    'message' => 'Error uploading file',
                    'on' => 'create'
                )
            ),
            'EMAIL' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter email id',
                    'last' => true),
                'mustBeEmail' => array(
                    'rule' => "/^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/",
                    'message' => 'Please enter valid email',
                    'last' => true),
            ),
            'agree' => array(
                'rule' => array('comparison', '!=', ''),
                'message' => 'You must agree to the terms of use',
                'on' => 'create'
            )
        );
        $this->validate = $validate1;
        return $this->validates();
    }



    function ResetValidation()
    {
        $validate1 = array(
            'PASSWORD' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter password',
                    'last' => true),
                'mustBeLonger' => array(
                    'rule' => array('password_strength'),
                    'message' => 'Password must be 6 character long.',
                    'last' => true),
                'mustMatch' => array(
                    'rule' => array('verifies'),
                    'message' => 'Both passwords must match'),
            ),
            'confirm_password' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter confirm password',
                    'last' => true),
                'mustBeLonger' => array(
                    'rule' => array('password_strength'),
                    'message' => 'Password must be 6 character long.',
                    'last' => true),
                'mustMatch' => array(
                    'rule' => array('verifies'),
                    'message' => 'Both passwords must match'),
            )
        );
        $this->validate = $validate1;
        return $this->validates();
    }

    public function verifyOldPass()
    {
        $pwd = $this->find('list', array(
            'fields' => array('PASSWORD'),
            'conditions' => array('ID' => $this->data['User']['ID'])
        ));
        $old_pass=AuthComponent::password($this->data[$this->alias]['old_password']);
        return ($pwd[$this->data['User']['ID']]===$old_pass);
    }

    public function verifies()
    {
        return ($this->data['User']['PASSWORD'] === $this->data['User']['CONFIRM_PASSWORD']);
    }

    /*    public function password_strength()
        {
        $password = '';
        //$re = '/^(?=.{6,20}\z)/x';

        $re = '/
        ^                # Anchor to start of string.
        (?=.{6,20}\z)    # Assert the length is from 6 to 20 chars.
        /x';
        if(isset($this->data['User']['password'])) {
            $password = $this->data['User']['password'];
        } elseif($this->data['User']['new_password']) {
            $password = $this->data['User']['new_password'];
        }

        if (preg_match($re, $password)) {
          return true;
        }
          return false;
        }*/

    public function uploadFile( $check )
    {
        $uploadData = array_shift($check);

        if ($uploadData['size'] == 0 || $uploadData['error'] !== 0) {
            return false;
        }

        if($uploadData['size'] == 0 || round($uploadData['size']/1024) > 40920){
            return false;
        }

        return true;
    }

    public function GetUsers()
    {
        $result = $this->find("all", array(
            'contain' => array(),
            'fields' => array('ID', 'FIRST_NAME', 'LAST_NAME'),
            'conditions' => array('ROLE !=' => 1),
            'order' => 'User.FIRST_NAME asc'
        ));
        $user = array();
        $user[0] = 'Select User';
        foreach ($result as $row) {
            $user[$row['User']['ID']] = ucwords($row['User']['FIRST_NAME']. ' ' . $row['User']['LAST_NAME']);
        }
        return $user;
    }

    public function GetUserGroupWise($role_id = null)
    {
        $result = $this->find("all", array(
            'contain' => array(),
            'fields' => array('ID', 'FIRST_NAME', 'LAST_NAME'),
            'conditions' => array('ROLE_ID' => $role_id),
            'order' => 'User.FIRST_NAME asc'
        ));
        $user = array();
        if($role_id == 11) {
            $user[''] = 'Select Agent';
        } elseif($role_id == 13) {
            $user[''] = 'Select College';
        }
        foreach ($result as $row) {
            $user[$row['User']['ID']] = ucwords($row['User']['FIRST_NAME']. ' ' . $row['User']['LAST_NAME']);
        }
        return $user;
    }
    
    public function file_validate() {
        $validate1 = array(
            'IMPORT' => array(
                'mustNotEmpty' => array(
                    'rule' => array('uploadFile'),
                    'message' => 'Please select file',
                    'last' => true)
            ),
            'ROLE_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '!=', 0),
                    'message' => 'Please select User Type',
                    'last' => true)
            ),

        );
        $this->validate = $validate1;
        return $this->validates();
    }
    
    public function getStudentsByClass($class_id = null)
    {
        $result = $this->find("all", array(
            'contain' => array(),
            'fields' => array('ID', 'FIRST_NAME', 'LAST_NAME'),
            'conditions' => array('CLASS_ID' => $class_id,'ROLE_ID'=>STUDENT_ID),
            'order' => 'User.FIRST_NAME asc'
        ));
        $user = array();
        $user[''] = 'Select Student';
        foreach ($result as $row) {
            $user[$row['User']['ID']] = ucwords($row['User']['FIRST_NAME']. ' ' . $row['User']['LAST_NAME']);
        }
        return $user;
    }

       public function getLibraryUsers() { 
		
        $result = $this->find("all", array(
            'contain' => array(),
            'fields' => array('ID', 'FIRST_NAME', 'LAST_NAME','USERNAME'),
            'conditions' => array(
						'User.ROLE_ID'=>array(STUDENT_ID,TEACHER_ID)
				),
            'order' => 'User.FIRST_NAME asc'
        ));
        $user = array();
		$user[''] = 'Select User';
        foreach ($result as $row) {
            $user[$row['User']['ID']] = ucwords($row['User']['FIRST_NAME']. ' ' . $row['User']['LAST_NAME'].' ['.$row['User']['USERNAME'].']');
        }
        return $user;
    
	
	}// end of functions
	
	
	 public function GetName()
    {
		
        $result = $this->find("all", array(
            'contain' => array(),
           // 'order' => 'STATE_NAME ASC',
           // 'fields' => array('FORM_NO', 'FIRST_NAME', 'LAST_NAME')
		   ) );
     
        foreach ($result as $row) {
            $Name[$row['Users']['ID']] = 
			($row['Users']['FIRST_NAME'].' '.ucwords($row['Users']['MIDDLE_NAME']).' '.ucwords($row['Users']['LAST_NAME']));
        }
       return $Name;
	
    }
}