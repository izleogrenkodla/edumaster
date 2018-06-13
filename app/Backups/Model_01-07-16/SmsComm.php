<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class SmsComm extends AppModel
{
    public $name = 'SmsComm';
    public $useTable = 'sms_sent';
    public $primaryKey = 'SMS_ID';

     public $belongsTo = array(
        'Vehicle_Shift' => array(
            'shiftname' => 'Vehicle_Shift',
            'fields' => array('SHIFT_ID ', 'VEHICLE_SHIFT_TYPE'),
            'foreignKey' => 'SHIFT_ID',
        ),
		'User' => array(
            'className' => 'User',
            'fields' => array('FIRST_NAME', 'MIDDLE_NAME','LAST_NAME'),
            'foreignKey' => 'USER_ID',
        ),
    );

 
    function Validation()
    {
        $validate1 = array(
            'SMS_TITLE' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'SMS Title could not be blank',
                    'last' => true)
				
					
            ),
			'SMS_BODY' => array(
                'mustNotEmpty' => array(
					'rule' => 'notEmpty',
					'message' => "SMS Body could not be blank",
                    'last' => true)
            )
        );
        $this->validate = $validate1;
        return $this->validates();
    }
	
	

}
