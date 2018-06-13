<?php
class StaffRegistration extends AppModel
{
    public $name = 'StaffRegistration';
    public $useTable = 'users';
    public $primaryKey = 'ID';
	
	 public $belongsTo = array(    
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
		 'CastCategory' => array(
            'className' => 'CastCategory',
            'foreignKey' => 'CAST_CAT_ID',
            'fields' => array('CAST_CAT_ID', 'CAST_CAT_NAME'),
        ),
      
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
           
        );
        $this->validate = $validate1;
        return $this->validates();
    }
	
	 public function GetStaffName()
    {
		
        $result = $this->find("all", array(
            'contain' => array(),
			 'conditions' => array('StaffRegistration.ROLE_ID !='=>5)
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
?>