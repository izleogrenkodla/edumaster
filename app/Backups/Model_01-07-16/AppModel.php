<?php
/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {
    public $actsAs = array('Containable');

   public function uploadFile( $check )
    {
        $uploadData = array_shift($check);

        if ($uploadData['size'] == 0 || $uploadData['error'] !== 0) {
            return false;
        }

        if($uploadData['size'] == 0 || round($uploadData['size']/1024) > 40920){
            return false;
        }

        return true;
    }
	
	public function valid_extentions($ext,$obj) { 
		$key = key($ext);
		if(isset($ext[$key])) {
			$img =$ext[$key];
			$extentions = explode(",",$obj["extentions"]);

			if(!isset($img["name"])) { 
				return false;
			}
			
			$file_ext = explode(".",strtolower($img["name"])); 
			
			if(!in_array($file_ext[1],$extentions)) { 
				return false;			
			}

			if($img["size"] > $obj["size"]) { 
				return false;
			}
			return true;
		}
	}
}
