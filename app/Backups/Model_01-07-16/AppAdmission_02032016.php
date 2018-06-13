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
            'CLASS_NAME' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Class Name could not be blank',
                    'last' => true),
            ),
        );
        $this->validate = $validate1;
        return $this->validates();
    }


}
