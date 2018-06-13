<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class AccountTrialBalance extends AppModel
{
    public $name = 'AccountTrialBalance';
    public $useTable ='account_trial_balance';
    public $primaryKey = 'ACCOUNT_TRIAL_BAL_ID';
	
	public $belongsTo = array(
        'AccountGroup' => array(
            'className' => 'AccountGroup',
            'foreignKey' => 'ACCOUNT_GROUP_ID',
            'fields' => array('ACCOUNT_GROUP_ID', 'ACCOUNT_GROUP_TITLE'),
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
			'ACCOUNT_GROUP_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '>', 0),
                    'message' => 'Please Select Account Group',
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

	public function GetATBByDate($date="")
    {
		$result = array();
		
		if(isset($date) && $date != "")
		{		
        $result = $this->find("all", array(
			'contain' => array('AccountGroup'),
			'conditions' => array(
							'AccountTrialBalance.DATE' => $date,
							'AccountTrialBalance.STATUS' => 1
							),
            'order' => 'AccountTrialBalance.SORT_ORDER asc'
        ));
		}
		else
		{
		$result = array();
		}
        
        return $result;
    }	
	
}