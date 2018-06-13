<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class StoreLiveStock extends AppModel
{
    public $name = 'StoreLiveStock';
    public $useTable ='store_live_stocks';
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
    );


    // function Validation()
    // {
        // $validate1 = array(
            // 'GROUP_NAME' => array(
                // 'mustNotEmpty' => array(
                    // 'rule' => 'notEmpty',
                    // 'message' => 'Group Name could not be blank',
                    // 'last' => true),
                // 'mustBeLonger' => array(
                    // 'rule' => array('minLength', 2),
                    // 'message' => 'Group Name must be greater than 1 character',
                    // 'last' => true),
            // ),
        // );
        // $this->validate = $validate1;
        // return $this->validates();
    // }
	
	 public function getStoreLiveStock()
    {
        $result = $this->find("all", array(
            'fields' => array('GROUP_ID', 'GROUP_NAME'),
            'order' => 'StoreLiveStock.GROUP_NAME asc',
			'conditions' => array('STATUS' => '1')
        ));
        $StoreLiveStock = array();
        $StoreLiveStock[0] = 'Select Category';
        foreach ($result as $row) {
            $StoreLiveStock[$row['StoreLiveStock']['GROUP_ID']] = ucwords($row['StoreLiveStock']['GROUP_NAME']);
        }
        return $StoreLiveStock;
    }
}




?>