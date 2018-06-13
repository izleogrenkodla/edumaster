<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class LibraryBookBank extends AppModel
{
    public $name = 'LibraryBookBank';
    public $useTable ='library_bookbank';
    public $primaryKey = 'BOOKBANK_ID';
	
	
	 public $belongsTo = array(
     
		'AcademicClass' => array(
            'className' => 'AcademicClass',
            'foreignKey' => 'CLASS_ID',
            'fields' => array('CLASS_ID', 'CLASS_NAME'),
        ),
		'LibraryBook' => array(
            'className' => 'LibraryBook',
            'foreignKey' => 'BOOK_ID',
            'fields' => array('BOOK_ID', 'BOOK_NAME'),
        ),
		
       
    );
	
	    var $validate = array();
		
		function Validation()
    {
        $validate1 = array(
           'CLASS_ID' => array(
                'mustBeLonger' => array(
                   'rule' => array('comparison', '>', 0),
                    'message' => 'Please Select Class',
                    'last' => true),
            ),
			
        );
        $this->validate = $validate1;
        return $this->validates();
    }



}
?>