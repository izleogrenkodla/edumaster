<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class PagesContent extends AppModel
{
    public $name = 'PagesContent';
    public $useTable = 'content';
    public $primaryKey = 'CONTENT_ID';

    public $belongsTo = array(
        'PageName' => array(
            'className' => 'PageName',
            'foreignKey' => 'PAGE_NAME_ID',
            'fields' => array('PAGE_NAME_ID', 'PAGE_NAME'),
        )
    );

    function Validation()
    {
        $validate1 = array(
            'PAGE_NAME_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '!=', 0),
                    'message' => 'Please select Page Name',
                    'last' => true)
            ),
            'CONTENT_DESC' => array(
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

}