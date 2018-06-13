<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class LibraryNewsPaperItem extends AppModel
{
    public $name = 'LibraryNewsPaperItem';
    public $useTable ='library_newspaper_item';
    public $primaryKey = 'NEWS_ID';
	
	public $belongsTo = array(
		'LibraryNewsPaper' => array(
            'className' => 'LibraryNewsPaper',
            'foreignKey' => 'PAPER_ID',
            'fields' => array('PAPER_ID', 'PAPER_NAME'),
        ),
       
    );
	var $validate = array();
	function Validation()
    {
        $validate1 = array(
            'PAPER_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Paper could not be blank',
                    'last' => true),
            ),
			'MAGZINE' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Magzine From could not be blank',
                    'last' => true),
                'mustBeLonger' => array(
                    'rule' => array('minLength', 2),
                    'message' => 'Magzine From must be greater than 1 character',
                    'last' => true),
            ),
			
			'DATE' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'ISSUE_DATE could not be blank',
                    'last' => true),
            ),
        );
        $this->validate = $validate1;
        return $this->validates();
    }
}
?>