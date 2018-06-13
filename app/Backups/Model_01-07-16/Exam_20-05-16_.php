<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class Exam extends AppModel
{
    public $name = 'Exam';
    public $useTable = 'examination';
    public $primaryKey = 'EX_ID';
 
    //var $actsAs = array('Acl' => 'requester');

  public $hasMany = array(
    'ExamXref' => array(
        'className' => 'ExamXref',
        'foreignKey' => 'EX_ID',
        )
    );


    var $validate = array();

    public $belongsTo = array(
        'AcademicClass' => array(
            'className' => 'AcademicClass',
            'fields'=>array('AcademicClass.CLASS_ID','AcademicClass.CLASS_NAME'),
            'foreignKey' => 'CLASS_ID'
        ),
	'Subject' => array(
            'className' => 'Subject',
            'foreignKey' => 'SUBJECT_ID'
        ),
	'User' => array(
            'className' => 'User',
            'foreignKey' => 'SUPERVISOR_ID',
		'fields'=>array('User.FIRST_NAME','User.MIDDLE_NAME','User.LAST_NAME'),
        ),
	'Supervisor' => array(
            'className' => 'User',
            'foreignKey' => 'SUPERVISOR_ID',
			'fields'=>array('Supervisor.FIRST_NAME','Supervisor.MIDDLE_NAME','Supervisor.LAST_NAME'),
        ),
	'ExamType' => array(
            'className' => 'ExamType',
            'foreignKey' => 'EXAM_TYPE_ID',
	    'fields'=>array('ExamType.TITLE'),
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
			'SUPERVISOR_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '!=', 0),
                    'message' => 'Supervisor could not be blank',
                    'last' => true)
            ),
			'START_DATE' => array(
                'mustNotEmpty' => array(
                    'rule' => array('notEmpty'),
                    'message' => 'Start Date could not be blank',
                    'last' => true)
            ),
			'END_DATE' => array(
                'mustNotEmpty' => array(
                    'rule' => array('notEmpty'),
                    'message' => 'End Date could not be blank',
                    'last' => true)
            ),	
			
			'EXAM_TYPE_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('notEmpty'),
                    'message' => 'Exam Type could not be blank',
                    'last' => true)
            ),	
			'STUDENT_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('notEmpty'),
                    'message' => 'Student could not be blank',
                    'last' => true)
            ),	
			'PUBLISH_DATE' => array(
                'mustNotEmpty' => array(
                    'rule' => array('notEmpty'),
                    'message' => 'Publish Date could not be blank',
                    'last' => true)
            ),	
        );
        $this->validate = $validate1;
        return $this->validates();
    }
}