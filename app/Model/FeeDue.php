<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class FeeDue extends AppModel
{
    public $name = 'FeeDue';
    public $useTable = 'fees_due';
    public $primaryKey = 'id';  

    public $belongsTo = array(
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
            'foreignKey' => 'PaymentType',
            'fields' => array('TITLE', 'TYPE_ID'),
		),
		'MonthDistribution' => array(
            'className' => 'MonthDistribution',
            'foreignKey' => 'Month',
            'fields' => array('DISTRI_ID', 'month'),
		)
	
	);
	
}
?>