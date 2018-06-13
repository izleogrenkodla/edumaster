<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class Vehicle extends AppModel
{
    public $name = 'Vehicle';
    public $useTable ='transportation_vehicle_master';
    public $primaryKey = 'ID';

	  public $belongsTo = array(
        'VehicleShift' => array(
            'className' => 'VehicleShift',
            'foreignKey' => 'VEHICLE_SHIFT_TYPE',
            'fields' => array('SHIFT_ID', 'VEHICLE_SHIFT_TYPE'),
        ),
		'VehicleType' => array(
            'className' => 'VehicleType',
            'foreignKey' => 'VEHICLE_TYPE_ID',
            'fields' => array('VEHICLE_TYPE_ID', 'VEHICLE'),
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
           'VEHICLE_TYPE_ID' => array(
                'mustBeLonger' => array(
                   'rule' => array('comparison', '>', 0),
                    'message' => 'Please Select Vehicle Type',
                    'last' => true),
            ),
			
			'VEHICLE_SHIFT_TYPE' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '>', 0),
                    'message' => 'Please Select Vehicle Shift',
                    'last' => true)
			),
			'VEHICLE_NUMBER' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Vehicle Number could not be blank',
                    'last' => true)
			),
			'NO_OF_SEATS' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Number of Seats could not be blank',
                    'last' => true)
			),
        );
        $this->validate = $validate1;
        return $this->validates();
    }

	 public function GetVehicle()
    {
        $result = $this->find("all", array(
            'contain' => array(),
            'order' => 'Vehicle.VEHICLE_NUMBER asc'
        ));
        $Vehicle = array();
        $Vehicle[0] = 'Select Vehicle';
        foreach ($result as $row) {
            $Vehicle[$row['Vehicle']['ID']] = ucwords($row['Vehicle']['VEHICLE_NUMBER']);
        }
        return $Vehicle;
    }
    
}