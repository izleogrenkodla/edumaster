<?php
// app/Controller/UsersController.php
class FrontGalleryController extends AppController
{
    var $name = 'FrontGallery';

    public function beforeFilter()
    {
        parent::beforeFilter();

        if(isset($this->Security) &&  ($this->RequestHandler->isAjax() || $this->RequestHandler->isPost())){
            $this->Security->validatePost = false;
            $this->Security->enabled = false;
            $this->Security->csrfCheck = false;
        }
    }


    public function admin_add()
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		if($Session_data["ROLE_ID"]!=ADMIN_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}
		
        if ($this->request->is('post')) {
            $this->FrontGallery->set($this->request->data);
            if ($this->FrontGallery->Validation()) {
                $this->FrontGallery->create();
				 $img = '';
                if(isset($this->request->data['FrontGallery']['groupImage']["size"]) && $this->request->data['FrontGallery']['groupImage']["size"]>0) {
                    $img = $this->request->data['FrontGallery']['groupImage'];
                    unset($this->request->data['FrontGallery']['groupImage']);
                }
                if ($this->FrontGallery->save($this->request->data)) {
					
					  $lastid = $this->FrontGallery->getLastInsertId();
						
                    if(is_array($img) && $img["size"]>0) {
							
                        $extension = $img['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_gallery/";
                        $fname = strtotime(date('Y-m-d H:i:s')).$lastid.'.'.$ext[1];
                        move_uploaded_file($img["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        $imdata = base64_encode($im);

                        $this->FrontGallery->id = $lastid;
						
                        $this->FrontGallery->saveField("groupImage",$fname);
                        
                    }

					
                    $this->Session->setFlash('Front Facility Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
                } else {
                $this->Session->setFlash('Front Facility Not Added Please Try Again!', 'message_bad');
                }
        }
        
    }


     

     public function admin_index()
    {
        $this->layout = 'admin_form_layout';
        $this->FrontGallery->recursive = 0;
        $this->paginate = array(
            'conditions' => '',
            'limit' => PAGINATION_LIMIT_ADMIN,
        );
		
		
		
        $this->set('frontgallery', $this->paginate('FrontGallery'));
    }


    public function admin_view($id=null){

        $this->layout = 'admin_form_layout';
        $this->FrontGallery->recursive = 0;
        $this->paginate = array(
            'conditions' => array('FACILITY_ID' => $id),
            'limit' => PAGINATION_LIMIT_ADMIN,
        );
      
        $this->set('frontgallery', $this->paginate('FrontGallery'));
    }


    public function admin_delete($Id = null)
    {
		$this->layout = 'admin_form_layout';
		
		$Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		if($Session_data["ROLE_ID"]!=ADMIN_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}
		
		 $GalleryData = $this->FrontGallery->find('first', array(
            'contain' => array(),
            'conditions' => array('gCode' => $Id)
        ));
		
		$fileName = $GalleryData['FrontGallery']['groupImage'];
        
        if (!empty($Id)) {
            try {
                if ($this->FrontGallery->delete($Id)) {
					
					$this->General->delete_file("/files/upload_gallery/".$fileName);

                    $this->Session->setFlash('Front Gallery is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid Front Gallery.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }


      public function admin_edit($id=null){        
    
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

		if($Session_data["ROLE_ID"]!=ADMIN_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}
        
        if ($this->request->is('put') || $this->request->is('post')) {
            
            
                
                if ($this->FrontGallery->Validation()) {
                $img = '';
                if(isset($this->request->data['FrontGallery']['groupImage']["size"]) && $this->request->data['FrontGallery']['groupImage']["size"]>0) {
                    $img = $this->request->data['FrontGallery']['groupImage'];
                    unset($this->request->data['FrontGallery']['groupImage']);
                }

                if ($this->FrontGallery->save($this->request->data)) {
                    
                         $GalleryData = $this->FrontGallery->find('first', array(
							'contain' => array(),
							'conditions' => array('gCode' => $id)
						));
						
						 $fileName = $GalleryData['FrontGallery']['groupImage'];
						
						 if($fileName != '')
                        {
                          $this->General->delete_file("/files/upload_gallery/".$fileName);
						}
                    if(is_array($img) && $img["size"]>0) {
                            
                        $extension = $img['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_gallery/";
                        $fname = strtotime(date('Y-m-d H:i:s')).'.'.$ext[1];
                        move_uploaded_file($img["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        $imdata = base64_encode($im);
                       
                        $this->FrontGallery->saveField("groupImage",$fname);
						
						
                        
                         
                    }
                    //echo $this->General->getLastQuery();die;
                
                    $this->Session->setFlash('Front Gallery Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Front Gallery Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Front Gallery Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $FrontGallery = $this->FrontGallery->find('first', array(
                'contain' => array(),
                'conditions' => array('gCode' => $id)
            ));
            
            
            if(empty($FrontGallery)) {
                $this->Session->setFlash('Invalid Front Gallery!', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            
            
            $this->request->data = $FrontGallery;
			
            
            
        }

	  }
   
}