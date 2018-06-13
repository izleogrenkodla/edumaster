<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class Testimonial extends AppModel
{
    public $name = 'Testimonials';
    public $useTable = 'testimonials';
    public $primaryKey = 'TESTIMONIAL_ID';

    function Validation()
    {
        $validate1 = array(
            'NAME' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Name could not be blank',
                    'last' => true)
            ),
            'DESIGNATION' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Designation could not be blank',
                    'last' => true)
            ),
            'CLIENT_EXE' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Client Experience could not be blank',
                    'last' => true)
            )
        );
        $this->validate = $validate1;
        return $this->validates();
    }

}