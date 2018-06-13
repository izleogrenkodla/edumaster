<?php
// app/Controller/UsersController.php
class FrontCourseController extends AppController
{
    var $name = 'FrontCourse';

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
        $this->FrontCourse->recursive = 0;
        $this->paginate = array(
            'conditions' => '',
            'limit' => PAGINATION_LIMIT_ADMIN,
        );

        $this->set('FrontCourse', $this->paginate('FrontCourse'));
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
            $this->FrontCourse->set($this->request->data);
            if ($this->FrontCourse->Validation()) {
                $this->FrontCourse->create();
				
                if ($this->FrontCourse->save($this->request->data)) {
					
                    $this->Session->setFlash('Front Course Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
                } else {
                $this->Session->setFlash('Front Course Not Added Please Try Again!', 'message_bad');
                }
        }
        
    }
	
	public function admin_delete($Id = null)
    {
        $this->layout = 'admin_form_layout';
        if (!empty($Id)) {
            try {
                if ($this->FrontCourse->delete($Id)) {
					
                    $this->Session->setFlash('Front Course is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid Front Course.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

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
 
                if ($this->FrontCourse->Validation()) {
               

                if ($this->FrontCourse->save($this->request->data)) {
                                  
                    $this->Session->setFlash('Course Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Course Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Course Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $FrontCourse = $this->FrontCourse->find('first', array(
                'contain' => array(),
                'conditions' => array('Course_ID' => $Id)
            ));
            
            
            if(empty($FrontCourse)) {
                $this->Session->setFlash('Invalid Front Course!', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
  
            $this->request->data = $FrontCourse;
   
        }
	}
	
}
?>