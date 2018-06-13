<?php
// app/Controller/UsersController.php
class FrontFacilityController extends AppController
{
    var $name = 'FrontFacility';

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
            $this->FrontFacility->set($this->request->data);
            if ($this->FrontFacility->Validation()) {
                $this->FrontFacility->create();
                if ($this->FrontFacility->save($this->request->data)) {
					
					/*  $lastid = $this->Album->getLastInsertId();

                    if(is_array($img) && $img["size"]>0) {

                        $extension = $img['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname = strtotime(date('Y-m-d H:i:s')).$lastid.'.'.$ext[1];
                        move_uploaded_file($img["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        $imdata = base64_encode($im);

                        $this->Album->id = $lastid;

                        $this->Album->saveField("COVER_IMAGE",$fname);
                        $this->Album->saveField("BASE_CODE",$imdata);
                    }*/

					
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
        $this->FrontFacility->recursive = 0;
        $this->paginate = array(
            'conditions' => '',
            'limit' => PAGINATION_LIMIT_ADMIN,
        );
        $this->set('frontfacility', $this->paginate('FrontFacility'));
    }


    public function admin_view($id=null){

        $this->layout = 'admin_form_layout';
        $this->FrontFacility->recursive = 0;
        $this->paginate = array(
            'conditions' => array('FACILITY_ID' => $id),
            'limit' => PAGINATION_LIMIT_ADMIN,
        );
      
        $this->set('frontfacility', $this->paginate('FrontFacility'));
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
		
        if (!empty($Id)) {
            try {
                if ($this->FrontFacility->delete($Id)) {
                    $this->Session->setFlash('Facility is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid Facility.', 'message_bad');
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
            
            
            if ($this->FrontFacility->Validation()) {
                if ($this->FrontFacility->save($this->request->data)) {
                    
                    
                    $this->Session->setFlash('About Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Facility Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Facility Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $FrontFacility = $this->FrontFacility->find('first', array(
                'contain' => array(),
                'conditions' => array('FACILITY_ID ' => $id)
            ));
            
            //print_r($FrontFacility);die;
            if(empty($FrontFacility)) {
                $this->Session->setFlash('Invalid Facility  !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            
            
            $this->request->data = $FrontFacility;
            
            }
        }

   
   
}