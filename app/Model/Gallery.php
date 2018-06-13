<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class Gallery extends AppModel
{
    public $name = 'Gallery';
    public $useTable = 'gallery';
    public $primaryKey = 'GALLERY_ID';

    public $belongsTo = array(
        'Album' => array(
            'className' => 'Album',
            'foreignKey' => 'ALBUM_ID',
            'fields' => array('ALBUM_ID', 'ALBUM_NAME'),
        ),
    );

    function Validation()
    {
        $validate1 = array(
            'ALBUM_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '!=', 0),
                    'message' => 'Please select Album',
                    'last' => true)
            ),
            'GALLERY_NAME' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Album Name could not be blank',
                    'last' => true)
            )
        );
        $this->validate = $validate1;
        return $this->validates();
    }

}