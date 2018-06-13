<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class ExamXref extends AppModel
{
    public $name = 'ExamXref';
    public $useTable = 'examination_xref';
    public $primaryKey = 'EX_REF_ID';
 
    //var $actsAs = array('Acl' => 'requester');



    var $validate = array();

    public $belongsTo = array(
        'Exam' => array(
            'className' => 'Exam',
            'foreignKey' => 'EX_ID'
        ),
		'Subject' => array(
            'className' => 'Subject',
            'foreignKey' => 'SUBJECT_ID',
            'fields'=>array('Subject.SUBJECT_ID','Subject.TITLE'),
        ),
		'User' => array(
            'className' => 'User',
            'foreignKey' => 'TEACHER_ID',
			'fields'=>array('User.FIRST_NAME','User.MIDDLE_NAME','User.LAST_NAME'),
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
			'CW_DATE' => array(
                'mustNotEmpty' => array(
                    'rule' => array('notEmpty'),
                    'message' => 'Date could not be blank',
                    'last' => true)
            ),	
					
			
        );
        $this->validate = $validate1;
        return $this->validates();
    }
}