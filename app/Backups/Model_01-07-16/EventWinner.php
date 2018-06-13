<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class EventWinner extends AppModel
{
    public $name = 'EventWinner';
    public $useTable = 'event_winner';
    public $primaryKey = 'WINNER_ID';

    //var $actsAs = array('Acl' => 'requester');

     public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'STUDENT_ID',
            'fields' => array('ID', 'FIRST_NAME','LAST_NAME','CLASS_ID'),
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
              'WINNING_POSITION' => array(
                'mustNotEmpty' => array(
                   'rule' => notEmpty,
                    'message' => 'Winner Position Not Empty',
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


