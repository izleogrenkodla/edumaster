<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class feeledger extends AppModel
{
    public $name = 'feeledger';
    public $useTable = 'fee_studentladger';
    public $primaryKey = 'id';
	
	
	/*var $belongsTo = array(
        'StudentRegistration' => array(
            'className' => 'StudentRegistration',
            'foreignKey' => 'FORM_NO',
			'fields' => array('FORM_NO','FIRST_NAME','MIDDLE_NAME','LAST_NAME'),
        ),
    );*/
	
	 /*function Validation()
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
    }*/

	
}
?>