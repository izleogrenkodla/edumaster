<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class Event extends AppModel
{
    public $name = 'Events';
    public $useTable = 'event';
    public $primaryKey = 'EVENT_ID';

    public $belongsTo = array(
        'AcademicClass' => array(
            'className' => 'AcademicClass',
            'foreignKey' => 'CLASS_ID',
            'fields' => array('CLASS_ID', 'CLASS_NAME'),
        )
    );

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
	
	public function GetEvent()
    {
        $result = $this->find("all", array(
            'contain' => array(),
            'fields' => array('EVENT_ID', 'EVENT_TITLE'),
            'order' => 'Event.EVENT_TITLE asc'
        ));
        $Event = array();
        $Event[0] = 'Select Event';
        foreach ($result as $row) {
            $Event[$row['Event']['EVENT_ID']] = ucwords($row['Event']['EVENT_TITLE']);
        }
        return $Event;
    }

}