<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class FormType extends AppModel
{
    public $name = 'FormTypes';
    public $useTable = 'form_types';
    public $primaryKey = 'FORM_TYPE_ID';

    var $validate = array();

    function Validation()
    {
        $validate1 = array(
            'FORM_TYPE_NAME' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'form Type Name could not be blank',
                    'last' => true),
                'mustBeLonger' => array(
                    'rule' => array('minLength', 2),
                    'message' => 'form Type Name must be greater than 1 character',
                    'last' => true),
            ),
        );
        $this->validate = $validate1;
        return $this->validates();
    }

    public function GetFormTypes()
    {
        $result = $this->find("all", array(
            'contain' => array(),
            'conditions' => array('STATUS' => 1),
            'fields' => array('FORM_TYPE_ID', 'FORM_TYPE_NAME'),
            'order' => 'FORM_TYPE_ID asc'
        ));
        $formTypes = array();
        $formTypes[0] = 'Select Form Type';
        foreach ($result as $row) {
            $formTypes[$row['FormType']['FORM_TYPE_ID']] = ucwords($row['FormType']['FORM_TYPE_NAME']);
        }
        return $formTypes;
    }
}