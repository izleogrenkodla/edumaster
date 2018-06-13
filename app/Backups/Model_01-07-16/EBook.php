<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class EBook extends AppModel
{
    public $name = 'EBook';
    public $useTable = 'e-book';
    public $primaryKey = 'ID';

    public $belongsTo = array(
        'AcademicClass' => array(
            'className' => 'AcademicClass',
            'foreignKey' => 'CLASS_ID',
            'fields' => array('CLASS_ID', 'CLASS_NAME'),
        ),
        'Category' => array(
            'className' => 'Category',
            'foreignKey' => 'CATEGORY_ID',
            'fields' => array('CATEGORY_ID', 'CATEGORY_NAME'),
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
            'CLASS_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '!=', 0),
                    'message' => 'Please select Class',
                    'last' => true)
            ),
            'BOOK_NAME' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Book name could not be blank',
                    'last' => true)
            ),
            'AUTHOR_NAME' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Author name could not be blank',
                    'last' => true)
            ),
        );
        $this->validate = $validate1;
        return $this->validates();
    }

}
