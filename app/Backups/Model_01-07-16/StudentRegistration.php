<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class StudentRegistration extends AppModel
{
    public $name = 'StudentRegistration';
    public $useTable = 'Student_Registration';
    public $primaryKey = 'FORM_NO';
	
	 public $belongsTo = array(
        'AcademicClass' => array(
            'className' => 'AcademicClass',
            'foreignKey' => 'ADM_CLASS_ID',
            'fields' => array('CLASS_ID', 'CLASS_NAME'),
        ),
        'CastCategory' => array(
            'className' => 'CastCategory',
            'foreignKey' => 'CAST_CAT_ID',
            'fields' => array('CAST_CAT_ID', 'CAST_CAT_NAME'),
        ),
        'Medium' => array(
            'className' => 'Medium',
            'foreignKey' => 'ADM_MEDIUM_ID',
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
		'Round' => array(
            'className' => 'Round',
            'foreignKey' => 'ROUND_ID',
            'fields' => array('ROUND_ID','ROUND_NAME'),
        )
		
    );
	
	function Validation()
    {
        $validate1 = array(
            'FIRST_NAME' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'First name could not be blank',
                    'last' => true)
            ),
			'MIDDLE_NAME' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Middle name could not be blank',
                    'last' => true)
            ),
			'LAST_NAME' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Last name could not be blank',
                    'last' => true)
            ),
			 'DOB' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Date Of Birth could not be blank',
                    'last' => true)
            ),
			'AGE' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Age could not be blank',
                    'last' => true)
            ),
			'FATHER_NAME' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Father Name could not be blank',
                    'last' => true)
            ),
			'FATHER_MOBILE' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Father Mobile Number could not be blank',
                    'last' => true)
            ),
			'NATIONAL_LANGUAGE' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'National Language could not be blank',
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
            'ADM_CLASS_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '!=', 0),
                    'message' => 'Please select Class',
                    'last' => true)
            ),
            'ADM_MEDIUM_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '!=', 0),
                    'message' => 'Please select Medium',
                    'last' => true)
            ),
			'EMAIL_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'E-Mail Address could not be blank',
                    'last' => true)
            ),
			'MOBILE_NO' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Mobile Number could not be blank',
                    'last' => true)
            ),
			'CONTACT_NO' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Contact Number could not be blank',
                    'last' => true)
            ),
			'PINCODE' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Pincode could not be blank',
                    'last' => true)
            ),
			'ADDRESS' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Address could not be blank',
                    'last' => true)
            ),
			'LAST_SCHOOL_NAME' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Last School Name could not be blank',
                    'last' => true)
            ),
			'LAST_BOARD' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Last Board could not be blank',
                    'last' => true)
            ),
			'LAST_CLASS_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '!=', 0),
                    'message' => 'Please select Last School Class',
                    'last' => true)
            ),
            'LAST_MEDIUM_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '!=', 0),
                    'message' => 'Please select Last School Medium',
                    'last' => true)
            ),
			 'GROUP' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '!=', 0),
                    'message' => 'Please select Group',
                    'last' => true),
				'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Group could not be blank',
                    'last' => true)
            ),

        );
        $this->validate = $validate1;
        return $this->validates();
    }
	function Interview_Validation()
    {
        $validate1 = array(
            'INTERVIEW_RESULT' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'INTERVIEW RESULT name could not be blank',
                    'last' => true)
            ),
            
        );
        $this->validate = $validate1;
        return $this->validates();
    }
	
	

	 public function GetName()
    {
		
        $result = $this->find("all", array(
            'contain' => array(),
           // 'order' => 'STATE_NAME ASC',
           // 'fields' => array('FORM_NO', 'FIRST_NAME', 'LAST_NAME')
		   ) );
     
        foreach ($result as $row) {
            $state[$row['StudentRegistration']['FORM_NO']] = 
			($row['StudentRegistration']['FIRST_NAME'].' '.ucwords($row['StudentRegistration']['MIDDLE_NAME']).' '.ucwords($row['StudentRegistration']['LAST_NAME']));
        }
       return $state;
	
    }
}
?>