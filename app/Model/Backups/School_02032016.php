<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class School extends AppModel
{
    public $name = 'School';
    public $useTable = 'school';
    public $primaryKey = 'SCHOOL_ID';

    function Validation()
    {
        $validate1 = array(
            'SCHOOL_NAME' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'School Name could not be blank',
                    'last' => true)
            ),
            'SCHOOL_TAGLINE' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Tag Line could not be blank',
                    'last' => true)
            ),
            'ADDRESS' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Address could not be blank',
                    'last' => true)
            ),
            'MOBILE_NO' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Mobile No could not be blank',
                    'last' => true)
            ),
            'EMAIL' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter email id',
                    'last' => true),
                'mustBeEmail' => array(
                    'rule' => "/^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/",
                    'message' => 'Please enter valid email',
                    'last' => true),
                'uniqueEmailRule' => array(
                    'rule' => 'isUnique',
                    'message' => 'Email already register',
                    'on' => 'create'
                )
            ),

        );
        $this->validate = $validate1;
        return $this->validates();
    }


     function valid_extentions($ext,$obj) { 
		$key = key($ext);
		if(isset($ext[$key])) {
			$img =$ext[$key];
			$extentions = explode(",",$obj["extentions"]);
			$file_ext = explode(".",strtolower($img["name"])); 
			if(!in_array($file_ext[1],$extentions)) { 
				return false;			
			}

			if($img["size"] > $obj["size"]) { 
				return false;
			}
			return true;
		}			
    }// end of functions
}