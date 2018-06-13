<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class BloodGroup extends AppModel
{
    public $name = 'BloodGroups';
    public $useTable = 'blood_group';
    public $primaryKey = 'BLOOD_GROUP_ID';

    //var $actsAs = array('Acl' => 'requester');

    public function parentNode()
    {
        return null;
    }

    var $validate = array();

    public $hasMany = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'BLOOD_GROUP_ID',
            'fields' => array('BLOOD_GROUP_ID', 'BLOOD_GROUP_NAME'),
            
        )
    );


    function Validation()
    {
        $validate1 = array(
            'BLOOD_GROUP_NAME' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Blood Group could not be blank',
                    'last' => true),
                'mustBeLonger' => array(
                    'rule' => array('minLength', 2),
                    'message' => 'Blood Group must be greater than 1 character',
                    'last' => true),
            ),
        );
        $this->validate = $validate1;
        return $this->validates();
    }

    public function GetBloodGroups()
    {
        $result = $this->find("all", array(
            'contain' => array(),
            'conditions' => array('STATUS' => 1),
            'fields' => array('BLOOD_GROUP_ID', 'BLOOD_GROUP_NAME'),
            'order' => 'BloodGroup.BLOOD_GROUP_NAME asc'
        ));
        $BloodGroup = array();
        $BloodGroup[0] = 'Select Blood Group';
        foreach ($result as $row) {
            $BloodGroup[$row['BloodGroup']['BLOOD_GROUP_ID']] = ucwords($row['BloodGroup']['BLOOD_GROUP_NAME']);
        }
        return $BloodGroup;
    }
}