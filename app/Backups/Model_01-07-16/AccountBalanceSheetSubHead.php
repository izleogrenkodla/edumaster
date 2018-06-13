<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class AccountBalanceSheetSubHead extends AppModel
{
    public $name = 'AccountBalanceSheetSubHead';
    public $useTable ='account_balance_sheet_sub_head_master';
    public $primaryKey = 'ACCOUNT_BALANCE_SHEET_SUB_HEAD_ID';
	
	public $belongsTo = array(
        'AccountBalanceSheetHead' => array(
            'className' => 'AccountBalanceSheetHead',
            'foreignKey' => 'ACCOUNT_BALANCE_SHEET_HEAD_ID',
            'fields' => array('ACCOUNT_BALANCE_SHEET_HEAD_ID', 'ACCOUNT_BALANCE_SHEET_HEAD'),
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
			'ACCOUNT_BALANCE_SHEET_HEAD_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '>', 0),
                    'message' => 'Please Select Account Balance Sheet Head',
                    'last' => true)
            ),
            'ACCOUNT_BALANCE_SHEET_SUB_HEAD' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Account Balance Sheet Sub Head could not be blank',
                    'last' => true),
                'mustBeLonger' => array(
                    'rule' => array('minLength', 2),
                    'message' => 'Account Balance Sheet Sub Head must be greater than 1 character',
                    'last' => true),
            )
        );
        $this->validate = $validate1;
        return $this->validates();
    }

    public function GetAccountBalanceSheetSubHead()
    {
        $result = $this->find("all", array(
            'contain' => array(),
			'conditions' => array('AccountBalanceSheetSubHead.STATUS' => 1),	
            'order' => 'AccountBalanceSheetSubHead.SORT_ORDER asc'			
        ));
        $AccountBalanceSheetSubHead = array();
        $AccountBalanceSheetSubHead[0] = 'Select Account Balance Sheet Sub Head';
        foreach ($result as $row) {
            $AccountBalanceSheetSubHead[$row['AccountBalanceSheetSubHead']['ACCOUNT_BALANCE_SHEET_SUB_HEAD_ID']] = ucwords($row['AccountBalanceSheetSubHead']['ACCOUNT_BALANCE_SHEET_SUB_HEAD']);
        }
        return $AccountBalanceSheetSubHead;
    }
	
	public function GetAccountBalanceSheetSubHeadById($id="")
    {
        $result = $this->find("first", array(
            'contain' => array(),
			'conditions' => array('AccountBalanceSheetSubHead.STATUS' => 1,'AccountBalanceSheetSubHead.ACCOUNT_BALANCE_SHEET_SUB_HEAD_ID' => $id)
        ));		
        return $result;
    }
	
	public function GetAccountBalanceSheetSubHeadByHeadId($head_id)
    {
        $result = $this->find("all", array(
            'contain' => array(),
			'conditions' => array('AccountBalanceSheetSubHead.STATUS' => 1,'AccountBalanceSheetSubHead.ACCOUNT_BALANCE_SHEET_HEAD_ID' => $head_id),	
            'order' => 'AccountBalanceSheetSubHead.SORT_ORDER asc'			
        ));
		
        $AccountBalanceSheetSubHead = array();
        $AccountBalanceSheetSubHead[0] = 'Select Account Balance Sheet Sub Head';
        foreach ($result as $row) {
            $AccountBalanceSheetSubHead[$row['AccountBalanceSheetSubHead']['ACCOUNT_BALANCE_SHEET_SUB_HEAD_ID']] = ucwords($row['AccountBalanceSheetSubHead']['ACCOUNT_BALANCE_SHEET_SUB_HEAD']);
        }
        return $AccountBalanceSheetSubHead;
    }
	
}