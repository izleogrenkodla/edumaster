<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class StudentLedger extends AppModel
{
    public $name = 'StudentLedger';
    public $useTable = 'fee_studentladger';
    public $primaryKey = 'LEDGER_ID';
	
	var $belongsTo = array(
       'AcademicClass' => array(
            'className' => 'AcademicClass',
            'foreignKey' => 'CLASS_ID',
            'fields' => array('CLASS_ID', 'CLASS_NAME'),
        ),
		'Name' => array(
            'className' => 'Users',
            'foreignKey' => 'USER_ID',
            'fields' => array('FIRST_NAME', 'MIDDLE_NAME' ,'LAST_NAME'),
        ),
		'PaymentType' => array(
            'className' => 'PaymentType',
            'foreignKey' => 'FeesTerms',
            'fields' => array('TITLE', 'TYPE_ID'),
		)
		
		
    );
}
?>