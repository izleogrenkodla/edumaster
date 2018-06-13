<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class StaffUploadDocument extends AppModel
{
    public $name = 'StaffUploadDocument';
    public $useTable = 'upload_document_staff';
    public $primaryKey = 'UPL_DOC_ID';
    
	public $belongsTo = array(
        'Role' => array(
            'className' => 'Role',
            'foreignKey' => 'ROLE_ID',
            'fields' => array('ID', 'ROLE_NAME'),
        ),
		 'Document' => array(
            'className' => 'SfaffDocumentChecklist',
            'foreignKey' => 'PROOF_ID',
            'fields' => array('DOC_CHE_ID', 'PROOF_NAME'),
        ),
		'Name' => array(
            'className' => 'Users',
            'foreignKey' => 'USER_ID',
            'fields' => array('FIRST_NAME', 'MIDDLE_NAME' ,'LAST_NAME'),
        ),
    );
	
	function Validation()
    {
        $Validation = array(
            'PROOF_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '!=', 0),
                    'message' => 'Please select Proof Type',
                    'last' => true)
            ),
            'UPLOAD_DOC' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Upload Document could not be blank',
                    'last' => true)
            ),
        );
        $this->validate = $validate1;
        return $this->validates();
    }
	
}
