<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class StorePurchaseOrder extends AppModel
{
    public $name = 'StorePurchaseOrder';
    public $useTable ='store_purchase_records';
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


   
} 