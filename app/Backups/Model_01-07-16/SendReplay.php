<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class SendReplay extends AppModel
{
    public $name = 'SendReplay';
    public $useTable ='send_replay';
    public $primaryKey = 'REP_ID';
}
?>