<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class Medium extends AppModel
{
    public $name = 'Medium';
    public $useTable = 'medium';
    public $primaryKey = 'MEDIUM_ID';

    //var $actsAs = array('Acl' => 'requester');

    public function parentNode()
    {
        return null;
    }

    var $validate = array();

    public $hasMany = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'MEDIUM_ID',
            'fields' => array('id', 'ROLE_NAME'),
            
        )
    );


    function Validation()
    {
        $validate1 = array(
            'MEDIUM_NAME' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Medium could not be blank',
                    'last' => true),
                'mustBeLonger' => array(
                    'rule' => array('minLength', 2),
                    'message' => 'Medium must be greater than 1 character',
                    'last' => true),
            ),
        );
        $this->validate = $validate1;
        return $this->validates();
    }

    public function GetMedium()
    {
        $result = $this->find("all", array(
            'contain' => array(),
            'conditions' => array('STATUS' => 1),
            'fields' => array('MEDIUM_ID', 'MEDIUM_NAME'),
            'order' => 'Medium.MEDIUM_ID asc'
        ));
        $medium = array();
        $medium[0] = 'Select Medium';
        foreach ($result as $row) {
            $medium[$row['Medium']['MEDIUM_ID']] = ucwords($row['Medium']['MEDIUM_NAME']);
        }
        return $medium;
    }
}