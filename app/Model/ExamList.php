<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class ExamList extends AppModel
{
    public $name = 'ExamList';
    public $useTable = 'exam_list';
    public $primaryKey = 'LIST_ID';
 
    //var $actsAs = array('Acl' => 'requester');


    var $validate = array();

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
            'foreignKey' => 'SUBJECT_ID',
            'fields' => array('SUBJECT_ID', 'TITLE', 'CO_CURRICULAR'),
        ),
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
			'EXAM_DATE' => array(
                'mustNotEmpty' => array(
                    'rule' => array('notEmpty'),
                    'message' => 'Exam Date could not be blank',
                    'last' => true)
            ),	
			'EXAM_TYPE_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('notEmpty'),
                    'message' => 'Exam Type could not be blank',
                    'last' => true)
            ),

			
        );
        $this->validate = $validate1;
        return $this->validates();
    }
	
	function MarkValidation()
    {
        
    }
	
	public function getStudent($class_id = null)
    {
        $result = $this->find("all", array(
            'contain' => array(),
            'fields' => array('ID', 'FIRST_NAME', 'LAST_NAME'),
            'conditions' => array('CLASS_ID' => $class_id,'ROLE_ID'=>STUDENT_ID),
            'order' => 'User.FIRST_NAME asc'
        ));
        $user = array();
        $user['0'] = 'Select Student';
        foreach ($result as $row) {
            $user[$row['User']['ID']] = ucwords($row['User']['FIRST_NAME']. ' ' . $row['User']['LAST_NAME']);
        }
        return $user;
    }

   
}