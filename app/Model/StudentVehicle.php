<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class StudentVehicle extends AppModel
{
    public $name = 'StudentVehicle';
    public $useTable ='transportation_route_fee';
    public $primaryKey = 'ROUTE_FEE_ID';

	 


    public function parentNode()
    {
        return null;
    }

    var $validate = array();


    function Validation(){
    
    }

	 public function GetVehicle()
    {
       
    }
    
}