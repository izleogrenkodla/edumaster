<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class FeeType extends AppModel
{
    public $name = 'FeeType';
    public $useTable = 'fees_type';
    public $primaryKey = 'FT_ID';

    function Validation()
    {
        $validate1 = array(
            'TITLE' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please Enter Title',
                    'last' => true)
            ),
        );
        $this->validate = $validate1;
        return $this->validates();
    }
	
	 public function getFeeTypeList()
    {
        $result = $this->find("all", array(
            'conditions' => array('STATUS' => 1),
            'contain' => array(),
            'fields' => array('FT_ID', 'TITLE'),
            'order' => 'FeeType.FT_ID asc'
        ));
        $FeeType = array();
        $FeeType[0] = 'Select FeeType';
        foreach ($result as $row) {
            $FeeType[$row['FeeType']['FT_ID']] = ucwords($row['FeeType']['TITLE']);
        }
        return $FeeType;
    }

public function getFeeTypeForAccounts() { 
		$result = $this->find("all", array(
				'contain' => array(),
				'fields' => array('FT_ID', 'TITLE'),
				'conditions'=>array(
						'FT_ID !='=>ADMISSION_FEE
					),
				'order' => 'FeeType.FT_ID asc'
			));
			$FeeType = array();
			$FeeType[""] = 'Select FeeType';
			foreach ($result as $row) {
				$FeeType[$row['FeeType']['FT_ID']] = ucwords($row['FeeType']['TITLE']);
			}
			return $FeeType;
	}// end fo functio

}