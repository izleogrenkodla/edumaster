<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class StaffLeave extends AppModel
{
    public $name = 'StaffLeave';
    public $useTable = 'leave_master';
    public $primaryKey = 'LEAVE_ID';
	
	public $belongsTo = array(
        'Role' => array(
            'className' => 'Role',
            'foreignKey' => 'ROLE_ID',
            'fields' => array('ID', 'ROLE_NAME'),
        ),
		'LeaveType' => array(
            'className' => 'LeaveType',
            'foreignKey' => 'LEAVE_TYPE',
            'fields' => array('LEAVE_TYPE_ID', 'LEAVE_NAME'),
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

            'LEAVE_TYPE' => array(
              'mustNotEmpty' => array(
                    'rule' => array('comparison', '!=', 0),
                    'message' => 'Please select Leave Type',
                    'last' => true)
                 ),
            'NUMBER_LEAVE' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Number of Leave could not be blank',
                    'last' => true)
            ),
            
            
             
            
            
           
        );
        $this->validate = $validate1;
        return $this->validates();
    }

    


}
?>