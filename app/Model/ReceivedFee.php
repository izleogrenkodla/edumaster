<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class ReceivedFee extends AppModel
{
    public $name = 'ReceivedFee';
    public $useTable = 'fees_receive';
    public $primaryKey = 'id';
	
	
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
		'MonthDistribution' => array(
            'className' => 'MonthDistribution',
            'foreignKey' => 'FEE_MONTH',
            'fields' => array('DISTRI_ID', 'month'),
        ),
		
    );
	
	 function Validation()
    {
		
        $validate1 = array(
            'AMOUNT' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '>', 0),
                    'message' => 'Please Enter Amount',
                    'last' => true)
            ),
        );
        $this->validate = $validate1;
        return $this->validates();
    }

	
}
?>