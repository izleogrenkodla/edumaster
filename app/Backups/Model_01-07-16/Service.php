<?php
App::uses('AppModel', 'Model');
class Service extends AppModel
{
    public $name = 'Service';
    public $useTable = 'services';
    public $primaryKey = 'id';

    var $validate = array();
}