<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class LibraryMember extends AppModel
{
    public $name = 'LibraryMember';
    public $useTable ='library_member';
    public $primaryKey = 'MEMBER_ID';

	 public $belongsTo = array(
		'AcademicClass' => array(
            'className' => 'AcademicClass',
            'foreignKey' => 'CLASS_ID',
            'fields' => array('CLASS_ID','CLASS_NAME'),
        ),
		'Role' => array(
            'className' => 'Role',
            'foreignKey' => 'ROLE_ID',
            'fields' => array('ID','ROLE_NAME'),
        ),
		'Users' => array(
            'className' => 'Users',
            'foreignKey' => 'USER_ID',
            'fields' => array('ID','FIRST_NAME','LAST_NAME'),
        ),
    );

	
	var $validate = array();
	function Validation()
    {
        $validate1 = array(
			'CLASS_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '>', 0),
                    'message' => 'Please Select Class',
                    'last' => true)
			),
			'USER_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '>', 0),
                    'message' => 'Please Select User',
                    'last' => true)
			),
        );
        $this->validate = $validate1;
        return $this->validates();
    }
	
}



?>