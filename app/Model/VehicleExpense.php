<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class VehicleExpense extends AppModel
{
    public $name = 'VehicleExpense';
    public $useTable ='transportation_vehicle_expense';
    public $primaryKey = 'EXPENSE_ID';

    //var $actsAs = array('Acl' => 'requester');
	
	
	public $belongsTo = array(
        'Vehicle' => array(
            'className' => 'Vehicle',
            'foreignKey' => 'VEHICLE_ID',
            'fields' => array('VEHICLE_NUMBER', 'ID'),
        ),
		
       
    );

	

    public function parentNode()
    {
        return null;
    }

  


     
    var $validate = array();


    function Validation()
    {
        $validate1 = array(
           'VEHICLE_ID' => array(
                'mustBeLonger' => array(
                   'rule' => array('comparison', '>', 0),
                    'message' => 'Please Select Vehicle',
                    'last' => true),
            ),
			'AMOUNT' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'AMOUNT could not be blank',
                    'last' => true)
			),
			'DESCRIPTION' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'DESCRIPTION could not be blank',
                    'last' => true)
			),
        );
        $this->validate = $validate1;
        return $this->validates();
    }

    
}