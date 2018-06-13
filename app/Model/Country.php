<?php
// app/Model/User.php
App::uses('AppModel', 'Model');
class Country extends AppModel
{
    public $name = 'Country';
    public $useTable = 'country';
    public $primaryKey = 'COUNTRY_ID';

    var $validate = array();

	function Validation()
    {
        $validate1 = array(
            'COUNTRY_NAME' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Country could not be blank',
                    'last' => true),
                'mustBeLonger' => array(
                    'rule' => array('minLength', 2),
                    'message' => 'Country must be greater than 1 character',
                    'last' => true),
            ),
        );
        $this->validate = $validate1;
        return $this->validates();
    }
	
    public function GetCountries($default = null)
    {
        $result = $this->find("all", array(
            'contain' => array(),
            'conditions' => array('STATUS' => 1),
            'order' => 'COUNTRY_NAME ASC',
            'fields' => array('COUNTRY_ID', 'COUNTRY_NAME')));
        $country = array();
        if ($default == null) {
            //$country[''] = 'Select Country';
        } else {
            //$country[''] = $default;
        }
        foreach ($result as $row) {
            $country[$row['Country']['COUNTRY_ID']] = ucwords($row['Country']['COUNTRY_NAME']);
        }
        return $country;
    }
}