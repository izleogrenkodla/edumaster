<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class Group extends AppModel
{
    public $name = 'Group';
    public $useTable = 'group';
    public $primaryKey = 'GROUP_ID';
	
	
	public $belongsTo = array(
		'AcademicClass' => array(
            'className' => 'AcademicClass',
            'foreignKey' => 'CLASS_ID',
            'fields' => array('CLASS_ID', 'CLASS_NAME'),
        ),
		'Subject' => array(
            'className' => 'Subject',
            'foreignKey' => 'SUBJECT_ID',
            'fields' => array('SUBJECT_ID', 'TITLE'),
        ),
    );
	
	 function Validation()
    {
        $validate1 = array(
           'CLASS_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '!=', 0),
                    'message' => 'Please select Class',
                    'last' => true)
            ),
            'GROUP_NAME' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Group Name could not be blank',
                    'last' => true)
            ),
			
        );
        $this->validate = $validate1;
        return $this->validates();
    }
	
	public function GetGroup()
    {
        $result = $this->find("all", array(
            'contain' => array(''),
            'conditions' => array('STATUS' => 1),
            'fields' => array('DISTINCT GROUP_NAME','GROUP_ID'),
            'order' => 'Group.GROUP_NAME desc'
        ));
 
        $subject = array();
        $subject[0] = 'Select Group';
        foreach ($result as $row) {
            $subject[$row['Group']['GROUP_ID']] = ucwords($row['Group']['GROUP_NAME']);
        }
        return $subject;
    }
	public function Get_Group_Class($id = Null)
    {
        $result = $this->find("all", array(
            'contain' => array(''),
            'conditions' => array('CLASS_ID'=>$id ,'STATUS' => 1),
            'fields' => array('GROUP_NAME','GROUP_ID'),
            'group' => 'GROUP_NAME', 
        ));
 
        $subject = array();
        $subject[0] = 'Select Group';
        foreach ($result as $row) {
            $subject[$row['Group']['GROUP_ID']] = ucwords($row['Group']['GROUP_NAME']);
        }
        return $subject;
    }
	


}



?>