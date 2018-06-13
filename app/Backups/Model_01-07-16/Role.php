<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class Role extends AppModel
{
    public $name = 'Role';
    public $useTable = 'roles';
    public $primaryKey = 'ID';

    //var $actsAs = array('Acl' => 'requester');

    public function parentNode()
    {
        return null;
    }

    var $validate = array();

    public $hasMany = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'ROLE_ID'
        )
    );


    function Validation()
    {
        $validate1 = array(
            'ROLE_NAME' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Role Name could not be blank',
                    'last' => true),
                'mustBeLonger' => array(
                    'rule' => array('minLength', 2),
                    'message' => 'Role Name must be greater than 1 character',
                    'last' => true),
            ),
        );
        $this->validate = $validate1;
        return $this->validates();
    }

    public function GetRoles()
    {
        $result = $this->find("all", array(
            'contain' => array(),
            'conditions' => array('STATUS' => 1),
            'fields' => array('ID', 'ROLE_NAME'),
            'order' => 'Role.ID asc'
        ));
        $roles = array();
        $roles[0] = 'Select Role';
        foreach ($result as $row) {
            $roles[$row['Role']['ID']] = ucwords($row['Role']['ROLE_NAME']);
        }
        return $roles;
    }
}