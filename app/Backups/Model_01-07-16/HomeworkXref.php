<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class HomeworkXref extends AppModel
{ 
    public $name = 'HomeworkXref';
    public $useTable = 'homework_xref';
    public $primaryKey = 'ID';

    public $belongsTo = array(

        'User' => array(
            'className' => 'User',
            'foreignKey' => 'STUDENT_ID',
            'fields' => array('ID','FIRST_NAME', 'MIDDLE_NAME', 'LAST_NAME','EMAIL_ID'),
        ),
    );

    


}