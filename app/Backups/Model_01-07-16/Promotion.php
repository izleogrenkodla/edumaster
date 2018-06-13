<?php
// app/Model/User.php
App::uses('AppModel', 'Model');
class Promotion extends AppModel
{
    public $name = 'Promotion';
    public $useTable = 'staff_promotion';
    public $primaryKey = 'PRO_ID';
	
	public $belongsTo = array(
        'Role' => array(
            'className' => 'Role',
            'foreignKey' => 'OLD_ROLE_ID',
            'fields' => array('ID', 'ROLE_NAME'),
        ),
		'NewRole' => array(
            'className' => 'Role',
            'foreignKey' => 'NEW_ROLE_ID',
            'fields' => array('ID', 'ROLE_NAME'),
        ),
		'Name' => array(
            'className' => 'Users',
            'foreignKey' => 'USER_ID',
            'fields' => array('FIRST_NAME', 'MIDDLE_NAME' ,'LAST_NAME'),
        ),
      
    );
	
	function Validation()
    {
        $validate1 = array(
		'NEW_ROLE_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '!=', 0),
                    'message' => 'Please select Role',
                    'last' => true)
            ),
            'NEW_SALARY' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Salary could not be blank',
                    'last' => true)
            ),
			'PRO_DATE' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Promotion Date could not be blank',
                    'last' => true)
            ),
        );
        $this->validate = $validate1;
        return $this->validates();
    }
    
}
?>