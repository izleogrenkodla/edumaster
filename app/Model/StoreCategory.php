<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class StoreCategory extends AppModel
{
    public $name = 'StoreCategory';
    public $useTable ='store_category_master';
    public $primaryKey ='ID';

	
	
	 public function parentNode()
    {
        return null;
    }

    var $validate = array();

   


    function Validation()
    {
        $validate1 = array(
            'CATEGORY_NAME' => array(
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
	
	 public function getStoreCategory()
    {
        $result = $this->find("all", array(
            'fields' => array('ID', 'CATEGORY_NAME'),
            'order' => 'StoreCategory.CATEGORY_NAME asc',
			'conditions' => array('STATUS' => '1')
        ));
        $StoreCategory = array();
        $StoreCategory[0] = 'Select Category';
        foreach ($result as $row) {
            $StoreCategory[$row['StoreCategory']['ID']] = ucwords($row['StoreCategory']['CATEGORY_NAME']);
        }
        return $StoreCategory;
    }
}




?>