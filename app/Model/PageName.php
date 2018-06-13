<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class PageName extends AppModel
{
    public $name = 'PageNames';
    public $useTable = 'page_names';
    public $primaryKey = 'PAGE_NAME_ID';

    var $validate = array();

    /*public $hasMany = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'ROLE_ID'
        )
    );*/


    function Validation()
    {
        $validate1 = array(
            'PAGE_NAME' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Page name could not be blank',
                    'last' => true)
            )
        );
        $this->validate = $validate1;
        return $this->validates();
    }

    public function GetPageNames()
    {
        $result = $this->find("all", array(
            'contain' => array(),
            'conditions' => array('STATUS' => 1),
            'fields' => array('PAGE_NAME_ID', 'PAGE_NAME'),
            'order' => 'PageName.PAGE_NAME_ID asc'
        ));
        $PageNames = array();
        $PageNames[0] = 'Select Page';
        foreach ($result as $row) {
            $PageNames[$row['PageName']['PAGE_NAME_ID']] = ucwords($row['PageName']['PAGE_NAME']);
        }
        return $PageNames;
    }
}