<?php
// app/Controller/UsersController.php
class LeaveTypeController extends AppController
{
    var $name = 'LeaveType'; 

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

    public function admin_index()
    {
        $this->layout = 'admin_form_layout';
        $this->LeaveType->recursive = 0;
        $this->paginate = array(
            'conditions' => '',
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'LeaveType.created DESC'
        );
        $this->set('LeaveType', $this->paginate('LeaveType'));
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
            $this->LeaveType->set($this->request->data);
            if ($this->LeaveType->Validation()) {
                $this->LeaveType->create();
                if ($this->LeaveType->save($this->request->data)) {
                    $this->Session->setFlash('Leave Type Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
            } else {
                $this->Session->setFlash('Leave Type Not Added Please Try Again!', 'message_bad');
            }
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

        $this->LeaveType->id = $id;
        if (empty($this->LeaveType->id)) {
            $this->Session->setFlash('Invalid Leave Type !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->LeaveType->Validation()) {
                if ($this->LeaveType->save($this->request->data)) {
                    $this->Session->setFlash('Leave Type Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Leave Type Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Leave Type Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $LeaveType = $this->LeaveType->find('first', array(
                'contain' => array(),
                'conditions' => array('LEAVE_TYPE_ID' => $id)
            ));
            if(empty($LeaveType)) {
                $this->Session->setFlash('Invalid  Leave Type !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $LeaveType;
        }

       
    }
	
	 public function admin_delete($Id = null)
    {
        $this->layout = 'admin_form_layout';
        if (!empty($Id)) {
            try {
                if ($this->LeaveType->delete($Id)) {
                    $this->Session->setFlash('Leave Type is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid Leave Type.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }

}
?>