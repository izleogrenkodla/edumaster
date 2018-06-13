<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class Achievement extends AppModel
{
    public $name = 'Achievement';
    public $useTable = 'achievements';
    public $primaryKey = 'PAGE_ID';

    function Validation()
    {
        $validate1 = array(
            'PAGE_TITLE' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Page Name could not be blank',
                    'last' => true)
            ),
            'PAGE_DESC' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Page Description could not be blank',
                    'last' => true)
            ),
'UPLOAD_IMAGE' => array(
				'mustNotEmpty' => array(
                    'rule' => array('uploadFile'),
                    'message' => 'Content Photo could not be blank',
					'on' => 'create',
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
    
    function limit_words($string, $word_limit)
    {
	$words = explode(" ",$string);
	return implode(" ",array_splice($words,0,$word_limit));
    }

}