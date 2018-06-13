<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class Stoppage extends AppModel
{
    public $name = 'Stoppage';
    public $useTable ='transportation_vehicle_stoppage_master';
    public $primaryKey = 'STOPPAGE_ID';

	 public $belongsTo = array(
        'Route' => array(
            'className' => 'Route',
            'foreignKey' => 'ROUTE_ID',
            'fields' => array('ROUTE_ID', 'ROUTE_NAME'),
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
           'ROUTE_ID' => array(
                'mustBeLonger' => array(
                   'rule' => array('comparison', '>', 0),
                    'message' => 'Please Select Route',
                    'last' => true),
            ),
			'STOPPAGE_NAME' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Stoppage Name could not be blank',
                    'last' => true)
			),
        );
        $this->validate = $validate1;
        return $this->validates();
    }

	 public function GetStoppage()
    {
        $result = $this->find("all", array(
           
        ));
        $Stoppage = array();
        $Stoppage[0] = 'Select Stoppage';
        foreach ($result as $row) {
            $Stoppage[$row['Stoppage']['STOPPAGE_ID']] = ucwords($row['Stoppage']['STOPPAGE_NAME']);
        }
        return $Stoppage;
    }
    
}

