<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class AdmissionConfirm extends AppModel
{
    public $name = 'AdmissionConfirm';
    public $useTable = 'admission_confirm';
    public $primaryKey = 'ADM_ID';
	
	
	var $belongsTo = array(
        'StudentRegistration' => array(
            'className' => 'StudentRegistration',
            'foreignKey' => 'FORM_NO',
			'fields' => array('FORM_NO','FIRST_NAME','MIDDLE_NAME','LAST_NAME'),
        ),
    );
	
	 function Validation()
    {
        $validate1 = array(
            'AMOUNT' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Donation Amount could not be blank',
                    'last' => true)
            ),
        );
        $this->validate = $validate1;
        return $this->validates();
    }

	
}
?>