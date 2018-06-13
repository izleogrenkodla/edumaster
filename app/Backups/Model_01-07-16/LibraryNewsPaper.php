<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class LibraryNewsPaper extends AppModel
{
    public $name = 'LibraryNewsPaper';
    public $useTable ='library_newspaper';
    public $primaryKey = 'PAPER_ID';

	
    public function parentNode()
    {
        return null;
    }

    var $validate = array();

   


    function Validation()
    {
        $validate1 = array(
            'PAPER_NAME' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Paper Name could not be blank',
                    'last' => true),
                'mustBeLonger' => array(
                    'rule' => array('minLength', 2),
                    'message' => 'Paper Name must be greater than 1 character',
                    'last' => true),
            ),  
			'PRICE' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Paper Price could not be blank',
                    'last' => true),
                'mustBeLonger' => array(
                    'rule' => numeric,
                    'message' => 'Paper Price must be currency only',
                    'last' => true),
            ),
        );
        $this->validate = $validate1;
        return $this->validates();
    }
	
	 public function getLibraryNewsPaper()
    {
        $result = $this->find("all", array(
			'conditions' => array('LibraryNewsPaper.STATUS' => 1),
            'fields' => array('PAPER_ID', 'PAPER_NAME'),
            'order' => 'LibraryNewsPaper.PAPER_NAME asc'
        ));
        $LibraryGroup = array();
        $LibraryGroup[0] = 'Select NewsPaper';
        foreach ($result as $row) {
            $LibraryGroup[$row['LibraryNewsPaper']['PAPER_ID']] = ucwords($row['LibraryNewsPaper']['PAPER_NAME']);
        }
        return $LibraryGroup;
    }

}

?>