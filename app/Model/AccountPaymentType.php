<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class AccountPaymentType extends AppModel
{
    public $name = 'AccountPaymentType';
    public $useTable ='account_payment_type_master';
    public $primaryKey = 'ACCOUNT_PAYMENT_TYPE_ID';
	
	
	
    //var $actsAs = array('Acl' => 'requester');

    public function parentNode()
    {
        return null;
    }

    var $validate = array();


    function Validation()
    {		
        $validate1 = array(
            'ACCOUNT_PAYMENT_TYPE' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Account Payment Type could not be blank',
                    'last' => true),
                'mustBeLonger' => array(
                    'rule' => array('minLength', 2),
                    'message' => 'Account Payment Type must be greater than 1 character',
                    'last' => true),
            ),
        );
        $this->validate = $validate1;
        return $this->validates();
    }

    public function GetAccountPaymentType()
    {
        $result = $this->find("all", array(
            'contain' => array(),
			'conditions' => array('AccountPaymentType.STATUS' => 1),
            'order' => 'AccountPaymentType.SORT_ORDER asc'
        ));
		$AccountPaymentType = array();
        $AccountPaymentType[0] = 'Select Account Payment Type';
        foreach ($result as $row) {
            $AccountPaymentType[$row['AccountPaymentType']['ACCOUNT_PAYMENT_TYPE_ID']] = ucwords($row['AccountPaymentType']['ACCOUNT_PAYMENT_TYPE']);
        }
        return $AccountPaymentType;
    }
	
	public function GetAccountPaymentTypeById($id="")
    {
        $result = $this->find("first", array(
            'contain' => array(),
			'conditions' => array('AccountPaymentType.STATUS' => 1,'AccountPaymentType.ACCOUNT_PAYMENT_TYPE_ID' => $id)
        ));
        return $result;
    }
}