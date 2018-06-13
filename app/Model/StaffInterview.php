<?php
// app/Model/User.php
App::uses('AppModel', 'Model');
class StaffInterview extends AppModel
{
    public $name = 'StaffInterview';
    public $useTable = 'staff_interview';
    public $primaryKey = 'INT_ID';
}

?>