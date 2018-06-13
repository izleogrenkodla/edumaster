<?php
class FeeTypesController extends AppController
{
    var $name = 'FeeTypes';

    public function beforeFilter()
    {
        parent::beforeFilter();

        $this->Auth->allow('App_FeeTypes');

        if(isset($this->Security) &&  ($this->RequestHandler->isAjax() || $this->RequestHandler->isPost())){
            $this->Security->validatePost = false;
            $this->Security->enabled = false;
            $this->Security->csrfCheck = false;
        }
    }
    
    public function admin_index()
    {
    $Session = $this->Session->read('Auth.Admin');
		$conditions = array('FeeType.STATUS'=>1);

		
        $this->layout = 'admin_form_layout';
        //$this->EBook->recursive = 0;
        $this->paginate = array(
            'conditions' => $conditions,
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'FeeType.created DESC'
        );

        $this->set('types', $this->paginate('FeeType'));
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

        if ($this->request->is('post')) {
            $this->FeeType->set($this->request->data);

            if ($this->FeeType->Validation()) {
                $this->FeeType->create();
                if ($this->FeeType->save($this->request->data)) {
                   
                    $this->Session->setFlash('FeeType Type Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
            } else {
                $this->Session->setFlash('FeeType Type Not Added Please Try Again!', 'message_bad');
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
		
		if($Session_data["ROLE_ID"]!=SUPERVISOR_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}

        $this->FeeType->id = $id;
        if (empty($this->FeeType->id)) {
            $this->Session->setFlash('Invalid FeesType !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->FeeType->Validation()) {

                if ($this->FeeType->save($this->request->data)) {
                   $this->Session->setFlash('FeeType Updated Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('FeeType Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('FeeType Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $FeeType = $this->FeeType->find('first', array(
                'contain' => array(),
                'conditions' => array('FT_ID' => $id)
            ));
            if(empty($FeeType)) {
                $this->Session->setFlash('Invalid FeeType !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $FeeType;
        }

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
		
        $FeeType = $this->FeeType->find('first', array(
            'contain' => array(),
            'conditions' => array('FT_ID' => $Id)
        ));
        
        if (!empty($Id)) {
			$this->FeeType->id = $Id;
			if($this->FeeType->saveField("STATUS",0)) { 
				$this->Session->setFlash('FeeType has been removed successfully.', 'message_good');
				$this->redirect(array('action' => 'index'));
			}
		} else {
            $this->Session->setFlash('Invalid FeeType.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }

    public function App_FeeTypes()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;

        $FeeType = $this->FeeType->find('all', array(
            'conditions' => array('STATUS' => 1),
            'fields' => array(),
            'contain' => array()
        ));

        $FeeType = Set::extract('/FeeType/.', $Subjects);

        if(!empty($FeeType))
        {
            $message = 'Available FeeType';
            $status = true;
        }
        else
        {
            $message = 'No Data Found';
            $status = false;
        }

        $result_array = array(
            'status' => $status,
            'message' => $message,
            'data' => $Subject
        );

        echo json_encode($result_array); die;

}    
}