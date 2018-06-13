<?php
// app/Controller/UsersController.php
class FrontActivityController extends AppController
{
    var $name = 'FrontActivity';

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
        $this->FrontActivity->recursive = 0;
        $this->paginate = array(
            'conditions' => '',
            'limit' => PAGINATION_LIMIT_ADMIN,
        );

        $this->set('FrontActivity', $this->paginate('FrontActivity'));
    }
	
	public function admin_delete($Id = null)
    {
		
		 $GalleryData = $this->FrontActivity->find('first', array(
            'contain' => array(),
            'conditions' => array('Act_id' => $Id)
        ));
		
		$fileName = $GalleryData['FrontActivity']['Act_Photo'];
        $this->layout = 'admin_form_layout';
        if (!empty($Id)) {
            try {
                if ($this->FrontActivity->delete($Id)) {
					
					$this->General->delete_file("/files/upload_activities/".$fileName);

                    $this->Session->setFlash('Activities is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid Front Activities.', 'message_bad');
            $this->redirect(array('action' => 'index'));
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
		
        if ($this->request->is('post')) {
            $this->FrontActivity->set($this->request->data);
            if ($this->FrontActivity->Validation()) {
                $this->FrontActivity->create();
				 $img = '';
                if(isset($this->request->data['FrontActivity']['Act_Photo']["size"]) && $this->request->data['FrontActivity']['Act_Photo']["size"]>0) {
                    $img = $this->request->data['FrontActivity']['Act_Photo'];
                    unset($this->request->data['FrontActivity']['Act_Photo']);
                }
                if ($this->FrontActivity->save($this->request->data)) {
					
					  $lastid = $this->FrontActivity->getLastInsertId();
						
                    if(is_array($img) && $img["size"]>0) {
							
                        $extension = $img['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_activities/";
                        $fname = strtotime(date('Y-m-d H:i:s')).$lastid.'.'.$ext[1];
                        move_uploaded_file($img["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        $imdata = base64_encode($im);

                        $this->FrontActivity->id = $lastid;
						
                        $this->FrontActivity->saveField("Act_Photo",$fname);
                        
                    }

					
                    $this->Session->setFlash('Activity Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
                } else {
                $this->Session->setFlash('Activity Not Added Please Try Again!', 'message_bad');
                }
        }
        
    }
	
	public function admin_view($Id = null)
    {
		  $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		 $FrontActivity = $this->FrontActivity->find('first', array(
                'contain' => array(),
                'conditions' => array('Act_id' => $Id)
            ));
            
            
            if(empty($FrontActivity)) {
                $this->Session->setFlash('Invalid Front Slider!', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
  
            $this->request->data = $FrontActivity;
	}
	
	
	public function admin_edit($Id = null)
    {
		$this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
 
                if ($this->FrontActivity->Validation()) {
                $img = '';
                if(isset($this->request->data['FrontActivity']['Act_Photo']["size"]) && $this->request->data['FrontActivity']['Act_Photo']["size"]>0) {
                    $img = $this->request->data['FrontActivity']['Act_Photo'];
                    unset($this->request->data['FrontActivity']['Act_Photo']);
                }

                if ($this->FrontActivity->save($this->request->data)) {
                    
                         $GalleryData = $this->FrontActivity->find('first', array(
							'contain' => array(),
							'conditions' => array('Act_id' => $id)
						));
						
						 $fileName = $GalleryData['FrontActivity']['Act_Photo'];
						
						 if($fileName != '')
                        {
                          $this->General->delete_file("/files/upload_activities/".$fileName);
						}
                    if(is_array($img) && $img["size"]>0) {
                            
                        $extension = $img['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_activities/";
                        $fname = strtotime(date('Y-m-d H:i:s')).'.'.$ext[1];
                        move_uploaded_file($img["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        $imdata = base64_encode($im);
                       
                        $this->FrontActivity->saveField("Act_Photo",$fname);
					
                    }
                    //echo $this->General->getLastQuery();die;
                
                    $this->Session->setFlash('Activity Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Activity Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Activity Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $FrontActivity = $this->FrontActivity->find('first', array(
                'contain' => array(),
                'conditions' => array('Act_id' => $Id)
            ));
            
            
            if(empty($FrontActivity)) {
                $this->Session->setFlash('Invalid Front Activity!', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
  
            $this->request->data = $FrontActivity;
   
        }
	}
}
?>