<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class VehicleAttendance extends AppModel
{
    public $name = 'VehicleAttendance';
    public $useTable = 'vehicle_attendence';
    public $primaryKey = 'ID';

	function Validation()
    {
        $validate1 = array();
        $this->validate = $validate1;
        return $this->validates();
    }
	
   public $belongsTo = array(
        'Vehicle' => array(
            'className' => 'Vehicle',
            'foreignKey' => 'VEHICLE_ID',
            'fields' => array('ID', 'VEHICLE_NUMBER'),
        ),
		'Name' => array(
            'className' => 'Users',
            'foreignKey' => 'USER_ID',
            'fields' => array('ID','FIRST_NAME', 'MIDDLE_NAME' ,'LAST_NAME'),
        ),
      
    );

}