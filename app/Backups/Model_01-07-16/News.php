<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class News extends AppModel
{
    public $name = 'News';
    public $useTable = 'news';
    public $primaryKey = 'NEWS_ID';

 

    function Validation()
    {
        $validate1 = array(
		
            'NEWS_TITLE' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'News Title could not be blank',
                    'last' => true)
            ),
		
            'CONTENT_DESC' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'News Description could not be blank',
                    'last' => true)
            ),
			
			'START_DATE' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'News Start Date could not be blank',
                    'last' => true)
			),
			'END_DATE' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'News End Date could not be blank',
                    'last' => true)
			),

        );
        $this->validate = $validate1;
        return $this->validates();
    }

}