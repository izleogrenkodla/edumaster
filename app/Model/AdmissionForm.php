<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class AdmissionForm extends AppModel
{
    public $name = 'AdmissionForms';
    public $useTable = 'admission_forms';
    public $primaryKey = 'FORM_ID';

    public $belongsTo = array(
        'AcademicClass' => array(
            'className' => 'AcademicClass',
            'foreignKey' => 'CLASS_ID',
            'fields' => array('CLASS_ID', 'CLASS_NAME'),
        ),
        'Medium' => array(
            'className' => 'Medium',
            'foreignKey' => 'MEDIUM_ID',
            'fields' => array('MEDIUM_ID', 'MEDIUM_NAME'),
        ),
        'FormType' => array(
            'className' => 'FormType',
            'foreignKey' => 'FORM_TYPE_ID',
            'fields' => array('FORM_TYPE_ID', 'FORM_TYPE_NAME'),
        )
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
            'FORM_TYPE_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '!=', 0),
                    'message' => 'Please select Form Type',
                    'last' => true)
            ),
            'MEDIUM_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '!=', 0),
                    'message' => 'Please select Medium',
                    'last' => true)
            ),
'UPLOAD_PDF' => array(
				'mustNotEmpty' => array(
                    'rule' => array('uploadFile'),
                    'message' => 'PDF could not be blank',
					'on' => 'create',
                    'last' => true),
                'extension' => array(
                    'rule' => array('valid_extentions',array("extentions"=>'pdf',"size"=>ALLOWED_SIZE)),
                    'message' => 'You must upload valid file',
                    'last'=>true
                 ),
            ),
        );
        $this->validate = $validate1;
        return $this->validates();
    }

}