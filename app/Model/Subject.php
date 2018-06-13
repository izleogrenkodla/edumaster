<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class Subject extends AppModel
{
    public $name = 'Subject';
    public $useTable = 'subjects';
    public $primaryKey = 'SUBJECT_ID';

    public $belongsTo = array(
        'AcademicClass' => array(
            'className' => 'AcademicClass',
            'foreignKey' => 'CLASS_ID',
            'fields' => array('CLASS_ID', 'CLASS_NAME'),
        ),
    );

    function Validation()
    {
        $validate1 = array(
            'TITLE' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please Enter Title',
                    'last' => true)
            ),
            'CLASS_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '!=', 0),
                    'message' => 'Please select Class',
                    'last' => true)
            ),
        );
        $this->validate = $validate1;
        return $this->validates();
    }
    
    public function GetSubjects()
    {
        $result = $this->find("all", array(
            'contain' => array(),
            'conditions' => array('STATUS' => 1),
            'fields' => array('SUBJECT_ID', 'TITLE', 'CO_CURRICULAR'),
            'order' => 'Subject.TITLE desc'
        ));
        $subject = array();
        $subject[0] = 'Select Subject';
        foreach ($result as $row) {
            $subject[$row['Subject']['SUBJECT_ID']] = ucwords($row['Subject']['TITLE']);
        }
        return $subject;
    }

}