<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class MonthDistribution extends AppModel
{
    public $name = 'MonthDistribution';
    public $useTable = 'month_distribution';
    public $primaryKey = 'DISTRI_ID';

	public $belongsTo = array(
        /*'AcademicClass' => array(
            'className' => 'AcademicClass',
            'foreignKey' => 'CLASS_ID',
            'fields' => array('CLASS_ID', 'CLASS_NAME'),
        ),*/
		'PaymentType' => array(
            'className' => 'PaymentType',
            'foreignKey' => 'payment_type',
            'fields' => array('TITLE', 'TYPE_ID'),
		)
    );
	
	function Validation()
    {
        $validate1 = array(
            'TITLE' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Title could not be blank',
                    'last' => true)
            ),
        );
        $this->validate = $validate1;
        return $this->validates();
    }
}
?>