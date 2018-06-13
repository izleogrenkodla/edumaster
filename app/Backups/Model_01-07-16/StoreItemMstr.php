<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class StoreItemMstr extends AppModel
{
    public $name = 'StoreItemMstr';
    public $useTable ='store_item_master';
    public $primaryKey ='ID';

	
    public $belongsTo = array(
        'StoreCategory' => array(
            'className' => 'StoreCategory',
            'foreignKey' => 'CATEGORY_ID    ',
            'fields' => array('ID', 'CATEGORY_NAME'),
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
            'ITEM_NAME' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'ITEM NAME could not be blank',
                    'last' => true),
                'mustBeLonger' => array(
                    'rule' => array('minLength', 2),
                    'message' => 'ITEM NAME must be greater than 1 character',
                    'last' => true),
            ),
        );
        $this->validate = $validate1;
        return $this->validates();
    }
	
	 public function getStoreItemMstr()
    {
        $result = $this->find("all", array(
            'fields' => array('ID', 'ITEM_NAME'),
            'order' => 'StoreItemMstr.ITEM_NAME asc',
			'conditions' => array('StoreItemMstr.STATUS' => '1')
        ));
        $StoreItemMstr = array();
        $StoreItemMstr[0] = 'Select Item';
        foreach ($result as $row) {
            $StoreItemMstr[$row['StoreItemMstr']['ID']] = ucwords($row['StoreItemMstr']['ITEM_NAME']);
        }
        return $StoreItemMstr;
    }
}




?>