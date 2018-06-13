<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class StorePurchase extends AppModel
{
    public $name = 'StorePurchase';
    public $useTable ='store_purchase';
    public $primaryKey ='ID';

	
	
	 public function parentNode()
    {
        return null;
    }

    var $validate = array();

	 public $belongsTo = array(
        'StoreCategory' => array(
            'className' => 'StoreCategory',
            'foreignKey' => 'CATEGORY_ID    ',
            'fields' => array('ID', 'CATEGORY_NAME'),
        ),
        'StoreItemMstr' => array(
            'className' => 'StoreItemMstr',
            'foreignKey' => 'ITEM_ID    ',
            'fields' => array('ID', 'ITEM_NAME'),
        ),
		'StoreVendor' => array(
            'className' => 'StoreVendor',
            'foreignKey' => 'VENDOR_ID    ',
            'fields' => array('ID', 'VENDOR_NAME'),
        ),
    );


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
	
	 public function getStorePurchase()
    {
        $result = $this->find("all", array(
            'fields' => array('GROUP_ID', 'GROUP_NAME'),
            'order' => 'StorePurchase.GROUP_NAME asc',
			'conditions' => array('STATUS' => '1')
        ));
        $StorePurchase = array();
        $StorePurchase[0] = 'Select Category';
        foreach ($result as $row) {
            $StorePurchase[$row['StorePurchase']['GROUP_ID']] = ucwords($row['StorePurchase']['GROUP_NAME']);
        }
        return $StorePurchase;
    }
}




?>