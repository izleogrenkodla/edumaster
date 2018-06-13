<?php
// app/Model/User.php
App::uses('AppModel', 'Model');
class Country extends AppModel
{
    public $name = 'Country';
    public $useTable = 'country';
    public $primaryKey = 'COUNTRY_ID';

    var $validate = array();

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