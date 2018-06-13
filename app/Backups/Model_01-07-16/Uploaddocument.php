<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class Uploaddocument extends AppModel
{
    public $name = 'Uploaddocument';
    public $useTable = 'upload_document';
    public $primaryKey = 'UPLOAD_DOC_ID';

  var $belongsTo = array(
        'AppAdmission' => array(
            'className' => 'AppAdmission',
            'foreignKey' => 'INQUIRY_ID',
			'fields' => array('INQUIRY_ID', 'STUDENT_NAME'),
        ),
    );
	
	function Validation()
    {
        $validate1 = array(
           
			 'UPLOAD_DOC' => array(
				 'mustNotEmpty' => array(
                    'rule' => array('uploadFile'),
                    'message' => 'Document could not be blank',
                    'on'=>"create",
                    'last' => true),
                 'extension' => array(
                    'on'=>"create",
                    'message' => 'You must upload valid file',
                    'last'=>true
                 ),
            ),
			
        );
        $this->validate = $validate1;
        return $this->validates();
    }
	
	function edit_Validation()
    {
        $validate1 = array(
            'INQUIRY_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Student could not be blank',
                    'last' => true),
            ),
			'UPLOAD_DOC' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Document could not be blank',
                    'last' => true),
            ),
			 
			
        );
        $this->validate = $validate1;
        return $this->validates();
    }
	
	
}

?>