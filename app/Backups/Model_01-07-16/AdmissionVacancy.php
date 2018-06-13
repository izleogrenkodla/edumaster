<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class AdmissionVacancy extends AppModel
{
    public $name = 'AdmissionVacancy';
    public $useTable = 'admission_vacancy_master';
    public $primaryKey = 'ADM_VAC_ID';
	
	 var $belongsTo = array(
        'AcademicClass' => array(
            'className' => 'AcademicClass',
            'foreignKey' => 'CLASS_ID',
            'fields' => array('CLASS_ID', 'CLASS_NAME'),
        ),
	);
	
	   public function Validation() {
        $validate1 = array(
            'CLASS_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' =>  'Please select Class',
                    'last' => true),
            ),
            'NUM_VACANCY' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Number Of Vacancy could not be blank',
                    'last' => true),
            ),
            

        );
        $this->validate = $validate1;
        return $this->validates();
    }

}
?>