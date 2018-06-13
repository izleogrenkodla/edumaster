<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class AcademicClass extends AppModel
{
    public $name = 'AcademicClasses';
    public $useTable = 'academic_class';
    public $primaryKey = 'CLASS_ID';

    function Validation()
    {
        $validate1 = array(
            'CLASS_NAME' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Class Name could not be blank',
                    'last' => true),
                'mustBeLonger' => array(
                    'rule' => array('minLength', 2),
                    'message' => 'Class Name must be greater than 1 character',
                    'last' => true),
            ),
        );
        $this->validate = $validate1;
        return $this->validates();
    }
	
	
	 public $belongsTo = array(
        'Section' => array(
            'className' => 'Section',
            'foreignKey' => 'SECTION_ID',
            'fields' => array('ID','SECTION'),
        )
    );

    public function GetAcademicClasses()
    {
        $result = $this->find("all", array(
            'conditions' => array('STATUS' => 1),
            'contain' => array(),
            'fields' => array('CLASS_ID', 'CLASS_NAME'),
            'order' => 'AcademicClass.CLASS_ID asc'
        ));
        $AcademicClasses = array();
        $AcademicClasses[0] = 'Select Academic Class';
        foreach ($result as $row) {
            $AcademicClasses[$row['AcademicClass']['CLASS_ID']] = ucwords($row['AcademicClass']['CLASS_NAME']);
        }
        return $AcademicClasses;
    }
}