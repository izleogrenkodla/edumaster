<?php
class SfaffDocumentChecklistController extends AppController
{ 
    var $name = 'SfaffDocumentChecklist';

    public function beforeFilter()
    {
        parent::beforeFilter();

        $this->Auth->allow('');

        if(isset($this->Security) &&  ($this->RequestHandler->isAjax() || $this->RequestHandler->isPost())){
            $this->Security->validatePost = false;
            $this->Security->enabled = false;
            $this->Security->csrfCheck = false;
        }
    }
	
	
 	public function admin_index(){
	    $this->layout = 'admin_form_layout';
		  $this->paginate = array(
		    'Contain' => array(),
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'SfaffDocumentChecklist.created DESC'
        );
		   $this->set('SfaffDocumentChecklist', $this->paginate('SfaffDocumentChecklist'));
	}
		
	public function admin_add()
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		if($Session_data["ROLE_ID"]!=HR_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}

        if ($this->request->is('post')) {
            $this->SfaffDocumentChecklist->set($this->request->data);
            if ($this->SfaffDocumentChecklist->Validation()) {
                $this->SfaffDocumentChecklist->create();
                if ($this->SfaffDocumentChecklist->save($this->request->data)) {
					
					$this->request->data['Uploaddocument']['USER_ID'] = $Session_data['ID'];
					$this->SfaffDocumentChecklist->saveField("created_by",$Session_data['ID']);
					
					$ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
					$this->SfaffDocumentChecklist->saveField("created_ip",$ip);
					
                    $this->Session->setFlash('Document Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
            } else {
                $this->Session->setFlash('Document Not Added Please Try Again!', 'message_bad');
            }
        }

        $roles = $this->User->Role->GetRoles();
        $this->set('user_roles', $roles);

    }	
	
	 public function admin_edit($id = null)
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		if($Session_data["ROLE_ID"]!=HR_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}

        $this->SfaffDocumentChecklist->id = $id;
        if (empty($this->SfaffDocumentChecklist->id)) {
            $this->Session->setFlash('Invalid Document !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->SfaffDocumentChecklist->Validation()) {
                if ($this->SfaffDocumentChecklist->save($this->request->data)) {
                    $this->Session->setFlash('Document Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Document Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Document Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $SfaffDocumentChecklist = $this->SfaffDocumentChecklist->find('first', array(
                'contain' => array(),
                'conditions' => array('DOC_CHE_ID' => $id)
            ));
            if(empty($SfaffDocumentChecklist)) {
                $this->Session->setFlash('Invalid Document !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $SfaffDocumentChecklist;
        }
		 $roles = $this->User->Role->GetRoles();
        $this->set('user_roles', $roles);

    }
	
	public function admin_delete($Id = null)
    {
        $this->layout = 'admin_form_layout';
		
		$Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		if($Session_data["ROLE_ID"]!=HR_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}
		
        if (!empty($Id)) {
            try {
                if ($this->SfaffDocumentChecklist->delete($Id)) {
                    $this->Session->setFlash('Document is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid Document.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }

		
		
}
?>