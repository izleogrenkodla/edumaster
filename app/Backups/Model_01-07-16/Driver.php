<?php
class Driver extends AppModel
{
    public $name = 'Driver';
    public $useTable = 'drivers';
    public $primaryKey = 'DRIVER_ID';

    function Validation()
    {
        $validate1 = array(
            'FIRST_NAME' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'First name could not be blank',
                    'last' => true)
            ),
            'MIDDLE_NAME' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Middle name could not be blank',
                    'last' => true)
            ),
            'LAST_NAME' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Last name could not be blank',
                    'last' => true)
            ),
            'MOBILE_NO' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please Enter Mobile No',
                    'last' => true),
                'minlength' => array(
                    'rule' => array('minLength', '10'),
                    'message' => 'Please enter Valid Contact Number',
                    'last' => true),
                'Numeric' => array(
                    'rule' => 'numeric',
                    'message' => 'Please enter Valid Contact Number',
                    'last' => true),

            ),
            'UPLOAD_IMAGE' => array(
                'mustNotEmpty' => array(
                    'rule' => array('uploadFile'),
                    'message' => 'User Profile file could not be blank',
                    'last' => true),
                'extension' => array(
                    'rule' => array('valid_extentions',array("extentions"=>ALLOWED_EXT,"size"=>ALLOWED_SIZE)),
                    'message' => 'You must upload valid file',
                    'last'=>true
                ),
            ),
            'ADDRESS' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Address could not be blank',
                    'last' => true)
            ),

        );
        $this->validate = $validate1;
        return $this->validates();
    }
    
    public function GetDrivers()
    {
        $result = $this->find("all", array(
            'contain' => array(),
            'conditions' => array('STATUS' => 1),
            'fields' => array('DRIVER_ID', 'FIRST_NAME', 'MIDDLE_NAME', 'LAST_NAME'),
            'order' => 'Driver.DRIVER_ID ASC'
        ));
        $drivers = array();
        $drivers[0] = 'Select Driver';
        foreach ($result as $row) {
            $drivers[$row['Driver']['DRIVER_ID']] = $row['Driver']['FIRST_NAME'].' '.$row['Driver']['MIDDLE_NAME'].' '.$row['Driver']['LAST_NAME'];
        }
        return $drivers;
    }

}