<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class ResultXref extends AppModel
{
    public $name = 'ResultXref';
    public $useTable = 'exam_result_xref';
    public $primaryKey = 'RS_XREF_ID';
 

    var $validate = array();
 
    public $belongsTo = array(
		'Result' => array(
	    'className' => 'Result',
	    'foreignKey' => 'RS_ID',
	),
	'ExamXref'=>array(
		'className'=>'ExamXref',
		'foreignKey'=>'EX_REF_ID'
	),
	'Result'=>array(
		'className'=>'Result',
		'foreignKey'=>'RS_ID'
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