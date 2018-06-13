<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class LibraryBook extends AppModel
{
    public $name = 'LibraryBook';
    public $useTable ='library_book';
    public $primaryKey = 'BOOK_ID';
	
	
	 public $belongsTo = array(
        'LibraryGroup' => array(
            'className' => 'LibraryGroup',
            'foreignKey' => 'CATEGORY_ID',
            'fields' => array('GROUP_ID', 'GROUP_NAME'),
        ),
		'LibraryPublisher' => array(
            'className' => 'LibraryPublisher',
            'foreignKey' => 'PUBLISHER_ID',
            'fields' => array('PUBLISHER_ID', 'PUBLISHER_NAME'),
        ),
		'AcademicClass' => array(
            'className' => 'AcademicClass',
            'foreignKey' => 'CLASS_ID',
            'fields' => array('CLASS_ID', 'CLASS_NAME'),
        ),
       
    );

 public function parentNode()
    {
        return null;
    }

    var $validate = array();
	function Validation()
    {
        $validate1 = array(
            'BOOK_NAME' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Book Name could not be blank',
                    'last' => true),
                'mustBeLonger' => array(
                    'rule' => array('minLength', 2),
                    'message' => 'Book Name must be greater than 1 character',
                    'last' => true),
            ),
			'BOOK_FROM' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Book From could not be blank',
                    'last' => true),
                'mustBeLonger' => array(
                    'rule' => array('minLength', 2),
                    'message' => 'Book From must be greater than 1 character',
                    'last' => true),
            ),
			'AUTHOR' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'AUTHOR could not be blank',
                    'last' => true),
                'mustBeLonger' => array(
                    'rule' => array('minLength', 2),
                    'message' => 'AUTHOR must be greater than 1 character',
                    'last' => true),
            ),
			'QUANTITY' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'QUANTITY could not be blank',
                    'last' => true),
            ),
			'CATEGORY_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '>', 0),
                    'message' => 'Please Select Category',
                    'last' => true)
			),
			'PUBLISHER_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '>', 0),
                    'message' => 'Please Select Publisher',
                    'last' => true)
			),
        );
        $this->validate = $validate1;
        return $this->validates();
    }

	 public function GetLibraryBook()
    {
        $result = $this->find("all", array(
				'conditions' => array('LibraryBook.STATUS' => 1),
        ));
        $LibraryBook = array();
        $LibraryBook[0] = 'Select Book';
        foreach ($result as $row) {
            $LibraryBook[$row['LibraryBook']['BOOK_ID']] = ucwords($row['LibraryBook']['BOOK_NAME']);
        }
        return $LibraryBook;
    }
}
?>