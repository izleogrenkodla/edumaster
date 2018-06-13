<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class AccountLedgerDetail extends AppModel
{
    public $name = 'AccountLedgerDetail';
    public $useTable ='account_ledger_details';
    public $primaryKey = 'ACCOUNT_LEDGER_DET_ID';
	
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
        ),
		'AccountGroup' => array(
            'className' => 'AccountGroup',
            'foreignKey' => 'ACCOUNT_GROUP_ID',
            'fields' => array('ACCOUNT_GROUP_ID', 'ACCOUNT_GROUP_TITLE'),
        ),
		'AccountPaymentType' => array(
            'className' => 'AccountPaymentType',
            'foreignKey' => 'ACCOUNT_PAYMENT_TYPE_ID',
            'fields' => array('ACCOUNT_PAYMENT_TYPE_ID', 'ACCOUNT_PAYMENT_TYPE'),
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
			'ACCOUNT_GROUP_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '>', 0),
                    'message' => 'Please Select Account Group',
                    'last' => true)
            ),
			'ACCOUNT_PAYMENT_TYPE_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '>', 0),
                    'message' => 'Please Select Account Payment Type',
                    'last' => true)
            ),            
			'ACCOUNT_HEAD' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Account Head could not be blank',
                    'last' => true),
                'mustBeLonger' => array(
                    'rule' => array('minLength', 2),
                    'message' => 'Account Head must be greater than 1 character',
                    'last' => true),
            ),
			'AMOUNT' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Amount could not be blank',
                    'last' => true)
            )
        );
        $this->validate = $validate1;
        return $this->validates();
    }
	
	function ValidationSearch()
    {		
        $validate1 = array(
			'FROM_DATE' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'From Date could not be blank',
                    'last' => true)
            ),
			'TO_DATE' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'To Date could not be blank',
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
            )
        );
        $this->validate = $validate1;
        return $this->validates();
    }

    public function GetAccountLedgerDetail()
    {
        $result = $this->find("all", array(
            'contain' => array('AccountDepartment','AccountName','AccountGroup','AccountPaymentType'),
			'conditions' => array('AccountLedgerDetail.STATUS' => 1),	
            'order' => 'AccountLedgerDetail.SORT_ORDER asc'			
        ));
        /*$AccountBankReconciliationStatement = array();
        $AccountBankReconciliationStatement[0] = 'Select Account Balance Sheet Detail';
        foreach ($result as $row) {
            $AccountBalanceSheetDetail[$row['AccountBalanceSheetDetail']['ACCOUNT_BALANCE_SHEET_DET_ID']] = ucwords($row['AccountBalanceSheetDetail']['ACCOUNT_BALANCE_SHEET_HEAD_CATEGORY']);
        }
        return $AccountBalanceSheetDetail;*/
		return $result;
    }
	
	public function GetAccountLedgerDetailById($id="")
    {
        $result = $this->find("first", array(
            'contain' => array('AccountDepartment','AccountName','AccountGroup','AccountPaymentType'),
			'conditions' => array('AccountLedgerDetail.STATUS' => 1,'AccountLedgerDetail.ACCOUNT_LEDGER_DET_ID' => $id)
        ));
        return $result;
    }
	
	/*public function GetABRSByDate($date="")
    {
		$result = array();
		
		if(isset($date) && $date != "")
		{		
        $result = $this->find("all", array(
			'contain' => array('AccountDepartment','AccountName','AccountGroup','AccountPaymentType'),
			'conditions' => array(
							'AccountLedgerDetail.DATE' => $date,
							'AccountLedgerDetail.STATUS' => 1
							),
            'order' => 'AccountLedgerDetail.SORT_ORDER asc'			
        ));
		}
		else
		{
		$result = array();
		}
        
        return $result;
    }*/
	
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
	
	public function GetALDByParams($from_date="",$to_date="",$acc_dept,$acc_name_no,$acc_payment_type)
    {
		$result = array();
		
		if( (isset($from_date) && $from_date != "")  && (isset($to_date) && $to_date != "")
			&& (isset($acc_dept) && $acc_dept != "") && (isset($acc_name_no) && $acc_name_no != "")
		    && (isset($acc_payment_type) && $acc_payment_type != "")
		  )
		{
			$qry_cond_arr = array(array('AccountLedgerDetail.DATE >= ' => $from_date,
										'AccountLedgerDetail.DATE <= ' => $to_date
								  ),
							'AccountLedgerDetail.ACCOUNT_DEPARTMENT_ID' => $acc_dept,
							'AccountLedgerDetail.ACCOUNT_NAME_ID' => $acc_name_no,
							'AccountLedgerDetail.ACCOUNT_PAYMENT_TYPE_ID' => $acc_payment_type,
							'AccountLedgerDetail.STATUS' => 1
							);
			$result = $this->find("all", array(
				'contain' => array('AccountDepartment','AccountName','AccountGroup','AccountPaymentType'),
				'conditions' => $qry_cond_arr,
				'order' => 'AccountLedgerDetail.DATE asc'
			));
		}
		else if( (isset($from_date) && $from_date != "")  && (isset($to_date) && $to_date != "")
			&& (isset($acc_dept) && $acc_dept != "") && (isset($acc_name_no) && $acc_name_no != "")
		  )
		{
			$qry_cond_arr = array(array('AccountLedgerDetail.DATE >= ' => $from_date,
										'AccountLedgerDetail.DATE <= ' => $to_date
								  ),
							'AccountLedgerDetail.ACCOUNT_DEPARTMENT_ID' => $acc_dept,
							'AccountLedgerDetail.ACCOUNT_NAME_ID' => $acc_name_no,
							'AccountLedgerDetail.STATUS' => 1
							);
			$result = $this->find("all", array(
				'contain' => array('AccountDepartment','AccountName','AccountGroup','AccountPaymentType'),
				'conditions' => $qry_cond_arr,
				'order' => 'AccountLedgerDetail.DATE asc'
			));
		}		
		else
		{
			$result = array();
		}
        
        return $result;
    }
	
	public function GetABIncomeByParams($from_date="",$to_date="",$income_ag_id)
    {
		$result = array();
		
		if( (isset($from_date) && $from_date != "")  && (isset($to_date) && $to_date != "")
			&& (isset($income_ag_id) && $income_ag_id != "")
		  )
		{
			$qry_cond_arr = array(array('AccountLedgerDetail.DATE >= ' => $from_date,
										'AccountLedgerDetail.DATE <= ' => $to_date
								  ),
							'AccountLedgerDetail.ACCOUNT_GROUP_ID' => $income_ag_id,
							'AccountLedgerDetail.STATUS' => 1
							);
			$result = $this->find("first", array(
				'fields'=>array('sum(AccountLedgerDetail.AMOUNT) as TOTAL_INCOME'),
				'conditions' => $qry_cond_arr,
				'order' => 'AccountLedgerDetail.DATE asc'
			));
		}				
		else
		{
			$result = array();
		}
        
        return $result;
    }
	
	public function GetABExpensesByParams($from_date="",$to_date="",$expense_ag_id)
    {
		$result = array();
		
		if( (isset($from_date) && $from_date != "")  && (isset($to_date) && $to_date != "")
			&& (isset($expense_ag_id) && $expense_ag_id != "")
		  )
		{
			$qry_cond_arr = array(array('AccountLedgerDetail.DATE >= ' => $from_date,
										'AccountLedgerDetail.DATE <= ' => $to_date
								  ),
							'AccountLedgerDetail.ACCOUNT_GROUP_ID' => $expense_ag_id,
							'AccountLedgerDetail.STATUS' => 1
							);
			$result = $this->find("first", array(
				'fields'=>array('sum(AccountLedgerDetail.AMOUNT) as TOTAL_EXPENSES'),
				'conditions' => $qry_cond_arr,
				'order' => 'AccountLedgerDetail.DATE asc'
			));
		}				
		else
		{
			$result = array();
		}
        
        return $result;
    }
	
	
}