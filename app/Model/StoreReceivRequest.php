<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class StoreReceivRequest extends AppModel
{
    public $name = 'StoreReceivRequest';
    public $useTable ='store_receive_request';
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
		'Roles' => array(
            'className' => 'Roles',
            'foreignKey' => 'ROLE_ID    ',
            'fields' => array('ID', 'ROLE_NAME'),
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
            'order' => 'StoreReceivRequest.GROUP_NAME asc',
			'conditions' => array('STATUS' => '1')
        ));
        $StoreReceivRequest = array();
        $StoreReceivRequest[0] = 'Select Category';
        foreach ($result as $row) {
            $StoreReceivRequest[$row['StoreReceivRequest']['GROUP_ID']] = ucwords($row['StoreReceivRequest']['GROUP_NAME']);
        }
        return $StoreReceivRequest;
    }
}




?>