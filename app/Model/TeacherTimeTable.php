<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class TeacherTimeTable extends AppModel
{ 
    public $name = 'TeacherTimeTable';  
    public $useTable = 'dailytimetables';
    public $primaryKey = 'TT_ID';
	
	public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'TEACHER_ID',
            'fields' => array('ID', 'FIRST_NAME','MIDDLE_NAME','LAST_NAME'),
        ),
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
            'TEACHER_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please select teacher',
                    'last' => true)
            ),
            'SUBJECT_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'End Date could not be blank',
                    'last' => true)
            ),
            'TT_DATE' => array(
               'mustNotEmpty' => array(
                    'rule' => array('comparison', '!=', ''),
                    'message' => 'Please select Week',
                    'last' => true)
            ),
			'START_TIME' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please select Start Time',
                    'last' => true)
            ),
			'END_TIME' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please select End Time',
                    'last' => true)
            ),
			
			
        );
        $this->validate = $validate1;
        return $this->validates();
    }

}