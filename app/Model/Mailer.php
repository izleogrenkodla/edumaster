<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class Mailer extends AppModel
{
    public $name = 'Mailer';
    public $useTable = 'mail_sent';
    public $primaryKey = 'MAIL_ID';

     public $belongsTo = array(
        'Role' => array(
            'className' => 'Role',
            'fields' => array('ID', 'ROLE_NAME'),
            'foreignKey' => 'ROLE_ID',
        ),
		'User' => array(
            'className' => 'User',
            'fields' => array('FIRST_NAME', 'MIDDLE_NAME','LAST_NAME'),
            'foreignKey' => 'USER_ID',
        ),
    );

 
    function Validation()
    {
        $validate1 = array(
            'MAIL_TITLE' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Mail Title could not be blank',
                    'last' => true)
            ),
            'MAIL_BODY' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Mail Body could not be blank',
                    'last' => true)
            )
        );
        $this->validate = $validate1;
        return $this->validates();
    }

}
