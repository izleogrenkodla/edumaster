<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class EventParticipant extends AppModel
{
    public $name = 'EventParticipant';
    public $useTable = 'event_participant';
    public $primaryKey = 'PARTICIPANT_ID';

    //var $actsAs = array('Acl' => 'requester');

     public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'STUDENT_ID',
            'fields' => array('ID', 'FIRST_NAME','LAST_NAME'),
        ),
        'Event' => array(
            'className' => 'Event',
            'foreignKey' => 'EVENT_ID',
            'fields' => array('EVENT_ID', 'EVENT_TITLE'),
        ),
        'AcademicClass' => array(
            'className' => 'AcademicClass',
            'foreignKey' => 'CLASS_ID',
            'fields' => array('CLASS_ID', 'CLASS_NAME'),
        ),

       
    );

    public function parentNode()
    {
        return null;
    }

    var $validate = array();

   


    function Validation()
    {
        $validate1 = array(
            'EVENT_ID' => array(
                'mustNotEmpty' => array(
                   'rule' => array('comparison', '>', 0),
                    'message' => 'Please Select Event',
                    'last' => true),
            ),
              'CLASS_ID' => array(
                'mustNotEmpty' => array(
                   'rule' => notEmpty,
                    'rule' => array('comparison', '>', 0),
                    'message' => 'Please Select Class',
                    'last' => true),
            ),
              'STUDENT_ID' => array(
                'mustNotEmpty' => array(
                   'rule' => array('comparison', '>', 0),
                    'message' => 'Please Select Student',
                    'last' => true),
            ),
        );
        $this->validate = $validate1;
        return $this->validates();
    }

    
}