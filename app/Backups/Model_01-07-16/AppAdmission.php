<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class AppAdmission extends AppModel
{
    public $name = 'AppAdmission';
    public $useTable = 'app_admission';
    public $primaryKey = 'INQUIRY_ID';
	
	
	public $belongsTo = array(
        'AcademicClass' => array(
            'className' => 'AcademicClass',
            'foreignKey' => 'CLASS_ID',
            'fields' => array('CLASS_ID', 'CLASS_NAME')
        ),
		'Medium' => array(
            'className' => 'Medium',
            'foreignKey' => 'MEDIUM_ID',
            'fields' => array('MEDIUM_ID', 'MEDIUM_NAME'),
        )
        
    );
	
	 function Validation()
    {
        $validate1 = array(
			'STUDENT_NAME' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Student Name could not be blank',
                    'last' => true),
            ),
			'FATHER_NAME' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Father Name could not be blank',
                    'last' => true),
            ),
			'AGE' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Age could not be blank',
                    'last' => true),
            ),
            'CLASS_ID' => array(
                'mustNotEmpty' => array(
                   'rule' => array('comparison', '!=', 0),
                    'message' => 'Class Name could not be blank',
                    'last' => true),
            ),
			'MEDIUM_ID' => array(
                'mustNotEmpty' => array(
                   'rule' => array('comparison', '!=', 0),
                    'message' => 'Medium Name could not be blank',
                    'last' => true),
            ),
			'MOBILE_NO' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Mobile Number could not be blank',
                    'last' => true),
            ),
			'EMAIL' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'E-Mail could not be blank',
                    'last' => true),
            ),
			'ADDRESS' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Address could not be blank',
                    'last' => true),
            ),
        );
        $this->validate = $validate1;
        return $this->validates();
    }
	
	 public function GetName($default = null)
    {
        $result = $this->find("all", array(
            'contain' => array(),
            'conditions' => array('INQ_STATUS'=>1),
           // 'order' => 'STATE_NAME ASC',
            'fields' => array('INQUIRY_ID', 'STUDENT_NAME', 'FATHER_NAME')));
        $state = array();
        if ($default == null) {
            //$state[''] = 'Select Name';
        } else {
            //$state[''] = $default;
        }
        foreach ($result as $row) {
            $state[$row['AppAdmission']['INQUIRY_ID']] = ($row['AppAdmission']['STUDENT_NAME']
			.' '.ucwords($row['AppAdmission']['FATHER_NAME']));
        }
        return $state;
    }


}
