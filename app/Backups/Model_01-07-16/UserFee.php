<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class UserFee extends AppModel
{
    public $name = 'UserFee';
    public $useTable ='transportation_route_fee';
    public $primaryKey = 'ROUTE_FEE_ID';

    //var $actsAs = array('Acl' => 'requester');
	
	 public $belongsTo = array(
        'VehicleShift' => array(
            'className' => 'VehicleShift',
            'foreignKey' => 'SHIFT_ID',
            'fields' => array('SHIFT_ID', 'VEHICLE_SHIFT_TYPE'),
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
		'Stoppage' => array(
            'className' => 'Stoppage',
            'foreignKey' => 'STOPPAGE_ID',
            'fields' => array('STOPPAGE_ID', 'STOPPAGE_NAME'),
        ),
		'User' => array(
            'className' => 'User',
            'foreignKey' => 'STUDENT_ID',
            'fields' => array('ID', 'FIRST_NAME','MIDDLE_NAME','LAST_NAME'),
        ),
    );

    public function parentNode()
    {
        return null;
    }

 
}