<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class Homework extends AppModel
{ 
    public $name = 'Homeworks';
    public $useTable = 'homework';
    public $primaryKey = 'HW_ID';
	
	public $belongsTo = array(
        'AcademicClass' => array(
            'className' => 'AcademicClass',
            'foreignKey' => 'CLASS_ID',
            'fields' => array('CLASS_ID', 'CLASS_NAME'),
        ),
        'Subject' => array(
            'className' => 'Subject',
            'foreignKey' => 'SUBJECT_ID',
            'fields' => array('SUBJECT_ID', 'TITLE'),
        ),
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'TEACHER_ID',
            'fields' => array('ID','FIRST_NAME', 'MIDDLE_NAME', 'LAST_NAME','EMAIL_ID'),
        ),
    );

    public $hasMany = array(
        'HomeworkXref' => array(
            'className' => 'HomeworkXref',
            'foreignKey' => 'HW_ID',
        ),
    );
    

    function Validation()
    {
        $validate1 = array(
           'CLASS_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '!=', 0),
                    'message' => 'Please select Class',
                    'last' => true)
            ),
            'SUBJECT_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '!=', 0),
                    'message' => 'Please select Subject',
                    'last' => true)

            ),
            'DATE' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please select Start Date',
                    'last' => true)
            ),
			'SUBMISSION_DATE' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please select Submission Date',
                    'last' => true)
            ),
			'DESCRIPTION' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter Narration',
                    'last' => true)
            ),
			
			
        );
        $this->validate = $validate1;
        return $this->validates();
    }

}