<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class StoreVendor extends AppModel
{
    public $name = 'StoreVendor';
    public $useTable ='store_vendor_master';
    public $primaryKey ='ID';

	
	
	 public function parentNode()
    {
        return null;
    }

    var $validate = array();

   


    function Validation()
    {
        $validate1 = array(
            'VENDOR_NAME' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Vendor Name could not be blank',
                    'last' => true),
                'mustBeLonger' => array(
                    'rule' => array('minLength', 2),
                    'message' => 'Vendor Name must be greater than 1 character',
                    'last' => true),
            ),

            'COMPANY_NAME' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Company Name could not be blank',
                    'last' => true),
                'mustBeLonger' => array(
                    'rule' => array('minLength', 2),
                    'message' => 'Company Name must be greater than 1 character',
                    'last' => true),
           ),
            'ADDRESS' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Address could not be blank',
                    'last' => true),
                'mustBeLonger' => array(
                    'rule' => array('minLength', 2),
                    'message' => 'Address must be greater than 1 character',
                    'last' => true),
            ),   
            'MOBILE_NO' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Mobile Number could not be blank',
                    'last' => true),
                'mustBeLonger' => array(
                    'rule' => array('minLength', 10),
                    'message' => 'Enter Proper Mobile Number',
                    'last' => true),
            ),
            
           'EMAIL' => array(
                    'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Email could not be blank',
                    'last' => true),
                ),
           
        );
        $this->validate = $validate1;
        return $this->validates();
    }
	
	 public function getStoreVendor()
    {
        $result = $this->find("all", array(
            'fields' => array('ID', 'VENDOR_NAME'),
            'order' => 'StoreVendor.VENDOR_NAME asc',
			'conditions' => array('StoreVendor.STATUS' => '1')
        ));
        $StoreVendor = array();
        $StoreVendor[0] = 'Select Vendor';
        foreach ($result as $row) {
            $StoreVendor[$row['StoreVendor']['ID']] = ucwords($row['StoreVendor']['VENDOR_NAME']);
        }
        return $StoreVendor;
    }
}




?>