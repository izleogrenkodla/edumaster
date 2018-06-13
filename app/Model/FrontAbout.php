<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class FrontAbout extends AppModel
{
    public $name = 'FrontAbout';
    public $useTable = 'front_about_us';
    public $primaryKey = 'ABOUT_ID';

    //var $actsAs = array('Acl' => 'requester');

    public function parentNode()
    {
        return null;
    }

    var $validate = array();

   

    function Validation()
    {
        $validate1 = array(			
            'CONTENT' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Content could not be blank',
                    'last' => true),
               
            ),
             'SCHOOL_NAME' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'School Name could not be blank',
                    'last' => true),
               
            ),
             'ADDRESS' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Address could not be blank',
                    'last' => true),
               
            ),
             'CONTACT_NO' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Contact Number could not be blank',
                    'last' => true),
               
            ),
             'EMAIL' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Email could not be blank',
                    'last' => true),
               
            ),



        );
        $this->validate = $validate1;
        return $this->validates();
    }

   
}