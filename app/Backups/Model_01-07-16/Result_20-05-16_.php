<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class Result extends AppModel
{
    public $name = 'Result'; 
    public $useTable = 'exam_results';
    public $primaryKey = 'RS_ID';
 
    //var $actsAs = array('Acl' => 'requester');

 

    var $validate = array();

	public $belongsTo = array(
	'Exam' => array(
            'className' => 'Exam',
            'foreignKey' => 'EX_ID',
            'fields'=>array('Exam.EX_ID','Exam.EXAM_TYPE_ID','Exam.CLASS_ID','Exam.SUPERVISOR_ID','Exam.START_DATE','Exam.END_DATE'),
        ),
		'Student' => array(
            'className' => 'User',
            'foreignKey' => 'STUDENT_ID',
			'fields'=>array('Student.FIRST_NAME','Student.MIDDLE_NAME','Student.LAST_NAME'),
        ),
		
    );
    
    public $hasMany = array(
	'ResultXref' => array(
            'className' => 'ResultXref',
            'foreignKey' => 'RS_ID',
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
			
					
			
        );
        $this->validate = $validate1;
        return $this->validates();
    }
}