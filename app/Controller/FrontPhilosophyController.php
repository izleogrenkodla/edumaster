<?php
// app/Controller/UsersController.php
class FrontPhilosophyController extends AppController
{
    var $name = 'FrontPhilosophy';

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
        $this->FrontPhilosophy->recursive = 0;
        $this->paginate = array(
            'conditions' => '',
            'limit' => PAGINATION_LIMIT_ADMIN,
        );

        $this->set('FrontPhilosophy', $this->paginate('FrontPhilosophy'));
    }
	
	/*public function admin_delete($Id = null)
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

    }*/
	
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
            $this->FrontPhilosophy->set($this->request->data);
            if ($this->FrontPhilosophy->Validation()) {
                $this->FrontPhilosophy->create();
				
                if ($this->FrontPhilosophy->save($this->request->data)) {
	
                    $this->Session->setFlash('Philosophy Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
                } else {
                $this->Session->setFlash('Philosophy Not Added Please Try Again!', 'message_bad');
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
		
		 $FrontPhilosophy = $this->FrontPhilosophy->find('first', array(
                'contain' => array(),
                'conditions' => array('p_id' => $Id)
            ));
            
            
            if(empty($FrontPhilosophy)) {
                $this->Session->setFlash('Invalid Front Slider!', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
  
            $this->request->data = $FrontPhilosophy;
	}
	
	
	public function admin_edit($Id = null)
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

        if ($this->request->is('put') || $this->request->is('post')) {
 
                if ($this->FrontPhilosophy->Validation()) {
               

                if ($this->FrontPhilosophy->save($this->request->data)) {
                                  
                    $this->Session->setFlash('Philosophy Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Philosophy Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Philosophy Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $FrontPhilosophy = $this->FrontPhilosophy->find('first', array(
                'contain' => array(),
                'conditions' => array('p_id' => $Id)
            ));
            
            
            if(empty($FrontPhilosophy)) {
                $this->Session->setFlash('Invalid Front Philosophy!', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
  
            $this->request->data = $FrontPhilosophy;
   
        }
	}
}
?>