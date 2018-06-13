<?php
// app/Controller/UsersController.php
class StatesController extends AppController
{
    var $name = 'States';

    public function beforeFilter()
    {
        parent::beforeFilter();

        $this->Auth->allow('App_GetStates');

        if(isset($this->Security) &&  ($this->RequestHandler->isAjax() || $this->RequestHandler->isPost())){
            $this->Security->validatePost = false;
            $this->Security->enabled = false;
            $this->Security->csrfCheck = false;
        }
    }

	public function admin_index()
    {
        $this->layout = 'admin_form_layout';
        //$this->City->recursive = 0;
        $this->paginate = array(
            'conditions' => '',
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'State.STATE_NAME ASC'
        );
		
        $this->set('states', $this->paginate('State'));
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
            $this->State->set($this->request->data);
            if ($this->State->Validation()) {
                $this->State->create();
                if ($this->State->save($this->request->data)) {
                    $this->Session->setFlash('State Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
            } else {
                $this->Session->setFlash('State Not Added Please Try Again!', 'message_bad');
            }
        }

        $countries = $this->State->Country->GetCountries();
        $this->set('countries', $countries);

    }

    public function admin_edit($id = null)
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

        $this->State->id = $id;
        if (empty($this->State->id)) {
            $this->Session->setFlash('Invalid State !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->State->Validation()) {
                if ($this->State->save($this->request->data)) {
                    $this->Session->setFlash('State Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('State Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('State Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $State = $this->State->find('first', array(
                'contain' => array(),
                'conditions' => array('STATE_ID' => $id)
            ));
            if(empty($State)) {
                $this->Session->setFlash('Invalid State !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $State;
        }

        $countries = $this->State->Country->GetCountries();
        $this->set('countries', $countries);
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
                if ($this->State->delete($Id)) {
                    $this->Session->setFlash('State is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid State.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }
	
    public function App_GetStates()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;

        $State = $this->State->find('all', array(
            'fields' => array('STATE_ID','STATE_NAME'),
            'conditions' => array('STATUS' => 1),
            'contain' => array()
        ));

        $States = Set::extract('/State/.', $State);

        if(!empty($States))
        {
            $message = 'States Found';
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
            'data' => $States
        );

        echo json_encode($result_array); die;

    }
}
