<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class Category extends AppModel
{
    public $name = 'Category';
    public $useTable = 'categories';
    public $primaryKey = 'CATEGORY_ID';

    function Validation()
    {
        $validate1 = array(
            'CATEGORY_NAME' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Category Name could not be blank',
                    'last' => true),
                'mustBeLonger' => array(
                    'rule' => array('minLength', 2),
                    'message' => 'Category Name must be greater than 1 character',
                    'last' => true),
            ),
        );
        $this->validate = $validate1;
        return $this->validates();
    }

    public function GetCategories()
    {
        $result = $this->find("all", array(
            'contain' => array(),
            'conditions' => array('STATUS' => 1),
            'fields' => array('CATEGORY_ID', 'CATEGORY_NAME'),
            'order' => 'Category.CATEGORY_ID asc'
        ));
        $categories = array();
        $categories[0] = 'Select Category';
        foreach ($result as $row) {
            $categories[$row['Category']['CATEGORY_ID']] = ucwords($row['Category']['CATEGORY_NAME']);
        }
        return $categories;
    }
}