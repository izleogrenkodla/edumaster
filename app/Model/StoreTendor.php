<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class StoreTendor extends AppModel
{
    public $name = 'StoreTendor';
    public $useTable ='store_tendor';
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
            'foreignKey' => 'ITEM',
            'fields' => array('ID', 'ITEM_NAME'),
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
	
	 // public function getStoreTendor()
    // {
        // $result = $this->find("all", array(
            // 'fields' => array('GROUP_ID', 'GROUP_NAME'),
            // 'order' => 'store_payment.GROUP_NAME asc',
			// 'conditions' => array('STATUS' => '1')
        // ));
        // $store_payment = array();
        // $store_payment[0] = 'Select Store Tendor';
        // foreach ($result as $row) {
            // $store_payment[$row['store_payment']['GROUP_ID']] = ucwords($row['store_payment']['GROUP_NAME']);
        // }
        // return $store_payment;
    // }
}




?>