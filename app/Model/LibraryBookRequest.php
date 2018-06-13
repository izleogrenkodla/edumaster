<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class LibraryBookRequest extends AppModel
{
    public $name = 'LibraryBookRequest';
    public $useTable ='leave_master';
    public $primaryKey = 'LEAVE_ID';
}
?>