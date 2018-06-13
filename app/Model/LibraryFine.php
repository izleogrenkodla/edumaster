<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class LibraryFine extends AppModel
{
    public $name = 'LibraryFine';
    public $useTable ='library_fine_collection';
    public $primaryKey = 'FINE_ID';
	
	
	
	 public $belongsTo = array(
     'LibraryBookIssue' => array(
            'className' => 'LibraryBookIssue',
            'foreignKey' => 'BOOK_ISSUE_ID',
            'fields' => array('BOOK_ISSUE_ID', 'GROUP_ID','BOOK_ID','USER_ID','CLASS_ID','ISSUE_DATE','RETURN_DATE'),
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
		
		
       
    );
}
?>