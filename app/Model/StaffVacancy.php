<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class StaffVacancy extends AppModel
{
    public $name = 'StaffVacancy';
    public $useTable = 'staff_vacancy';
    public $primaryKey = 'VACANCY_ID';
	
	function Validation()
    {
        $validate1 = array(
            'POST_NAME' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Post Name could not be blank',
                    'last' => true),
            ),
			'QUALIFICATION' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Qualification could not be blank',
                    'last' => true)
            ),
			'EXPERIENCE' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Experience could not be blank',
                    'last' => true)
            ),
			'NUMBER_VACANCY' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Number of Vacancy could not be blank',
                    'last' => true)
            ),
			'LAST_DATE' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Last Date could not be blank',
                    'last' => true)
            ),

        );
        $this->validate = $validate1;
        return $this->validates();
    }
}
?>