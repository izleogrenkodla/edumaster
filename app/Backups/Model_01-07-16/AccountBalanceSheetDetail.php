<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class AccountBalanceSheetDetail extends AppModel
{
    public $name = 'AccountBalanceSheetDetail';
    public $useTable ='account_balance_sheet_details';
    public $primaryKey = 'ACCOUNT_BALANCE_SHEET_DET_ID';
	
	public $belongsTo = array(
        'AccountBalanceSheetHead' => array(
            'className' => 'AccountBalanceSheetHead',
            'foreignKey' => 'ACCOUNT_BALANCE_SHEET_HEAD_ID',
            'fields' => array('ACCOUNT_BALANCE_SHEET_HEAD_ID', 'ACCOUNT_BALANCE_SHEET_HEAD'),
        ),
		'AccountBalanceSheetSubHead' => array(
            'className' => 'AccountBalanceSheetSubHead',
            'foreignKey' => 'ACCOUNT_BALANCE_SHEET_SUB_HEAD_ID',
            'fields' => array('ACCOUNT_BALANCE_SHEET_SUB_HEAD_ID', 'ACCOUNT_BALANCE_SHEET_SUB_HEAD'),
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
			'ACCOUNT_BALANCE_SHEET_HEAD_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '>', 0),
                    'message' => 'Please Select Account Balance Sheet Head',
                    'last' => true)
            ),
            'ACCOUNT_BALANCE_SHEET_HEAD_CATEGORY' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Account Balance Sheet Category could not be blank',
                    'last' => true),
                'mustBeLonger' => array(
                    'rule' => array('minLength', 2),
                    'message' => 'Account Balance Sheet Category must be greater than 1 character',
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

    public function GetAccountBalanceSheetDetail()
    {
        $result = $this->find("all", array(
            'contain' => array(),
			'conditions' => array('AccountBalanceSheetDetail.STATUS' => 1),	
            'order' => 'AccountBalanceSheetDetail.SORT_ORDER asc'			
        ));
        $AccountBalanceSheetDetail = array();
        $AccountBalanceSheetDetail[0] = 'Select Account Balance Sheet Detail';
        foreach ($result as $row) {
            $AccountBalanceSheetDetail[$row['AccountBalanceSheetDetail']['ACCOUNT_BALANCE_SHEET_DET_ID']] = ucwords($row['AccountBalanceSheetDetail']['ACCOUNT_BALANCE_SHEET_HEAD_CATEGORY']);
        }
        return $AccountBalanceSheetDetail;
    }
	
	public function GetAccountBalanceSheetDetailById($id="")
    {
        $result = $this->find("first", array(
            'contain' => array(),
			'conditions' => array('AccountBalanceSheetDetail.STATUS' => 1,'AccountBalanceSheetDetail.ACCOUNT_BALANCE_SHEET_DET_ID' => $id)
        ));		
        return $result;
    }
	
	public function GetABSDHeads($date="")
    {
		$result = array();
		
		if(isset($date) && $date != "")
		{		
        $result = $this->find("all", array(
			'fields'=>array('DISTINCT ACCOUNT_BALANCE_SHEET_HEAD_ID'),
			'conditions' => array(
							'AccountBalanceSheetDetail.DATE' => $date,
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
    }
	
	public function GetABSDSubHeads($date="",$head)
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
    }
	
	public function GetABSDHeadCategories($date="",$head,$sub_head)
    {
		$result = array();
		
		if( (isset($date) && $date != "")  && (isset($head) && $head != "") )
		{
			/*if((isset($sub_head) && $sub_head != ""))
			{*/
			$qry_cond_arr = array('AccountBalanceSheetDetail.DATE' => $date,
							'AccountBalanceSheetDetail.ACCOUNT_BALANCE_SHEET_HEAD_ID' => $head,
							'AccountBalanceSheetDetail.ACCOUNT_BALANCE_SHEET_SUB_HEAD_ID' => $sub_head,
							'AccountBalanceSheetDetail.STATUS' => 1
							);
			/*}
			else			
			{
			$qry_cond_arr = array('AccountBalanceSheetDetail.DATE' => $date,
							'AccountBalanceSheetDetail.ACCOUNT_BALANCE_SHEET_HEAD_ID' => $head,							
							'AccountBalanceSheetDetail.STATUS' => 1
							);
			}*/
			
			$result = $this->find("all", array(
				//'fields'=>array('ACCOUNT_BALANCE_SHEET_HEAD_CATEGORY'),
				'conditions' => $qry_cond_arr,
				'order' => 'AccountBalanceSheetDetail.SORT_ORDER asc'
			));
		}
		else
		{
			$result = array();
		}
        
        return $result;
    }
	
	
}