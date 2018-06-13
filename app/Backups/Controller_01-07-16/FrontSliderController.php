<?php
// app/Controller/UsersController.php
class FrontSliderController extends AppController
{
    var $name = 'FrontSlider';

    public function beforeFilter()
    {
        parent::beforeFilter();

        if(isset($this->Security) &&  ($this->RequestHandler->isAjax() || $this->RequestHandler->isPost())){
            $this->Security->validatePost = false;
            $this->Security->enabled = false;
            $this->Security->csrfCheck = false;
        }
    }

	 public function admin_index()
    {
        $this->layout = 'admin_form_layout';
        $this->FrontSlider->recursive = 0;
        $this->paginate = array(
            'conditions' => '',
            'limit' => PAGINATION_LIMIT_ADMIN,
        );
       
        $this->set('frontslider', $this->paginate('FrontSlider'));
    }

	public function admin_add()
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
        if ($this->request->is('post')) {
            $this->FrontSlider->set($this->request->data);
            if ($this->FrontSlider->Validation()) {
                $this->FrontSlider->create();
				 $img = '';
                if(isset($this->request->data['FrontSlider']['Slider_img']["size"]) && $this->request->data['FrontSlider']['Slider_img']["size"]>0) {
                    $img = $this->request->data['FrontSlider']['Slider_img'];
                    unset($this->request->data['FrontSlider']['Slider_img']);
                }
                if ($this->FrontSlider->save($this->request->data)) {
					
					  $lastid = $this->FrontSlider->getLastInsertId();
						
                    if(is_array($img) && $img["size"]>0) {
							
                        $extension = $img['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_slider/";
                        $fname = strtotime(date('Y-m-d H:i:s')).$lastid.'.'.$ext[1];
                        move_uploaded_file($img["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        $imdata = base64_encode($im);

                        $this->FrontSlider->id = $lastid;
						
                        $this->FrontSlider->saveField("Slider_img",$fname);
                        
                    }

					
                    $this->Session->setFlash('Slider Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
                } else {
                $this->Session->setFlash('Slider Not Added Please Try Again!', 'message_bad');
                }
        }
        
    }
	
	 public function admin_delete($Id = null)
    {
		
		 $GalleryData = $this->FrontSlider->find('first', array(
            'contain' => array(),
            'conditions' => array('Slider_ID' => $Id)
        ));
		
		$fileName = $GalleryData['FrontSlider']['Slider_img'];
        $this->layout = 'admin_form_layout';
        if (!empty($Id)) {
            try {
                if ($this->FrontSlider->delete($Id)) {
					
					$this->General->delete_file("/files/upload_slider/".$fileName);

                    $this->Session->setFlash('Slider is successfully deleted', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->redirect(array('action' => 'index'));
                    $this->Session->setFlash('Record was not deleted. Unknown error.', 'message_bad');
                }
            } catch (Exception $e) {
                $this->Session->setFlash("Delete failed. {$e->getMessage()}", 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->redirect(array('action' => 'index'));
        } else {
            $this->Session->setFlash('Invalid Front Slider.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }
     

    /*


    public function admin_view($id=null){

        $this->layout = 'admin_form_layout';
        $this->FrontAbout->recursive = 0;
        $this->paginate = array(
            'conditions' => array('ABOUT_ID' => $id),
            'limit' => PAGINATION_LIMIT_ADMIN,
        );
       
        $this->set('front', $this->paginate('FrontAbout'));
    }


    public function admin_delete($Id = null)
    {
        $this->layout = 'admin_form_layout';
        if (!empty($Id)) {
            try {
                if ($this->FrontAbout->delete($Id)) {
                    $this->Session->setFlash('About is successfully deleted', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->redirect(array('action' => 'index'));
                    $this->Session->setFlash('Record was not deleted. Unknown error.', 'message_bad');
                }
            } catch (Exception $e) {
                $this->Session->setFlash("Delete failed. {$e->getMessage()}", 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->redirect(array('action' => 'index'));
        } else {
            $this->Session->setFlash('Invalid About.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }*/
	
	public function admin_edit($id=null){
        
    
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
 
                if ($this->FrontSlider->Validation()) {
                $img = '';
                if(isset($this->request->data['FrontSlider']['Slider_img']["size"]) && $this->request->data['FrontSlider']['Slider_img']["size"]>0) {
                    $img = $this->request->data['FrontSlider']['Slider_img'];
                    unset($this->request->data['FrontSlider']['Slider_img']);
                }

                if ($this->FrontSlider->save($this->request->data)) {
                    
                         $GalleryData = $this->FrontSlider->find('first', array(
							'contain' => array(),
							'conditions' => array('Slider_ID' => $id)
						));
						
						 $fileName = $GalleryData['FrontSlider']['Slider_img'];
						
						 if($fileName != '')
                        {
                          $this->General->delete_file("/files/upload_slider/".$fileName);
						}
                    if(is_array($img) && $img["size"]>0) {
                            
                        $extension = $img['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_slider/";
                        $fname = strtotime(date('Y-m-d H:i:s')).'.'.$ext[1];
                        move_uploaded_file($img["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        $imdata = base64_encode($im);
                       
                        $this->FrontSlider->saveField("Slider_img",$fname);
					
                    }
                    //echo $this->General->getLastQuery();die;
                
                    $this->Session->setFlash('Slider Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Slider Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Slider Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $FrontSlider = $this->FrontSlider->find('first', array(
                'contain' => array(),
                'conditions' => array('Slider_ID' => $id)
            ));
            
            
            if(empty($FrontSlider)) {
                $this->Session->setFlash('Invalid Front Slider!', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
  
            $this->request->data = $FrontSlider;
   
        }

	  }
	
}