<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class LeaveType extends AppModel
{
    public $name = 'LeaveType';
    public $useTable = 'leave_type_master';
    public $primaryKey = 'LEAVE_TYPE_ID';
	
	 function Validation()
    {
        $validate1 = array(
            'LEAVE_TYPE' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Leave Type could not be blank',
                    'last' => true),
            ),
        );
        $this->validate = $validate1;
        return $this->validates();
    }
	
	

     public function GetLType()
    {
        $result = $this->find("all", array(
            'contain' => array(),
            'conditions' => array('STATUS' => 1),
            'fields' => array('LEAVE_TYPE_ID', 'LEAVE_NAME'),
            'order' => 'LeaveType.LEAVE_TYPE_ID asc'
        ));
        $medium = array();
        $medium[0] = 'Select Leave Type';
        foreach ($result as $row) {
            $medium[$row['LeaveType']['LEAVE_TYPE_ID']] = ucwords($row['LeaveType']['LEAVE_NAME']);
        }
        return $medium;
    }
}
?>