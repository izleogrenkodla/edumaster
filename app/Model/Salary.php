<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class Salary extends AppModel
{
    public $name = 'Salary';
    public $useTable = 'salary_master';
    public $primaryKey = 'SALARY_ID';

    public $belongsTo = array(
        'Role' => array(
            'className' => 'Role',
            'foreignKey' => 'ROLE_ID',
            'fields' => array('ID', 'ROLE_NAME'),
        ),
		'Name' => array(
            'className' => 'Users',
            'foreignKey' => 'USER_ID',
            'fields' => array('FIRST_NAME', 'MIDDLE_NAME' ,'LAST_NAME'),
        ),
      
    );

    function Validation()
    {

    }
}
?>