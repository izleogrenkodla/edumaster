<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class AccountName extends AppModel
{
    public $name = 'AccountName';
    public $useTable ='account_name_master';
    public $primaryKey = 'ACCOUNT_NAME_ID';
	
	public $belongsTo = array(
        'AccountDepartment' => array(
            'className' => 'AccountDepartment',
            'foreignKey' => 'ACCOUNT_DEPARTMENT_ID',
            'fields' => array('ACCOUNT_DEPARTMENT_ID', 'ACCOUNT_DEPARTMENT_TITLE'),
        )
    );
	
	
    //var $actsAs = array('Acl' => 'requester');

    public function parentNode()
    {
        return null;
    }

    var $validate = array();


    function Validation()
    {		
        $validate1 = array(
			'ACCOUNT_DEPARTMENT_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '>', 0),
                    'message' => 'Please Select Account Department',
                    'last' => true)
            ),
            'ACCOUNT_NAME' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Account Name could not be blank',
                    'last' => true),
                'mustBeLonger' => array(
                    'rule' => array('minLength', 2),
                    'message' => 'Account Name must be greater than 1 character',
                    'last' => true),
            ),
			'ACCOUNT_NUMBER' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Account Number could not be blank',
                    'last' => true),
                'mustBeLonger' => array(
                    'rule' => array('minLength', 2),
                    'message' => 'Account Number must be greater than 1 character',
                    'last' => true),
            ),
        );
        $this->validate = $validate1;
        return $this->validates();
    }

    public function GetAccountName()
    {
        $result = $this->find("all", array(
            'contain' => array(),
			'conditions' => array('AccountName.STATUS' => 1),	
            'order' => 'AccountName.SORT_ORDER asc'			
        ));
        $AccountName = array();
        $AccountName[0] = 'Select Account Name';
        foreach ($result as $row) {
            $AccountName[$row['AccountName']['ACCOUNT_NAME_ID']] = ucwords($row['AccountName']['ACCOUNT_NAME']);
        }
        return $AccountName;
    }
	
	public function GetAccountNameById($id="")
    {
        $result = $this->find("first", array(
            'contain' => array(),
			'conditions' => array('AccountName.STATUS' => 1,'AccountName.ACCOUNT_NAME_ID' => $id)
        ));		
        return $result;
    }
	
	public function GetAccountNameByDeptId($dept_id)
    {
        $result = $this->find("all", array(
            'contain' => array(),
			'conditions' => array('AccountName.STATUS' => 1,'AccountName.ACCOUNT_DEPARTMENT_ID' => $dept_id),	
            'order' => 'AccountName.SORT_ORDER asc'			
        ));
		
        $AccountName = array();
        $AccountName[0] = 'Select Account Name';
        foreach ($result as $row) {
            $AccountName[$row['AccountName']['ACCOUNT_NAME_ID']] = ucwords($row['AccountName']['ACCOUNT_NAME']);
        }
        return $AccountName;
    }
	
	public function GetAccountNameNoByDeptId($dept_id)
    {
        $result = $this->find("all", array(
            'contain' => array(),
			'conditions' => array('AccountName.STATUS' => 1,'AccountName.ACCOUNT_DEPARTMENT_ID' => $dept_id),	
            'order' => 'AccountName.SORT_ORDER asc'			
        ));
		
        $AccountName = array();
        $AccountName[0] = 'Select Account Name [ Account Number ]';
        foreach ($result as $row) {
			if(isset($row['AccountName']['ACCOUNT_NUMBER']) && $row['AccountName']['ACCOUNT_NUMBER']!="")
			{
			$AccountName[$row['AccountName']['ACCOUNT_NAME_ID']] = ucwords($row['AccountName']['ACCOUNT_NAME'])." [ ".$row['AccountName']['ACCOUNT_NUMBER']." ]";
			}
			else
			{
            $AccountName[$row['AccountName']['ACCOUNT_NAME_ID']] = ucwords($row['AccountName']['ACCOUNT_NAME']);
			}
        }
        return $AccountName;
    }
	
	
}