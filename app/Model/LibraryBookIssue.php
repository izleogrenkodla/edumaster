<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class LibraryBookIssue extends AppModel
{
    public $name = 'LibraryBookIssue';
    public $useTable ='library_book_issue';
    public $primaryKey = 'BOOK_ISSUE_ID';

	 public $belongsTo = array(
        'LibraryGroup' => array(
            'className' => 'LibraryGroup',
            'foreignKey' => 'GROUP_ID',
            'fields' => array('GROUP_ID', 'GROUP_NAME'),
        ),
		'LibraryBook' => array(
            'className' => 'LibraryBook',
            'foreignKey' => 'BOOK_ID',
            'fields' => array('BOOK_ID', 'BOOK_NAME'),
        ),
		'Users' => array(
            'className' => 'Users',
            'foreignKey' => 'USER_ID',
            'fields' => array('ID', 'FIRST_NAME','LAST_NAME'),
        ),
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
		'LibraryFine' => array(
            'className' => 'LibraryFine',
            'foreignKey' => 'FINE_ID',
            'fields' => array('FINE_ID','NO_OF_DAYS','FINE_PER_DAY','TOTAL_AMOUNT'),
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