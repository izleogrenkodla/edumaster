<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class LibraryFineMaster extends AppModel
{
    public $name = 'LibraryFineMaster';
    public $useTable ='library_fine_master';
    public $primaryKey = 'ID';
	
	
	 var $validate = array();

    function Validation()
    {
        $validate1 = array(
            'FINE' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'FINE could not be blank',
                    'last' => true),
            ),
        );
        $this->validate = $validate1;
        return $this->validates();
    }

    
	
}
?>