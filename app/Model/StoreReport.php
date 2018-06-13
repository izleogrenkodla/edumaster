<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class StoreReport extends AppModel
{
    public $name = 'StoreReport';
    public $useTable ='store_distribution';
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
		'Role' => array(
            'className' => 'Role',
            'foreignKey' => 'DEPT_ID    ',
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
	
	 public function getStoreReport()
    {
        $result = $this->find("all", array(
            'fields' => array('GROUP_ID', 'GROUP_NAME'),
            'order' => 'StoreReport.GROUP_NAME asc',
			'conditions' => array('STATUS' => '1')
        ));
        $StoreReport = array();
        $StoreReport[0] = 'Select Category';
        foreach ($result as $row) {
            $StoreReport[$row['StoreReport']['GROUP_ID']] = ucwords($row['StoreReport']['GROUP_NAME']);
        }
        return $StoreReport;
    }
}




?>