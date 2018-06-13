<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class AcademicHistory extends AppModel
{
    public $name = 'AcademicHistory';
    public $useTable = 'general_user_academic_history';
    public $primaryKey = 'ACD_HIS_ID'; 
	
	public $belongsTo = array(
        'Role' => array(
            'className' => 'Role',
            'foreignKey' => 'ROLE_ID',
            'fields' => array('ID', 'ROLE_NAME'),
        ),
		 'AcademicClass' => array(
            'className' => 'AcademicClass',
            'foreignKey' => 'CLASS_ID',
            'fields' => array('CLASS_ID', 'CLASS_NAME'),
        ),
        'Medium' => array(
            'className' => 'Medium',
            'foreignKey' => 'LAST_MEDIUM_ID',
            'fields' => array('MEDIUM_ID', 'MEDIUM_NAME'),
        ),
      
    );
	
	 function Validation()
    {
        $validate1 = array(
			 'LAST_SCHOOL_NAME' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Last School Name could not be blank',
                    'last' => true),
            ),
            'LAST_BOARD' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Last Board could not be blank',
                    'last' => true),
            ),
        );
        $this->validate = $validate1;
        return $this->validates();
    }


}
?>