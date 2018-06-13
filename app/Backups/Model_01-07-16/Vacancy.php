<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class Vacancy extends AppModel
{
    public $name = 'Vacancy';
    public $useTable = 'vacancy';
    public $primaryKey = 'V_ID';
	
    function Validation()
    {
        $validate1 = array(
            'BOOK_NAME' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Book Name could not be blank',
                    'last' => true),
            ),
			'CAT_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '!=', 0),
                    'message' => 'Category could not be blank',
                    'last' => true)
            ),
			'AUTHOR_NAME' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Author Name could not be blank',
                    'last' => true)
            ),
			'ISBN_NO' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'ISBN could not be blank',
                    'last' => true)
            ),
			'NO_OF_BOOK' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Number of book could not be blank',
                    'last' => true)
            ),

        );
        $this->validate = $validate1;
        return $this->validates();
    }
	
	function GetBooks() { 
		
        $result = $this->find("all", array(
            'contain' => array(),
            'conditions' => array('STATUS' => 1,'NO_OF_BOOK >'=>0),
            'fields' => array('BOOK_ID', 'BOOK_NAME'),
            'order' => 'Book.BOOK_ID asc'
        ));
        $books = array();
        $books[0] = 'Select Book';
        foreach ($result as $row) {
            $books[$row['Book']['BOOK_ID']] = ucwords($row['Book']['BOOK_NAME']);
        }
        return $books;
	}// end of function
}
?>