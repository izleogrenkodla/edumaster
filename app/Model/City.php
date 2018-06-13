<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class City extends AppModel
{
    public $name = 'City';
    public $useTable = 'city';
    public $primaryKey = 'CITY_ID';

    //var $actsAs = array('Acl' => 'requester');

    public function parentNode()
    {
        return null;
    }

    var $validate = array();

    function Validation()
    {
        $validate1 = array(
            'CITY_NAME' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'City could not be blank',
                    'last' => true),
                'mustBeLonger' => array(
                    'rule' => array('minLength', 2),
                    'message' => 'City must be greater than 1 character',
                    'last' => true),
            ),
        );
        $this->validate = $validate1;
        return $this->validates();
    }

    var $belongsTo = array(
        'State' => array(
            'className' => 'State',
            'foreignKey' => 'STATE_ID',
        ),
    );

    public function GetCity()
    {
        $result = $this->find("all", array(
            'contain' => array(),
            'conditions' => array('STATUS' => 1),
            'fields' => array('CITY_ID', 'CITY_NAME'),
            'order' => 'City.CITY_ID asc'
        ));
        $city = array();
        $city[0] = 'Select City';
        foreach ($result as $row) {
            $city[$row['City']['CITY_ID']] = ucwords($row['City']['CITY_NAME']);
        }
        return $city;
    }
}