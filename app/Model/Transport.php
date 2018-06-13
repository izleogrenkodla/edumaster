<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class Transport extends AppModel
{
    public $name = 'Transport';
    public $useTable = 'transports';
    public $primaryKey = 'TRANSPORT_ID';
    
    public $belongsTo = array(
        'Driver' => array(
            'className' => 'Driver',
            'foreignKey' => 'DRIVER_ID',
            'fields' => array('DRIVER_ID', 'FIRST_NAME', 'MIDDLE_NAME', 'LAST_NAME', 'MOBILE_NO', 'ADDRESS'),
        ),
    );
 
    function Validation()
    {
        $validate1 = array(
            'VEHICLE' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please Enter Vehicle Number',
                    'last' => true)
            ),
            'VEHICLE_NUMBER' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter Vehicle Number',
                    'last' => true)
            ),
			'DRIVER' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty', 
                    'message' => 'Please enter Driver Name',
                    'last' => true)
            ),
			'VEHICLE_FROM' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter Vehicle From',
                    'last' => true)
            ),
			'VEHICLE_END' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter Vehicle End',
                    'last' => true)
            ),
        );
        $this->validate = $validate1;
        return $this->validates();
    }
    
    public function GetTransport()
    {
        $result = $this->find("all", array(
            'contain' => array(),
            'conditions' => array('STATUS' => 1),
            'fields' => array('TRANSPORT_ID', 'VEHICLE_NUMBER'),
            'order' => 'Transport.VEHICLE_NUMBER asc'
        ));
        $transport = array();
        $transport[0] = 'Select Transport';
        foreach ($result as $row) {
            $transport[$row['Transport']['TRANSPORT_ID']] = ucwords($row['Transport']['VEHICLE_NUMBER']);
        }
        return $transport;
    }

}