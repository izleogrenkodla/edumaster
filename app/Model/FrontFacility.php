<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class FrontFacility extends AppModel
{
    public $name = 'FrontFacility';
    public $useTable = 'front_facility';
    public $primaryKey = 'FACILITY_ID';

    //var $actsAs = array('Acl' => 'requester');

    public function parentNode()
    {
        return null;
    }

    var $validate = array();

   

    function Validation()
    {
        $validate1 = array(
            'TITLE' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Title could not be blank',
                    'last' => true),
               
            ),
             'DESCRIPTION' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Description could not be blank',
                    'last' => true),
               
            ),
        );
        $this->validate = $validate1;
        return $this->validates();
    }

   
}