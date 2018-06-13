<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class Attendance extends AppModel
{
    public $name = 'Attendance';
    public $useTable = 'attendance';
    public $primaryKey = 'ATTENDANCE_ID';

    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'ID',
            'fields' => array('FIRST_NAME','MIDDLE_NAME', 'LAST_NAME','CLASS_ID','STATUS','ID','DEVICE_ID','EMAIL_ID'),
        ),
    );

}