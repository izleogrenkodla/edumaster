<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class AccountBalanceSheetHead extends AppModel
{
    public $name = 'AccountBalanceSheetHead';
    public $useTable ='account_balance_sheet_head_master';
    public $primaryKey = 'ACCOUNT_BALANCE_SHEET_HEAD_ID';
	
	
	
    //var $actsAs = array('Acl' => 'requester');

    public function parentNode()
    {
        return null;
    }

    var $validate = array();


    function Validation()
    {		
        $validate1 = array(
            'ACCOUNT_BALANCE_SHEET_HEAD' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Account Balance Sheet Head could not be blank',
                    'last' => true),
                'mustBeLonger' => array(
                    'rule' => array('minLength', 2),
                    'message' => 'Account Balance Sheet Head must be greater than 1 character',
                    'last' => true),
            ),
        );
        $this->validate = $validate1;
        return $this->validates();
    }

    public function GetAccountBalanceSheetHead()
    {
        $result = $this->find("all", array(
            'contain' => array(),
			'conditions' => array('AccountBalanceSheetHead.STATUS' => 1),
            'order' => 'AccountBalanceSheetHead.SORT_ORDER asc'
        ));
		$AccountBalanceSheetHead = array();
        $AccountBalanceSheetHead[0] = 'Select Account Balance Sheet Head';
        foreach ($result as $row) {
            $AccountBalanceSheetHead[$row['AccountBalanceSheetHead']['ACCOUNT_BALANCE_SHEET_HEAD_ID']] = ucwords($row['AccountBalanceSheetHead']['ACCOUNT_BALANCE_SHEET_HEAD']);
        }
        return $AccountBalanceSheetHead;
    }
	
	public function GetAccountBalanceSheetHeadById($id="")
    {
        $result = $this->find("first", array(
            'contain' => array(),
			'conditions' => array('AccountBalanceSheetHead.STATUS' => 1,'AccountBalanceSheetHead.ACCOUNT_BALANCE_SHEET_HEAD_ID' => $id)            
        ));		
        return $result;
    }
	
}