<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class LibraryGroup extends AppModel
{
    public $name = 'LibraryGroup';
    public $useTable ='library_books_group';
    public $primaryKey ='GROUP_ID';

	
	
	 public function parentNode()
    {
        return null;
    }

    var $validate = array();

   


    function Validation()
    {
        $validate1 = array(
            'GROUP_NAME' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Group Name could not be blank',
                    'last' => true),
                'mustBeLonger' => array(
                    'rule' => array('minLength', 2),
                    'message' => 'Group Name must be greater than 1 character',
                    'last' => true),
            ),
        );
        $this->validate = $validate1;
        return $this->validates();
    }
	
	 public function getLibraryGroup()
    {
        $result = $this->find("all", array(
			'conditions' => array('LibraryGroup.STATUS'=>1),
            'fields' => array('GROUP_ID', 'GROUP_NAME'),
            'order' => 'LibraryGroup.GROUP_NAME asc'
        ));
        $LibraryGroup = array();
        $LibraryGroup[0] = 'Select Category';
        foreach ($result as $row) {
            $LibraryGroup[$row['LibraryGroup']['GROUP_ID']] = ucwords($row['LibraryGroup']['GROUP_NAME']);
        }
        return $LibraryGroup;
    }
}




?>