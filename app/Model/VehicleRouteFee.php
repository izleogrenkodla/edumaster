<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class VehicleRouteFee extends AppModel
{
    public $name = 'VehicleRouteFee';
    public $useTable = 'transportation_route_fee';
    public $primaryKey = 'ID';

   public $belongsTo = array(
        'Vehicle' => array(
            'className' => 'Vehicle',
            'foreignKey' => 'VEHICLE_ID',
            'fields' => array('ID', 'VEHICLE_NUMBER'),
        ),
		'Users' => array(
            'className' => 'Users',
            'foreignKey' => 'STUDENT_ID',
            'fields' => array('ID','FIRST_NAME', 'MIDDLE_NAME' ,'LAST_NAME'),
        ),
      
    );

}