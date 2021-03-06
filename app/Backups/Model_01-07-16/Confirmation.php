<?php
class Confirmation extends AppModel
{
    public $name = 'Confirmation';
    public $useTable = 'confirmation';
    public $primaryKey = 'CONF_ID';
	
	 public $belongsTo = array(    
        'Role' => array(
            'className' => 'Role',
            'foreignKey' => 'ROLE_ID',
            'fields' => array('ID', 'ROLE_NAME'),
        ),
		'Name' => array(
            'className' => 'Users',
            'foreignKey' => 'USER_ID',
            'fields' => array('FIRST_NAME', 'MIDDLE_NAME' ,'LAST_NAME'),
        ),
		
      
    );
}
?>