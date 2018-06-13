<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
class FrontSlider extends AppModel
{
    public $name = 'FrontSlider';
    public $useTable ='front_slider';
    public $primaryKey = 'Slider_ID';
	
	 function Validation()
    {
        $validate1 = array(
            'Slider_Name' => array(
                'mustNotEmpty' => array(
                    'rule' => 'notEmpty',
                    'message' => 'Image Name could not be blank',
                    'last' => true),
               
            ),
            'Slider_img' => array(
                'mustNotEmpty' => array(
                    'rule' => array('uploadFile'),
                    'message' => 'Photo could not be blank',
                    'last' => true),
                'extension' => array(
                    'rule' => array('valid_extentions',array("extentions"=>ALLOWED_EXT,"size"=>ALLOWED_SIZE)),
                    'message' => 'You must upload valid file',
                    'last'=>true
                 ),
            ),
     
        );
        $this->validate = $validate1;
        return $this->validates();
    }
}
?>