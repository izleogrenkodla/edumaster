<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class Holiday extends AppModel
{ 
    public $name = 'Holiday';
    public $useTable = 'holidays';
    public $primaryKey = 'HOLIDAY_ID';

    

    function Validation()
    {
        $validate1 = array(
            'TITLE' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please Provide Title',
                    'last' => true),
                'isUnique' => array(
                    'rule' => 'isUnique',
                    'message' => 'Holiday Title already been used.',
                    'last' => true),
				
            ),
            'START_DATE' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Start Date could not be blank',
                    'last' => true)
            ),
            'END_DATE' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'End Date could not be blank',
                    'last' => true)
            ),
            'DESCRIPTION' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Description could not be blank',
                    'last' => true)
            ),
        );
        $this->validate = $validate1;
        return $this->validates();
    }

}