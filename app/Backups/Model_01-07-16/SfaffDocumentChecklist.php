<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class SfaffDocumentChecklist extends AppModel
{
    public $name = 'SfaffDocumentChecklist';
    public $useTable ='document_checklist_master';
    public $primaryKey = 'DOC_CHE_ID';
	
	
	function Validation()
    {
        $validate1 = array(
		'ROLE_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '!=', 0),
                    'message' => 'Please select Role',
                    'last' => true)
            ),
            'PROOF_NAME' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Proof Name Type could not be blank',
                    'last' => true),
            ),
			
        );
        $this->validate = $validate1;
        return $this->validates();
    }
	
	public $belongsTo = array(
        'Role' => array(
            'className' => 'Role',
            'foreignKey' => 'ROLE_ID',
            'fields' => array('ID', 'ROLE_NAME'),
        ),
        
    );
	
	 public function GetDocumentType()
    {
        $result = $this->find("all", array(
            'contain' => array(),
            'conditions' => array('STATUS' => 1),
            'fields' => array('DOC_CHE_ID', 'PROOF_NAME'),
            'order' => 'SfaffDocumentChecklist.DOC_CHE_ID asc'
        ));
        $type = array();
        $type[0] = 'Select Role';
        foreach ($result as $row) {
            $type[$row['SfaffDocumentChecklist']['DOC_CHE_ID']] = ucwords($row['SfaffDocumentChecklist']['PROOF_NAME']);
        }
        return $type;
    }

   
}
?>