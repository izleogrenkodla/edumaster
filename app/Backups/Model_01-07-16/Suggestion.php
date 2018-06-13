<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class Suggestion extends AppModel
{
    public $name = 'Suggestions';
    public $useTable = 'suggestions';
    public $primaryKey = 'SUGGESTION_ID';
    
    var $belongsTo = array(
        'Role' => array(
            'fields' => array('ID', 'ROLE_NAME'),
            'foreignKey' => 'ROLE_ID'
        )
    );
	
	function Validation()
    {
        $validate1 = array(
		
            'SUGGESTION_MESSAGE' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'SUGGESTION Message could not be blank',
                    'last' => true)
            ),
		
        );
        $this->validate = $validate1;
        return $this->validates();
    }

}