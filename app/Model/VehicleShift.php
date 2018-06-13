<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class VehicleShift extends AppModel
{
    public $name = 'VehicleShift';
    public $useTable ='transportation_vehicle_shift_master';
    public $primaryKey = 'SHIFT_ID';
	
	
	
    //var $actsAs = array('Acl' => 'requester');

    public function parentNode()
    {
        return null;
    }

    var $validate = array();


    function Validation()
    {
        $validate1 = array(
            'VEHICLE_SHIFT_TYPE' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Vehicle Shift could not be blank',
                    'last' => true),
                'mustBeLonger' => array(
                    'rule' => array('minLength', 2),
                    'message' => 'Vehicle Shift must be greater than 1 character',
                    'last' => true),
            ),
        );
        $this->validate = $validate1;
        return $this->validates();
    }

    public function GetVehicleShift()
    {
        $result = $this->find("all", array(
            'contain' => array(),
            'order' => 'VehicleShift.VEHICLE_SHIFT_TYPE asc'
        ));
        $VehicleShift = array();
        $VehicleShift[0] = 'Select Shift';
        foreach ($result as $row) {
            $VehicleShift[$row['VehicleShift']['SHIFT_ID']] = ucwords($row['VehicleShift']['VEHICLE_SHIFT_TYPE']);
        }
        return $VehicleShift;
    }
}