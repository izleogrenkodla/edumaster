<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class Allowance extends AppModel
{ 
    public $name = 'Allowance';  
    public $useTable = 'allowance_master';
    public $primaryKey = 'ALLOWANCE_ID';
	
	 function Validation()
    {
        $validate1 = array(
            
			'ALLOWANCE_TYPE' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '!=', 0),
                    'message' => 'Allowance Type could not be blank',
                    'last' => true)
            ),
			'ALLOWANCE_NAME' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Allowance Name could not be blank',
                    'last' => true)
            ),
			'BY_TYPE' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '!=', 0),
                    'message' => 'Allowance By could not be blank',
                    'last' => true)
            ),

        );
        $this->validate = $validate1;
        return $this->validates();
    }

}
?>