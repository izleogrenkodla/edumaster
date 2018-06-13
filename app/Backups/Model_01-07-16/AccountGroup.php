<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class AccountGroup extends AppModel
{
    public $name = 'AccountGroup';
    public $useTable ='account_group_master';
    public $primaryKey = 'ACCOUNT_GROUP_ID';
	
	
	
    //var $actsAs = array('Acl' => 'requester');

    public function parentNode()
    {
        return null;
    }

    var $validate = array();


    function Validation()
    {		
        $validate1 = array(
            'ACCOUNT_GROUP_TITLE' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Account Group Title could not be blank',
                    'last' => true),
                'mustBeLonger' => array(
                    'rule' => array('minLength', 2),
                    'message' => 'Account Group Title must be greater than 1 character',
                    'last' => true),
            ),
        );
        $this->validate = $validate1;
        return $this->validates();
    }

    public function GetAccountGroup()
    {
        $result = $this->find("all", array(
            'contain' => array(),
			'conditions' => array('AccountGroup.STATUS' => 1),
            'order' => 'AccountGroup.SORT_ORDER asc'
        ));
        $AccountGroup = array();
        $AccountGroup[0] = 'Select Account Group';
        foreach ($result as $row) {
            $AccountGroup[$row['AccountGroup']['ACCOUNT_GROUP_ID']] = ucwords($row['AccountGroup']['ACCOUNT_GROUP_TITLE']);
        }
        return $AccountGroup;
    }
	
	public function GetIncomeAccountGroupId()
    {
        $result = $this->find("first", array(
            'contain' => array(),
			'conditions' => array('AccountGroup.STATUS' => 1, 'AccountGroup.SORT_ORDER' => 1)            
        ));
        $ID = $result['AccountGroup']['ACCOUNT_GROUP_ID'];
        return $ID;
    }
	
	public function GetExpenseAccountGroupId()
    {
        $result = $this->find("first", array(
            'contain' => array(),
			'conditions' => array('AccountGroup.STATUS' => 1, 'AccountGroup.SORT_ORDER' => 2)            
        ));
        $ID = $result['AccountGroup']['ACCOUNT_GROUP_ID'];
        return $ID;
    }
	
	public function GetIncomeAccountGroupTitle()
    {
        $result = $this->find("first", array(
            'contain' => array(),
			'conditions' => array('AccountGroup.STATUS' => 1, 'AccountGroup.SORT_ORDER' => 1)            
        ));
        $TITLE = $result['AccountGroup']['ACCOUNT_GROUP_TITLE'];
        return $TITLE;
    }
	
	public function GetExpenseAccountGroupTitle()
    {
        $result = $this->find("first", array(
            'contain' => array(),
			'conditions' => array('AccountGroup.STATUS' => 1, 'AccountGroup.SORT_ORDER' => 2)            
        ));
        $TITLE = $result['AccountGroup']['ACCOUNT_GROUP_TITLE'];
        return $TITLE;
    }
}