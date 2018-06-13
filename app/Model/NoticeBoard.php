<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class NoticeBoard extends AppModel
{
    public $name = 'NoticeBoard';
    public $useTable = 'notice_board';
    public $primaryKey = 'NOTICE_ID';

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
		'CircularGroup' => array(
			'className' => 'CircularGroup',
			'foreignKey' => 'CIR_GR_ID',
			'fields'=>array('CircularGroup.TITLE','CircularGroup.CIR_GR_ID'),
        ),
    );

    public $hasMany = array(
        'NoticeBoardXref' => array(
            'className' => 'NoticeBoardXref',
            'foreignKey' => 'NOTICE_ID',
        )
    );
    function Validation()
    {
        $validate1 = array(
            'ROLE_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '!=', 0),
                    'message' => 'Please select user group',
                    'last' => true)
            ),
            'NOTICE_TITLE' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Notice Title could not be blank',
                    'last' => true)
            ),
            'NOTICE_DESC' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Notice Description could not be blank',
                    'last' => true)
            )
        );
        $this->validate = $validate1;
        return $this->validates();
    }

}
