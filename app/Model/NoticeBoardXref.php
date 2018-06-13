<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class NoticeBoardXref extends AppModel
{
    public $name = 'NoticeBoardXref';
    public $useTable = 'notice_board_xref';
    public $primaryKey = 'ID';

  public $belongsTo = array(
        'User' => array(
            'className' => 'User',
               'fields' => array('ID','FIRST_NAME','LAST_NAME','ROLE_ID'),
            'foreignKey' => 'TO_ID'
        ),
	 'UserFrom' => array(
            'className' => 'User',
               'fields' => array('ID','FIRST_NAME','LAST_NAME','ROLE_ID'),
            'foreignKey' => 'FROM_ID'
        ),
        'NoticeBoard' => array(
            'className' => 'NoticeBoard',
            'fields' => array(),
            'foreignKey' => 'NOTICE_ID',
        )
    );

}