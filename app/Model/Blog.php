<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class Blog extends AppModel
{
    public $name = 'Blog';
    public $useTable = 'blog';
    public $primaryKey = 'BLOG_ID';

    public $belongsTo = array(
        'Category' => array(
            'className' => 'Category',
            'foreignKey' => 'CATEGORY_ID',
            'fields' => array('CATEGORY_ID', 'CATEGORY_NAME'),
        ),
        'Role' => array(
            'className' => 'Role',
            'foreignKey' => 'ROLE_ID',
            'fields' => array('ID', 'ROLE_NAME'),
        ),
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'USER_ID',
            'fields' => array('ID', 'FIRST_NAME','MIDDLE_NAME','LAST_NAME','USERNAME'),
        )
    );

    function Validation()
    {
        $validate1 = array(
            'CATEGORY_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '!=', 0),
                    'message' => 'Please select Category',
                    'last' => true)
            ),
            'BLOG_TITLE' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Blog Title could not be blank',
                    'last' => true)
            ),
            'BLOG_DESC' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Blog Description could not be blank',
                    'last' => true)
            ),
        );
        $this->validate = $validate1;
        return $this->validates();
    }

}