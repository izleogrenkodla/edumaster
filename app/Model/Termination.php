<?php
class Termination extends AppModel
{
    public $name = 'Termination';
    public $useTable = 'termination';
    public $primaryKey = 'TERM_ID';
	
	 public $belongsTo = array(    
        'Role' => array(
            'className' => 'Role',
            'foreignKey' => 'ROLE_ID',
            'fields' => array('ID', 'ROLE_NAME'),
        ),
		'Name' => array(
            'className' => 'Users',
            'foreignKey' => 'USER_ID',
            'fields' => array('FIRST_NAME', 'MIDDLE_NAME' ,'LAST_NAME'),
        ),
    );
	
	 function Validation()
    {
        $validate1 = array(
            'REASON' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Reason could not be blank',
                    'last' => true),
            ),
        );
        $this->validate = $validate1;
        return $this->validates();
    }
}
?>