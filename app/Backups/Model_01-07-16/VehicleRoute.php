<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class VehicleRoute extends AppModel
{
    public $name = 'VehicleRoute';
    public $useTable ='transportation_vehicle_route';
    public $primaryKey = 'ROUTE_RELATION_ID';

	   public $belongsTo = array(
        'VehicleShift' => array(
            'className' => 'VehicleShift',
            'foreignKey' => 'SHIFT_ID',
            'fields' => array('SHIFT_ID','VEHICLE_SHIFT_TYPE'),
        ),
		'Vehicle' => array(
            'className' => 'Vehicle',
            'foreignKey' => 'VEHICLE_ID',
            'fields' => array('ID', 'VEHICLE_NUMBER'),
        ),
		'Route' => array(
            'className' => 'Route',
            'foreignKey' => 'ROUTE_ID',
            'fields' => array('ROUTE_ID', 'ROUTE_NAME'),
        ),
		'Driver' => array(
            'className' => 'Driver',
            'foreignKey' => 'DRIVER_ID',
            'fields' => array('DRIVER_ID', 'FIRST_NAME', 'MIDDLE_NAME', 'LAST_NAME'),
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
           'VEHICLE' => array(
                'mustBeLonger' => array(
                   'rule' => array('comparison', '>', 0),
                    'message' => 'Please Select Vehicle',
                    'last' => true),
            ),
			     'SHIFT_ID' => array(
                'mustBeLonger' => array(
                   'rule' => array('comparison', '>', 0),
                    'message' => 'Please Select Shift',
                    'last' => true),
            ),
			
			'VEHICLE_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '>', 0),
                    'message' => 'Please Select Vehicle',
                    'last' => true)
			),
			'ROUTE_ID' => array(
                 'mustNotEmpty' => array(
                    'rule' => array('comparison', '>', 0),
                    'message' => 'Please Select Route',
                    'last' => true)
			),
			'VEHICLE_ROUTE_NAME' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Vehicle Route Name could not be blank',
                    'last' => true)
			),
        );
        $this->validate = $validate1;
        return $this->validates();
    }

	
}