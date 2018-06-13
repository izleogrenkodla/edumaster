<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class FormDistribution extends AppModel
{
    public $name = 'FormDistribution';
    public $useTable ='form_distribution';
    public $primaryKey = 'FOR_ID';
	
	 public $belongsTo = array(
		'Name' => array(
            'className' => 'AppAdmission',
            'foreignKey' => 'INQUIRY_ID',
            'fields' => array('STUDENT_NAME'),
        ),
		 'AcademicClass' => array(
            'className' => 'AcademicClass',
            'foreignKey' => 'CLASS_ID',
            'fields' => array('CLASS_ID', 'CLASS_NAME'),
        ),
      
    );
	
}
?>