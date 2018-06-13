<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class AdvanceFee extends AppModel
{
    public $name = 'AdvanceFee';
    public $useTable = 'fees_advance';
    public $primaryKey = 'ADV_ID';
	
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
            'foreignKey' => 'TEARMS',
            'fields' => array('TITLE', 'TYPE_ID'),
		),
    );
}
?>