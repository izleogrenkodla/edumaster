<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class ExamType extends AppModel
{
    public $name = 'ExamType';
    public $useTable = 'exam_types';
    public $primaryKey = 'EX_TYPE_ID';

  

    function Validation()
    {
        $validate1 = array(
            'CLASS_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '!=', 0),
                    'message' => 'Please select Class',
                    'last' => true)
            ),
            'EVENT_TITLE' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Event Title could not be blank',
                    'last' => true)
            ),
            'EVENT_START' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Event Start Date could not be blank',
                    'last' => true)
            ),
            'EVENT_END' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Event End Date could not be blank',
                    'last' => true)
            ),
            'EVENT_DESC' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Event Description could not be blank',
                    'last' => true)
            ),
            'UPLOAD_IMAGE' => array(
				 'mustNotEmpty' => array(
                    'rule' => array('uploadFile'),
                    'message' => 'Event Photo file could not be blank',
                    'last' => true),
                 'extension' => array(
                    'rule' => array('valid_extentions',array("extentions"=>ALLOWED_EXT,"size"=>ALLOWED_SIZE)),
                    'message' => 'You must upload valid file',
                    'last'=>true
                 ),
            ),
        );
        $this->validate = $validate1;
        return $this->validates();
    }
	
	 public function GetExamTypes()
    {
        $result = $this->find("all", array(
            'contain' => array(),
            'conditions' => array('STATUS' => 1),
            'fields' => array('EX_TYPE_ID', 'TITLE'),
            'order' => 'ExamType.EX_TYPE_ID asc'
        ));
        $types = array();
        $types[''] = 'Select ExamType';
        foreach ($result as $row) {
            $types[$row['ExamType']['EX_TYPE_ID']] = ucwords($row['ExamType']['TITLE']);
        }
        return $types;
    }
	
	

}