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

}