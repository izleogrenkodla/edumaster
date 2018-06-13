<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class ExamGrade extends AppModel
{
    public $name = 'ExamGrade';
    public $useTable = 'exam_grade';
    public $primaryKey = 'GRADE_ID';

   function Validation()
    {
        $validate1 = array(
            'GRADE_NAME' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Grade Name could not be blank',
                    'last' => true),
            ),
			'SORT_ORDER' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Sort Order could not be blank',
                    'last' => true),
            ),
        );
        $this->validate = $validate1;
        return $this->validates();
    }
	
	
	/* public $belongsTo = array(
        'Section' => array(
            'className' => 'Section',
            'foreignKey' => 'SECTION_ID',
            'fields' => array('ID','SECTION'),
        )
    );*/

    public function GetExamGrade()
    {
        $result = $this->find("all", array(
            'conditions' => array('ExamGrade.STATUS' => 1),
            'contain' => array(),
            'fields' => array('GRADE_ID', 'GRADE_NAME'),
            'order' => 'ExamGrade.GRADE_ID asc'
        ));
        $ExamGrade = array();
        $ExamGrade[0] = 'Select Grade';
        foreach ($result as $row) {
            $ExamGrade[$row['ExamGrade']['GRADE_ID']] = ucwords($row['ExamGrade']['GRADE_NAME']);
        }
        return $ExamGrade;
    }
}