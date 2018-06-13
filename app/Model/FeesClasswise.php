<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class FeesClasswise extends AppModel
{
    public $name = 'FeesClasswise';
    public $useTable = 'fees';
    public $primaryKey = 'FEE_ID';  

   

    function Validation()
    {
        $validate1 = array(
            'PAYMENT_TERM' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '!=', 0),
                    'message' => 'Please select Payment Types',
                    'last' => true)
            ),
            'CLASS_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '!=', 0),
                    'message' => 'Please select Class',
                    'last' => true)
            ),
            'FEE_TYPE' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '!=', 0),
                    'message' => 'Please select type of FeesClasswise',
                    'last' => true)
            ),
            'FEE' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'FeesClasswise Could not be blank',
                    'last' => true)
            ),
        );
        $this->validate = $validate1;
        return $this->validates();
    }

}