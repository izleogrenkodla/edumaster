<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class FrontPhilosophy extends AppModel
{
    public $name = 'FrontPhilosophy';
    public $useTable ='front_philosophy';
    public $primaryKey = 'p_id';
	
	function Validation()
    {
        $validate1 = array(
            'pTitle' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Course Title could not be blank',
                    'last' => true),
            ),
			 'Content1' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Content 1 could not be blank',
                    'last' => true),
            ),
			'Content2' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Content 2 could not be blank',
                    'last' => true),
            ),

        );
        $this->validate = $validate1;
        return $this->validates();
    }
}
?>