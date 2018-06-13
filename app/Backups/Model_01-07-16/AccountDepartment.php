<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class AccountDepartment extends AppModel
{
    public $name = 'AccountDepartment';
    public $useTable ='account_department_master';
    public $primaryKey = 'ACCOUNT_DEPARTMENT_ID';
	
	
	
    //var $actsAs = array('Acl' => 'requester');

    public function parentNode()
    {
        return null;
    }

    var $validate = array();


    function Validation()
    {		
        $validate1 = array(
            'ACCOUNT_DEPARTMENT_TITLE' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Account Department Title could not be blank',
                    'last' => true),
                'mustBeLonger' => array(
                    'rule' => array('minLength', 2),
                    'message' => 'Account Department Title must be greater than 1 character',
                    'last' => true),
            ),
        );
        $this->validate = $validate1;
        return $this->validates();
    }

    public function GetAccountDepartment()
    {
        $result = $this->find("all", array(
            'contain' => array(),
			'conditions' => array('AccountDepartment.STATUS' => 1),
            'order' => 'AccountDepartment.SORT_ORDER asc'
        ));
		$AccountDepartment = array();
        $AccountDepartment[0] = 'Select Account Department';
        foreach ($result as $row) {
            $AccountDepartment[$row['AccountDepartment']['ACCOUNT_DEPARTMENT_ID']] = ucwords($row['AccountDepartment']['ACCOUNT_DEPARTMENT_TITLE']);
        }
        return $AccountDepartment;
    }
	
	public function GetAccountDepartmentById($id="")
    {
        $result = $this->find("first", array(
            'contain' => array(),
			'conditions' => array('AccountDepartment.STATUS' => 1,'AccountDepartment.ACCOUNT_DEPARTMENT_ID' => $id)
        ));		
        return $result;
    }
	
}