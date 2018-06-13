<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class FrontActivity extends AppModel
{
    public $name = 'FrontActivity';
    public $useTable ='front_activities';
    public $primaryKey = 'Act_id';
	
	function Validation()
    {
        $validate1 = array(
            'Act_Title' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Activity Title could not be blank',
                    'last' => true),
            ),
			'Act_Description' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Description could not be blank',
                    'last' => true),
            ),
			'Act_Photo' => array(
                'mustNotEmpty' => array(
                    'rule' => array('uploadFile'),
                    'message' => 'Photo could not be blank',
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
}
?>