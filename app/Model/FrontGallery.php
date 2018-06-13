<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class FrontGallery extends AppModel
{
    public $name = 'FrontGallery';
    public $useTable = 'front_gallerygroup';
    public $primaryKey = 'gCode';

    //var $actsAs = array('Acl' => 'requester');

    public function parentNode()
    {
        return null;
    }

    var $validate = array();

   

    function Validation()
    {
        $validate1 = array(
            'gHeading' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Image Name could not be blank',
                    'last' => true),
               
            ),
			'DETAILS' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Details could not be blank',
                    'last' => true),
               
            ),
            'groupImage' => array(
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