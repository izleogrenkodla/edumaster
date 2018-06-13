<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class FrontContact extends AppModel
{
    public $name = 'FrontContact';
    public $useTable ='front_contactus';
    public $primaryKey = 'cID';

    //var $actsAs = array('Acl' => 'requester');

    public function parentNode()
    {
        return null;
    }

    var $validate = array();


}