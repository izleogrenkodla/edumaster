<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class ExamWritten extends AppModel
{
    public $name = 'ExamWritten';
    public $useTable = 'exam_written';
    public $primaryKey = 'WRITTEN_ID';

    function Validation()
    {
       $validate1 = array(
           'CLASS_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '!=', 0),
                    'message' => 'Class could not be blank',
                    'last' => true)
            ),
			'EXAM_TYPE_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '!=', 0),
                    'message' => 'Exam Type could not be blank',
                    'last' => true)
            ),
			'MARK' => array(
                'mustNotEmpty' => array(
                    'rule' => array('notEmpty'),
                    'message' => 'Mark could not be blank',
                    'last' => true)
            ),	

			
        );
        $this->validate = $validate1;
        return $this->validates();
    }
	
	
	 public $belongsTo = array(
        'AcademicClass' => array(
            'className' => 'AcademicClass',
            'fields'=>array('AcademicClass.CLASS_ID','AcademicClass.CLASS_NAME'),
            'foreignKey' => 'CLASS_ID'
        ),
		'ExamType' => array(
			'className' => 'ExamType',
			'foreignKey' => 'EXAM_TYPE_ID',
			'fields'=>array('ExamType.TITLE','ExamType.EX_TYPE_ID'),
        ),
		'Subject' => array(
            'className' => 'Subject',
            'foreignKey' => 'SUBJECT_ID'
			//'fields'=>array('subjects.SUBJECT_ID','subjects.TITLE'),
        ),
    );
}