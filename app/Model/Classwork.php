<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class Classwork extends AppModel
{
    public $name = 'Classwork';
    public $useTable = 'class_work';
    public $primaryKey = 'CW_ID';
 
    //var $actsAs = array('Acl' => 'requester');

    public function parentNode()
    {
        return null;
    }

    var $validate = array();

    public $belongsTo = array(
        'AcademicClass' => array(
            'className' => 'AcademicClass',
            'foreignKey' => 'CLASS_ID'
        ),
		'Subject' => array(
            'className' => 'Subject',
            'foreignKey' => 'SUBJECT_ID'
        ),
		'User' => array(
            'className' => 'User',
            'foreignKey' => 'TEACHER_ID',
			'fields'=>array('User.FIRST_NAME','User.MIDDLE_NAME','User.LAST_NAME'),
        ),
		
		
    );


    function Validation()
    {
        $validate1 = array(
           'CLASS_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '!=', 0),
                    'message' => 'Class could not be blank',
                    'last' => true)
            ),
			'SUBJECT_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '!=', 0),
                    'message' => 'Subject could not be blank',
                    'last' => true)
            ),
			'CW_DATE' => array(
                'mustNotEmpty' => array(
                    'rule' => array('notEmpty'),
                    'message' => 'Date could not be blank',
                    'last' => true)
            ),	
			'NARRATION' => array(
                'mustNotEmpty' => array(
                    'rule' => array('notEmpty'),
                    'message' => 'Narration could not be blank',
                    'last' => true)
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