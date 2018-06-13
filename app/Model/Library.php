<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class Library extends AppModel
{
    public $name = 'Library';
    public $useTable = 'library';
    public $primaryKey = 'LIB_ID';
	
	
    public $belongsTo = array(
        'Book' => array(
            'className' => 'Book',
            'foreignKey' => 'BOOK_ID',
            'fields' => array('Book.BOOK_ID', 'Book.BOOK_NAME','Book.AUTHOR_NAME','Book.CAT_ID'),
        ),
		'User' => array(
            'className' => 'User',
            'foreignKey' => 'USER_ID',
            'fields' => array('User.FIRST_NAME', 'User.MIDDLE_NAME','User.LAST_NAME'),
        ),
    );

    function Validation()
    {
        $validate1 = array(
           
			'BOOK_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '!=', 0),
                    'message' => 'Book could not be blank',
                    'last' => true)
            ),
			'USER_ID' => array(
                  'mustNotEmpty' => array(
                    'rule' => array('comparison', '!=', 0),
                    'message' => 'User could not be blank',
                    'last' => true)
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

        );
        $this->validate = $validate1;
        return $this->validates();
    }

}
?>