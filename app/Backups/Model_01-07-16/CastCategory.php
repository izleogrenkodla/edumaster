<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class CastCategory extends AppModel
{
    public $name = 'CastCategories';
    public $useTable = 'cast_categories';
    public $primaryKey = 'CAST_CAT_ID';

    var $validate = array();

    /*public $hasMany = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'MEDIUM_ID',
            'fields' => array('id', 'ROLE_NAME'),
            
        )
    );*/


    function Validation()
    {
        $validate1 = array(
            'CAST_CAT_NAME' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'CastCategory could not be blank',
                    'last' => true),
                'mustBeLonger' => array(
                    'rule' => array('minLength', 2),
                    'message' => 'CastCategory must be greater than 1 character',
                    'last' => true),
            ),
        );
        $this->validate = $validate1;
        return $this->validates();
    }

    public function GetCastCategories()
    {
        $result = $this->find("all", array(
            'contain' => array(),
            'conditions' => array('STATUS' => 1),
            'fields' => array('CAST_CAT_ID', 'CAST_CAT_NAME'),
            'order' => 'CastCategory.CAST_CAT_NAME asc'
        ));
        $CastCategory = array();
        $CastCategory[0] = 'Select CastCategory';
        foreach ($result as $row) {
            $CastCategory[$row['CastCategory']['CAST_CAT_ID']] = ucwords($row['CastCategory']['CAST_CAT_NAME']);
        }
        return $CastCategory;
    }
}