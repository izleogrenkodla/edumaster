<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class LeaveApplication extends AppModel
{
    public $name = 'LeaveApplications';
    public $useTable = 'leave_applications';
    public $primaryKey = 'LEAVE_ID';

    var $belongsTo = array(
        'Role' => array(
            'fields' => array('ID', 'ROLE_NAME'),
            'foreignKey' => 'ROLE_ID'
        ),
        'User' => array(
            'fields' => array('FIRST_NAME', 'MIDDLE_NAME', 'LAST_NAME','EMAIL_ID','DEVICE_ID'),
            'foreignKey' => 'USER_ID'
        ),
        'AcademicClass' => array(
            'fields' => array('CLASS_ID', 'CLASS_NAME'),
            'foreignKey' => 'CLASS_ID'
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
            'EVENT_START' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Start Date could not be blank',
                    'last' => true)
            ),
            'EVENT_END' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'End Date could not be blank',
                    'last' => true)
            ),
            'REASON' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Reason could not be blank',
                    'last' => true)
            ),

        );
        $this->validate = $validate1;
        return $this->validates();
    }

}