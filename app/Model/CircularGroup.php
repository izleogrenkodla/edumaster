<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class CircularGroup extends AppModel
{
    public $name = 'CircularGroup';
    public $useTable = 'Circular_Group';
    public $primaryKey = 'CIR_GR_ID';

    public $belongsTo = array(
        'AcademicClass' => array(
            'className' => 'AcademicClass',
            'foreignKey' => 'CLASS_ID',
            'fields' => array('CLASS_ID', 'CLASS_NAME'),
        ),
    );

    function Validation()
    {
        $validate1 = array(
            'TITLE' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please Enter Title',
                    'last' => true)
            ),
            'CLASS_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '!=', 0),
                    'message' => 'Please select Class',
                    'last' => true)
            ),
        );
        $this->validate = $validate1;
        return $this->validates();
    }
    
    public function GetCircularGroup()
    {
        $result = $this->find("all", array(
            'fields' => array('CIR_GR_ID', 'TITLE'),
            'order' => 'CircularGroup.TITLE desc',
			'group' => 'CircularGroup.TITLE'
        ));
        $CircularGroup = array();
        $CircularGroup[0] = 'Select Group';
        foreach ($result as $row) {
            $CircularGroup[$row['CircularGroup']['CIR_GR_ID']] = ucwords($row['CircularGroup']['TITLE']);
        }
        return $CircularGroup;
    }

}