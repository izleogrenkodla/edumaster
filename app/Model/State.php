<?php
// app/Model/User.php
App::uses('AppModel', 'Model');
class State extends AppModel
{
    public $name = 'State';
    public $useTable = 'state';
    public $primaryKey = 'STATE_ID';

    var $validate = array();

    var $belongsTo = array(
        'Country' => array(
            'className' => 'Country',
            'foreignKey' => 'COUNTRY_ID',
        ),
    );

	function Validation()
    {
        $validate1 = array(
            'STATE_NAME' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'State could not be blank',
                    'last' => true),
                'mustBeLonger' => array(
                    'rule' => array('minLength', 2),
                    'message' => 'State must be greater than 1 character',
                    'last' => true),
            ),
        );
        $this->validate = $validate1;
        return $this->validates();
    }
	
    public function GetStates($default = null)
    {
        $result = $this->find("all", array(
            'contain' => array(),
            'conditions' => array('STATUS' =>1),
            'order' => 'STATE_NAME ASC',
            'fields' => array('STATE_ID', 'STATE_NAME')));
        $state = array();
        if ($default == null) {
            //$state[''] = 'Select State';
        } else {
            //$state[''] = $default;
        }
        foreach ($result as $row) {
            $state[$row['State']['STATE_ID']] = ucwords($row['State']['STATE_NAME']);
        }
        return $state;
    }
}