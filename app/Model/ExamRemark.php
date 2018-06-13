<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class ExamRemark extends AppModel
{
    public $name = 'ExamRemark';
    public $useTable = 'exam_remark';
    public $primaryKey = 'EXAM_RE_ID';

   function Validation()
    {		
        $validate1 = array(
			'REMARK' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Remark could not be blank',
                    'last' => true),
            ),
        );
        $this->validate = $validate1;
        return $this->validates();
    }

    public function GetExamRemark()
    {
        $result = $this->find("all", array(
            'conditions' => array('ExamRemark.STATUS' => 1),
            'contain' => array(),
            'fields' => array('EXAM_RE_ID', 'REMARK'),
            'order' => 'ExamRemark.EXAM_RE_ID desc'
        ));
        $ExamRemark = array();
        $ExamRemark[0] = 'Select Remark';
        foreach ($result as $row) {
            $ExamRemark[$row['ExamRemark']['EXAM_RE_ID']] = ucwords($row['ExamRemark']['REMARK']);
        }
        return $ExamRemark;
    }
}