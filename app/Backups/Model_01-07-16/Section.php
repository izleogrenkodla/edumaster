<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class Section extends AppModel
{
    public $name = 'Section';
    public $useTable = 'section';
    public $primaryKey = 'ID';

    function Validation()
    {
        $validate1 = array(
            'SECTION' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Section Name could not be blank',
                    'last' => true),
                'mustBeLonger' => array(
                    'rule' => array('minLength', 2),
                    'message' => 'Section Name must be greater than 1 character',
                    'last' => true),
            ),
        );
        $this->validate = $validate1;
        return $this->validates();
    }

    public function GetSectiones()
    {
        $result = $this->find("all", array(
            'conditions' => array('STATUS' => 1),
            'contain' => array(),
            'fields' => array('ID', 'SECTION'),
            'order' => 'Section.ID asc'
        ));
        $Sectiones = array();
        $Sectiones[0] = 'Select Section';
        foreach ($result as $row) {
            $Sectiones[$row['Section']['ID']] = ucwords($row['Section']['SECTION']);
        }
        return $Sectiones;
    }
}