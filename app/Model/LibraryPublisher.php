<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class LibraryPublisher extends AppModel
{
    public $name = 'LibraryPublisher';
    public $useTable ='library_publisher';
    public $primaryKey = 'PUBLISHER_ID';
 

    var $validate = array();

   


    function Validation()
    {
        $validate1 = array(
            'PUBLISHER_NAME' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Publisher Name could not be blank',
                    'last' => true),
                'mustBeLonger' => array(
                    'rule' => array('minLength', 2),
                    'message' => 'Publisher Name must be greater than 1 character',
                    'last' => true),
            ),
        );
        $this->validate = $validate1;
        return $this->validates();
    }
	
	public function getLibraryPublisher()
    {
        $result = $this->find("all", array(
			'conditions' => array('LibraryPublisher.STATUS'=>1),
            'order' => 'LibraryPublisher.PUBLISHER_NAME asc'
        ));
		
        $Publisher = array();
        $Publisher[0] = 'Select Publisher';
        foreach ($result as $row) {
            $Publisher[$row['LibraryPublisher']['PUBLISHER_ID']] = ucwords($row['LibraryPublisher']['PUBLISHER_NAME']);
        }
        return $Publisher;
    }

}

 
?>