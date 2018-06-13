<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class DepartureArrival extends AppModel
{
    public $name = 'DepartureArrival';
    public $useTable ='transportation_vehicle_departure_arrival';
    public $primaryKey = 'DEP_ARR_ID';

	  public $belongsTo = array(
        'VehicleShift' => array(
            'className' => 'VehicleShift',
            'foreignKey' => 'SHIFT_ID',
            'fields' => array('SHIFT_ID', 'VEHICLE_SHIFT_TYPE'),
        ),
		'Vehicle' => array(
            'className' => 'Vehicle',
            'foreignKey' => 'VEHICLE_ID',
            'fields' => array('VEHICLE_TYPE_ID', 'VEHICLE_NUMBER'),
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
			'SHIFT_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '>', 0),
                    'message' => 'Please Select Vehicle Shift',
                    'last' => true)
			),
			'VEHICLE_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '>', 0),
                    'message' => 'Please Select Vehicle',
                    'last' => true)
			),
			'DESCRIPTION' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'DESCRIPTION could not be blank',
                    'last' => true)
			),
			 'DATE' => array(
               'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please Select Date',
                    'last' => true)
			
			),
		);
        $this->validate = $validate1;
        return $this->validates();
    }

	
    
}