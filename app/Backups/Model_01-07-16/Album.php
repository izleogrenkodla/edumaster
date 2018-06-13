<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class Album extends AppModel
{
    public $name = 'Album';
    public $useTable = 'album';
    public $primaryKey = 'ALBUM_ID';

    public $belongsTo = array(
        'AcademicClass' => array(
            'className' => 'AcademicClass',
            'foreignKey' => 'CLASS_ID',
            'fields' => array('CLASS_ID', 'CLASS_NAME'),
        ),
    );
    
    public $hasMany = array(
        'Gallery' => array(
            'className' => 'Gallery',
            'foreignKey' => 'ALBUM_ID',
        ),
    );

    function Validation()
    {
        $validate1 = array(
            'CLASS_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '!=', 0),
                    'message' => 'Please select Category',
                    'last' => true)
            ),
            'ALBUM_NAME' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Album Name could not be blank',
                    'last' => true)
            ),
'UPLOAD_IMAGE' => array(
				'mustNotEmpty' => array(
                    'rule' => array('uploadFile'),
                    'message' => 'Ablum Photo could not be blank',
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