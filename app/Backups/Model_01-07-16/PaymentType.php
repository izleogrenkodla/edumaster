<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class PaymentType extends AppModel
{
    public $name = 'PaymentType';
    public $useTable = 'payment_type';
    public $primaryKey = 'TYPE_ID';

    function Validation()
    {
        $validate1 = array(
            'TITLE' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please Enter Title',
                    'last' => true)
            ),
        );
        $this->validate = $validate1;
        return $this->validates();
    }
	
	public function getPaymentTerms() { 
		$payment_terms = $this->find('all',array(
		'conditions' => array('STATUS' => 1),
		'fields'=>array('TYPE_ID','TITLE'),
		'contain' => array(),
            	'order' => 'PaymentType.TYPE_ID asc'
	));
		$return = array();
        $return[0] = 'Select Payment Terms';
        foreach ($payment_terms as $row) {
            $return[$row['PaymentType']['TYPE_ID']] = ucwords($row['PaymentType']['TITLE']);
        }
		
		return $return;
	}
}