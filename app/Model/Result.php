<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class Result extends AppModel
{
    public $name = 'Result'; 
    public $useTable = 'exam_results';
    public $primaryKey = 'RESULT_ID';
 
    //var $actsAs = array('Acl' => 'requester');

    var $validate = array();

	public $belongsTo = array(
		'ExamGrade' => array(
			'className' => 'ExamGrade',
			'foreignKey' => 'GRADE_ID',
			'fields'=>array('ExamGrade.GRADE_ID','ExamGrade.GRADE_NAME'),
        ),
		'ExamRemark' => array(
			'className' => 'ExamRemark',
			'foreignKey' => 'EXAM_RE_ID',
			'fields'=>array('ExamRemark.EXAM_RE_ID','ExamRemark.REMARK'),
        ),
		'ExamType' => array(
			'className' => 'ExamType',
			'foreignKey' => 'EXAM_TYPE_ID',
			'fields'=>array('ExamType.TITLE','ExamType.EX_TYPE_ID'),
        ),
		'Subject' => array(
            'className' => 'Subject',
            'foreignKey' => 'SUBJECT_ID',
            'fields' => array('SUBJECT_ID', 'TITLE'),
        ),
		'ExamGrade' => array(
			'className' => 'ExamGrade',
			'foreignKey' => 'GRADE_ID',
			'fields'=>array('ExamGrade.GRADE_ID','ExamGrade.GRADE_NAME'),
        ),
    );
    
    /*public $hasMany = array(
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
    }*/
}