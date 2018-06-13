<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class LibraryVisitor extends AppModel
{
    public $name = 'LibraryVisitor';
    public $useTable ='library_visitors';
    public $primaryKey = 'VISITOR_ID';



 public $belongsTo = array(
		'LibraryBook' => array(
            'className' => 'LibraryBook',
            'foreignKey' => 'BOOK_ID',
            'fields' => array('BOOK_ID', 'BOOK_NAME'),
        ),
		'AcademicClass' => array(
            'className' => 'AcademicClass',
            'foreignKey' => 'CLASS_ID',
            'fields' => array('CLASS_ID', 'CLASS_NAME'),
        ),
		'User' => array(
            'className' => 'User',
            'foreignKey' => 'USER_ID',
            'fields' => array('ID', 'FIRST_NAME','LAST_NAME'),
        ),
		'Role' => array(
            'className' => 'Role',
            'foreignKey' => 'ROLE_ID',
            'fields' => array('ID', 'ROLE_NAME'),
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
      
			'BOOK_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '>', 0),
                    'message' => 'Please Select Book',
                    'last' => true)
			),
			'CLASS_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '>', 0),
                    'message' => 'Please Select Academic Class',
                    'last' => true)
			),
			'ROLE_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '>', 0),
                    'message' => 'Please Select User',
                    'last' => true)
			),
			'GROUP_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '>', 0),
                    'message' => 'Please Select Book Category',
                    'last' => true)
			),
        );
        $this->validate = $validate1;
        return $this->validates();
    }
}
?>