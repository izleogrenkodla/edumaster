<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class StudentAttendance extends AppModel
{
    public $name = 'StudentAttendance';
    public $useTable ='attendance';
    public $primaryKey = 'ATTENDANCE_ID';
	
	 public $belongsTo = array(
		'Name' => array(
            'className' => 'Users',
            'foreignKey' => 'ID',
            'fields' => array('FIRST_NAME', 'MIDDLE_NAME' ,'LAST_NAME'),
        ),
		 'AcademicClass' => array(
            'className' => 'AcademicClass',
            'foreignKey' => 'CLASS_ID',
            'fields' => array('CLASS_ID', 'CLASS_NAME'),
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
?>