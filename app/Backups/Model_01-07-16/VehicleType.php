<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class VehicleType extends AppModel
{
    public $name = 'VehicleType';
    public $useTable ='transportation_vehicle_type_master';
    public $primaryKey = 'VEHICLE_TYPE_ID';

    //var $actsAs = array('Acl' => 'requester');

    public function parentNode()
    {
        return null;
    }

    var $validate = array();


    function Validation()
    {
        $validate1 = array(
            'VEHICLE' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Vehicle Type could not be blank',
                    'last' => true),
                'mustBeLonger' => array(
                    'rule' => array('minLength', 2),
                    'message' => 'Vehicle Type must be greater than 1 character',
                    'last' => true),
            ),
        );
        $this->validate = $validate1;
        return $this->validates();
    }

    public function GetVehicleType()
    {
        $result = $this->find("all", array(
            'contain' => array(),
            'order' => 'VehicleType.VEHICLE asc'
        ));
        $VehicleType = array();
        $VehicleType[0] = 'Select Vehicle';
        foreach ($result as $row) {
            $VehicleType[$row['VehicleType']['VEHICLE_TYPE_ID']] = ucwords($row['VehicleType']['VEHICLE']);
        }
        return $VehicleType;
    }
}