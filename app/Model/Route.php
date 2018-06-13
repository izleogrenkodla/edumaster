<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class Route extends AppModel
{
    public $name = 'Route';
    public $useTable ='transportation_route_master';
    public $primaryKey = 'ROUTE_ID';

    //var $actsAs = array('Acl' => 'requester');

    public function parentNode()
    {
        return null;
    }

    var $validate = array();


    function Validation()
    {
        $validate1 = array(
            'ROUTE_NAME' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'ROUTE NAME  could not be blank',
                    'last' => true),
                'mustBeLonger' => array(
                    'rule' => array('minLength', 2),
                    'message' => 'ROUTE NAME  must be greater than 1 character',
                    'last' => true),
            ),
			 'FROM_PLACE' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'From Place  could not be blank',
                    'last' => true),
                'mustBeLonger' => array(
                    'rule' => array('minLength', 2),
                    'message' => 'From Place must be greater than 1 character',
                    'last' => true),
            ),
			 'TO_PLACE' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'To Place  could not be blank',
                    'last' => true),
                'mustBeLonger' => array(
                    'rule' => array('minLength', 2),
                    'message' => 'To Place must be greater than 1 character',
                    'last' => true),
            ),
			'TIMING' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'TIMING  could not be blank',
                    'last' => true),
                'mustBeLonger' => array(
                    'rule' => array('minLength', 2),
                    'message' => 'TIMING must be greater than 1 character',
                    'last' => true),
            ),
			'ROUTE_FEE' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'ROUTE FEE  could not be blank',
                    'last' => true),
                'mustBeLonger' => array(
                    'rule' => array('minLength', 2),
                    'message' => 'ROUTE_FEE must be greater than 1 character',
                    'last' => true),
            ),
			
        );
        $this->validate = $validate1;
        return $this->validates();
    }

	 public function GetRoute()
    {
        $result = $this->find("all", array(
            'contain' => array(),
            'order' => 'Route.ROUTE_NAME  asc'
        ));
        $Route = array();
        $Route[0] = 'Select Route';
        foreach ($result as $row) {
            $Route[$row['Route']['ROUTE_ID']] = ucwords($row['Route']['ROUTE_NAME']);
        }
        return $Route;
    }
   
}