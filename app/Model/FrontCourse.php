<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class FrontCourse extends AppModel
{
    public $name = 'FrontCourse';
    public $useTable ='front_course';
    public $primaryKey = 'Course_ID';
	
	 function Validation()
    {
        $validate1 = array(
            'Course_Title' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Course Title could not be blank',
                    'last' => true),
            ),
			 'Description' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Description could not be blank',
                    'last' => true),
            ),

        );
        $this->validate = $validate1;
        return $this->validates();
    }
}
?>