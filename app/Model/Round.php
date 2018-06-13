<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class Round extends AppModel
{
    public $name = 'Round';
    public $useTable = 'admission_round_master';
    public $primaryKey = 'ROUND_ID';
	
	 function Validation()
    {
        $validate1 = array(
            'MEDIUM_NAME' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Round could not be blank',
                    'last' => true),
                'mustBeLonger' => array(
                    'rule' => array('minLength', 2),
                    'message' => 'Round must be greater than 1 character',
                    'last' => true),
            ),
        );
        $this->validate = $validate1;
        return $this->validates();
    }
	
	 public function GetRound()
    {
        $result = $this->find("all", array(
            'contain' => array(),
            'conditions' => array('STATUS' => 1),
            'fields' => array('ROUND_ID', 'ROUND_NAME'),
            'order' => 'Round.ROUND_NAME desc'
        ));
        $subject = array();
        $subject[0] = 'Select Round';
        foreach ($result as $row) {
            $subject[$row['Round']['ROUND_ID']] = ucwords($row['Round']['ROUND_NAME']);
        }
        return $subject;
    }

    
}
?>