<?php  
class Sms extends AppModel {  
  
   var $name = 'sms';  
  
   var $validate =array(  
     
      'name' =>array(  
  
         'alphaNumeric' =>array(    
  
            'required' => true,  
  
            'message' => 'Student Name is required')  
  
         ),  
  
         'class' =>array(  
  
            'alphaNumeric' =>array(    
  
            'required' => true,  
  
            'message' => 'Class Name is required')  
  
         ), 
		 
		  'contact' =>array(  
  
            'alphaNumeric' =>array(    
  
            'required' => true,  
  
            'message' => 'Contact Number is required')  
  
         ), 
  
         'email' =>array(  
   
   			'alphaNumeric' =>array(    
  
            'required' => true,  
  
            'message' => 'E-Mail is required')  
  
         )
  
      );  
  
   }  
  
?>     