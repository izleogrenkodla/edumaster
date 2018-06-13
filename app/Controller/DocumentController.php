<?php
// app/Controller/UsersController.php
class DocumentController extends AppController
{
	  var $name = 'Document';

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
        $this->Document->recursive = 0;
        $this->paginate = array(
            'conditions' => '',
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'Document.DOC_ID ASC'
        );
        $this->set('docs', $this->paginate('Document'));
		
		$classes = $this->Document->AcademicClass->GetAcademicClasses();
        $this->set('classes', $classes);
		
	    $mediums = $this->Document->Medium->GetMedium();
        $this->set('medium', $mediums);

    }
	
	public function admin_add()
	{
		$this->layout = 'admin_form_layout';
		
		$Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		if($Session_data["ROLE_ID"]!=SUPERVISOR_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}
		
        $this->Document->id = $id;
		 
        if ($this->request->is('post')) {
           $this->Document->set($this->request->data);
		
		 
            if ($this->Document->Validation()) {
                $this->Document->create();
				
                if ($this->Document->save($this->request->data)) {
                    $this->Session->setFlash('Document Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
            } else {
                $this->Session->setFlash('Document Not Added Please Try Again!', 'message_bad');
            }
        }
		 
		$classes = $this->Document->AcademicClass->GetAcademicClasses();
        $this->set('classes', $classes);
		
	    $mediums = $this->Document->Medium->GetMedium();
        $this->set('medium', $mediums);
	}
	
	 public function admin_delete($Id = null)
    {
        $this->layout = 'admin_form_layout';
		
		$Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		if($Session_data["ROLE_ID"]!=SUPERVISOR_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}
		
        if (!empty($Id)) {
            try {
                if ($this->Document->delete($Id)) {
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
            $this->Session->setFlash('Invalid AppAdmission.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }
	
	    public function admin_edit($id = null)
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		if($Session_data["ROLE_ID"]!=SUPERVISOR_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}
		

        $this->Document->id = $id;
        if (empty($this->Document->id)) {
            $this->Session->setFlash('Invalid Document !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->Document->Validation()) {
                if ($this->Document->save($this->request->data)) {
                    $this->Session->setFlash('Document Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Document Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Document Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $Document = $this->Document->find('first', array(
                'contain' => array(),
                'conditions' => array('DOC_ID' => $id)
            ));
            if(empty($Document)) {
                $this->Session->setFlash('Invalid Document !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $Document;
        }

        $classes = $this->Document->AcademicClass->GetAcademicClasses();
        $this->set('classes', $classes);
		
	    $mediums = $this->Document->Medium->GetMedium();
        $this->set('medium', $mediums);
	
    }
	
	  public function admin_view($id = null)
    {
        $this->layout = 'admin_form_layout';
        $this->Document->id = $id;
		
        if (empty($this->Document->id)) {
		
            $this->Session->setFlash('Invalid Document!', 'message_bad');
            $this->redirect(array('action' => 'index'));
			
        }

            $Document = $this->Document->read(null, $id);

            if (empty($Document)) {
                $this->Session->setFlash('Invalid Document!', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $Document;
			
		$classes = $this->Document->AcademicClass->GetAcademicClasses();
         $this->set('classes', $classes);
		
		 $mediums = $this->Document->Medium->GetMedium();
         $this->set('medium', $mediums);

    }
  

}
?>