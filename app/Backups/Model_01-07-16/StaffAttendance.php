<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class StaffAttendance extends AppModel
{
    public $name = 'StaffAttendance';
    public $useTable = 'staff_attendance';
    public $primaryKey = 'STAFF_ATTENDANCE_ID';

   public $belongsTo = array(
        'Role' => array(
            'className' => 'Role',
            'foreignKey' => 'ROLE_ID',
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
            'ATTENDANCE_DATE' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Attendance Date name could not be blank',
                    'last' => true)
            ),
           
        );
        $this->validate = $validate1;
        return $this->validates();
    }
   
	
	
	

}