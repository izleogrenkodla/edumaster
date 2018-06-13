<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class AccountBankReconciliationStatement extends AppModel
{
    public $name = 'AccountBankReconciliationStatement';
    public $useTable ='account_bank_reconciliation_statement';
    public $primaryKey = 'ACCOUNT_BANK_RECONCILIATION_STAT_ID';
	
	public $belongsTo = array(
        'AccountDepartment' => array(
            'className' => 'AccountDepartment',
            'foreignKey' => 'ACCOUNT_DEPARTMENT_ID',
            'fields' => array('ACCOUNT_DEPARTMENT_ID', 'ACCOUNT_DEPARTMENT_TITLE'),
        ),
		'AccountName' => array(
            'className' => 'AccountName',
            'foreignKey' => 'ACCOUNT_NAME_ID',
            'fields' => array('ACCOUNT_NAME_ID', 'ACCOUNT_NAME', 'ACCOUNT_NUMBER'),
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
			'DATE' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Date could not be blank',
                    'last' => true)
            ),
			'ACCOUNT_DEPARTMENT_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '>', 0),
                    'message' => 'Please Select Account Department',
                    'last' => true)
            ),
			'ACCOUNT_NAME_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '>', 0),
                    'message' => 'Please Select Account Name [ Account Number ]',
                    'last' => true)
            ),
            'BALANCE_BANK' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Bank Statement Balance could not be blank',
                    'last' => true)                
            ),
			/*'BANK_CREDIT_DETAILS' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Bank Credit Details could not be blank',
                    'last' => true),
                'mustBeLonger' => array(
                    'rule' => array('minLength', 2),
                    'message' => 'Bank Credit Details must be greater than 1 character',
                    'last' => true),
            ),
			'BANK_CREDIT_AMOUNT' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Total Bank Credit Amount could not be blank',
                    'last' => true)
            ),
			'BANK_DEBIT_DETAILS' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Bank Debit Details could not be blank',
                    'last' => true),
                'mustBeLonger' => array(
                    'rule' => array('minLength', 2),
                    'message' => 'Bank Debit Details must be greater than 1 character',
                    'last' => true),
            ),
			'BANK_DEBIT_AMOUNT' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Total Bank Debit Amount could not be blank',
                    'last' => true)
            ),*/
			'BALANCE_BOOK' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Book Balance could not be blank',
                    'last' => true)
            ),
			/*'BOOK_CREDIT_DETAILS' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Book Credit Details could not be blank',
                    'last' => true),
                'mustBeLonger' => array(
                    'rule' => array('minLength', 2),
                    'message' => 'Book Credit Details must be greater than 1 character',
                    'last' => true),
            ),
			'BOOK_CREDIT_AMOUNT' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Total Book Credit Amount could not be blank',
                    'last' => true)
            ),
			'BOOK_DEBIT_DETAILS' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Book Debit Details could not be blank',
                    'last' => true),
                'mustBeLonger' => array(
                    'rule' => array('minLength', 2),
                    'message' => 'Book Debit Details must be greater than 1 character',
                    'last' => true),
            ),
			'BOOK_DEBIT_AMOUNT' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Total Book Debit Amount could not be blank',
                    'last' => true)
            )*/
        );
        $this->validate = $validate1;
        return $this->validates();
    }

    public function GetAccountBankReconciliationStatement()
    {
        $result = $this->find("all", array(
            'contain' => array('AccountDepartment','AccountName'),
			'conditions' => array('AccountBankReconciliationStatement.STATUS' => 1),	
            'order' => 'AccountBankReconciliationStatement.SORT_ORDER asc'			
        ));
        /*$AccountBankReconciliationStatement = array();
        $AccountBankReconciliationStatement[0] = 'Select Account Balance Sheet Detail';
        foreach ($result as $row) {
            $AccountBalanceSheetDetail[$row['AccountBalanceSheetDetail']['ACCOUNT_BALANCE_SHEET_DET_ID']] = ucwords($row['AccountBalanceSheetDetail']['ACCOUNT_BALANCE_SHEET_HEAD_CATEGORY']);
        }
        return $AccountBalanceSheetDetail;*/
		return $result;
    }
	
	public function GetAccountBankReconciliationStatementById($id="")
    {
        $result = $this->find("first", array(
            'contain' => array('AccountDepartment','AccountName'),
			'conditions' => array('AccountBankReconciliationStatement.STATUS' => 1,'AccountBankReconciliationStatement.ACCOUNT_BANK_RECONCILIATION_STAT_ID' => $id)
        ));		
        return $result;
    }
	
	public function GetABRSByDate($date="")
    {
		$result = array();
		
		if(isset($date) && $date != "")
		{		
        $result = $this->find("all", array(
			'contain' => array('AccountDepartment','AccountName'),
			'conditions' => array(
							'AccountBankReconciliationStatement.DATE' => $date,
							'AccountBankReconciliationStatement.STATUS' => 1
							),
            'order' => 'AccountBankReconciliationStatement.SORT_ORDER asc'			
        ));
		}
		else
		{
		$result = array();
		}
        
        return $result;
    }
	
	/*public function GetABSDSubHeads($date="",$head)
    {
		$result = array();
		
		if( (isset($date) && $date != "") && (isset($head) && $head != "") )
		{
        $result = $this->find("all", array(
			'fields'=>array('DISTINCT ACCOUNT_BALANCE_SHEET_SUB_HEAD_ID'),
			'conditions' => array(
							'AccountBalanceSheetDetail.DATE' => $date,
							'AccountBalanceSheetDetail.ACCOUNT_BALANCE_SHEET_HEAD_ID' => $head,
							'AccountBalanceSheetDetail.STATUS' => 1
							),
            'order' => 'AccountBalanceSheetDetail.SORT_ORDER asc'
        ));
		}
		else
		{
		$result = array();
		}
        
        return $result;
    }*/
	
	public function GetABRSByDateHeadSubHead($date="",$head,$sub_head)
    {
		$result = array();
		
		if( (isset($date) && $date != "")  && (isset($head) && $head != "") && (isset($sub_head) && $sub_head != "") )
		{
			/*if((isset($sub_head) && $sub_head != ""))
			{*/
			$qry_cond_arr = array('AccountBankReconciliationStatement.DATE' => $date,
							'AccountBankReconciliationStatement.ACCOUNT_DEPARTMENT_ID' => $head,
							'AccountBankReconciliationStatement.ACCOUNT_NAME_ID' => $sub_head,
							'AccountBankReconciliationStatement.STATUS' => 1
							);
			/*}
			else			
			{
			$qry_cond_arr = array('AccountBalanceSheetDetail.DATE' => $date,
							'AccountBalanceSheetDetail.ACCOUNT_BALANCE_SHEET_HEAD_ID' => $head,							
							'AccountBalanceSheetDetail.STATUS' => 1
							);
			}*/
			
			$result = $this->find("first", array(
				//'fields'=>array('ACCOUNT_BALANCE_SHEET_HEAD_CATEGORY'),
				'conditions' => $qry_cond_arr,
				'order' => 'AccountBankReconciliationStatement.SORT_ORDER asc'
			));
		}
		else
		{
			$result = array();
		}
        
        return $result;
    }
	
	
}