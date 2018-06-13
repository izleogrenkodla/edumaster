<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class Fee extends AppModel
{
    public $name = 'Fee';
    public $useTable = 'fees';
    public $primaryKey = 'FEE_ID';  

    public $belongsTo = array(
        'AcademicClass' => array(
            'className' => 'AcademicClass',
            'foreignKey' => 'CLASS_ID',
            'fields' => array('CLASS_ID', 'CLASS_NAME'),
        ),
		'FeeType' => array(
            'className' => 'FeeType',
            'foreignKey' => 'FEE_TYPE',
            'fields' => array('FT_ID', 'TITLE'),
        ),
		'PaymentType' => array(
            'className' => 'PaymentType',
            'foreignKey' => 'PAYMENT_TERM',
            'fields' => array('TITLE', 'TYPE_ID'),
		),
    );

    function Validation()
    {
        $validate1 = array(
            
            'CLASS_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '!=', 0),
                    'message' => 'Please select Class',
                    'last' => true)
            ),
            'FEE_TYPE' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '!=', 0),
                    'message' => 'Please select type of Fee',
                    'last' => true)
            ),
            'FEE' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Fee Could not be blank',
                    'last' => true)
            ),
        );
        $this->validate = $validate1;
        return $this->validates();
    }

}