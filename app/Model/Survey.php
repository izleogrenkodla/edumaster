<?php

App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
  
class Survey extends AppModel {  
  
   public $name = 'Survey';
    public $useTable = 'survey';
    public $primaryKey = 'STD_ID';  
  
  
   function Validation()
    {
        $validate1 = array(
		
		   'STD_NAME' => array(
               'mustNotEmpty' => array(
                  'rule' => 'notEmpty',
                  'message' => 'Student Name is required',
                  'last' => true)
            ),
			
			'CLASS_ID' => array(
                'mustNotEmpty' => array(
                    'rule' => array('comparison', '!=', 0),
                    'message' => 'Please select Class',
                    'last' => true)
            ),
		
		    'CONTACT_NO' =>array(  
            'alphaNumeric' =>array(    
            'required' => true,  
            'message' => 'Contact Number is required')  
         ), 
		 
		  'E-MAIL' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Please enter email id',
                    'last' => true),
                'mustBeEmail' => array(
                    'rule' => "/^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/",
                    'message' => 'Please enter valid email',
                    'last' => true),
            ),
		 
            
        );
        $this->validate = $validate1;
        return $this->validates();
    }
  
  
      /*'STD_NAME' =>array(  
  
         'alphaNumeric' =>array(    
  
            'required' => true,  
  
            'message' => 'Student Name is required')  
  
         ),  
  
         'CLASS_ID' =>array(  
  
            'alphaNumeric' =>array(    
  
            'required' => true,  
  
            'message' => 'Class Name is required')  
  
         ), 
		 
		  'CONTACT_NO' =>array(  
  
            'alphaNumeric' =>array(    
  
            'required' => true,  
  
            'message' => 'Contact Number is required')  
  
         ), 
  
         'E-MAIL' =>array(  
   
   			'alphaNumeric' =>array(    
  
            'required' => true,  
  
            'message' => 'E-Mail is required')  
  
         )
	
      );*/  

}
  
?>     