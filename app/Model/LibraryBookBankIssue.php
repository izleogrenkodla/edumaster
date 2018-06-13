<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class LibraryBookBankIssue extends AppModel
{
    public $name = 'LibraryBookBankIssue';
    public $useTable ='library_book_bank_issue';
    public $primaryKey = 'BOOK_BANK_ISSUE_ID';
	
	
	public $belongsTo = array(
        'LibraryBookBank' => array(
            'className' => 'LibraryBookBank',
            'foreignKey' => 'BOOKBANK_ID',
            'fields' => array('BOOKBANK_ID', 'BOOK_NAME'),
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
			'USER_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '>', 0),
                    'message' => 'Please Select User',
                    'last' => true)
			),
			'CLASS_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '>', 0),
                    'message' => 'Please Select Class',
                    'last' => true)
			),
			'CLASS_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '>', 0),
                    'message' => 'Please Select Class',
                    'last' => true)
			),
        );
        $this->validate = $validate1;
        return $this->validates();
    }
}
?>