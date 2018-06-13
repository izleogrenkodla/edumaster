<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class FrontAdmission extends AppModel
{
    public $name = 'FrontAdmission';
    public $useTable ='front_admission_inquiry';
    public $primaryKey = 'cID';

    //var $actsAs = array('Acl' => 'requester');

    public function parentNode()
    {
        return null;
    }

    var $validate = array();


}