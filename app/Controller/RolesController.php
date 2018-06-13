<?php
// app/Controller/UsersController.php
class RolesController extends AppController
{
    var $name = 'Roles';

    public function beforeFilter()
    {
        parent::beforeFilter();

        $this->Auth->allow('App_UserTypes','App_UserRoleForVacancies');

        if(isset($this->Security) &&  ($this->RequestHandler->isAjax() || $this->RequestHandler->isPost())){
            $this->Security->validatePost = false;
            $this->Security->enabled = false;
            $this->Security->csrfCheck = false;
        }
    }

    public function admin_index()
    {
        $this->layout = 'admin_form_layout';
        $this->Role->recursive = 0;
        $this->paginate = array(
            'conditions' => '',
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'Role.ROLE_NAME ASC'
        );

        $this->set('roles', $this->paginate('Role'));
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
            $this->Role->set($this->request->data);
            if ($this->Role->Validation()) {
                $this->Role->create();
                if ($this->Role->save($this->request->data)) {
                    $this->Session->setFlash('Role Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
                } else {
                $this->Session->setFlash('Role Not Added Please Try Again!', 'message_bad');
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
		
		if($Session_data["ROLE_ID"]!=ADMIN_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}

        $this->Role->id = $id;
        if (empty($this->Role->id)) {
            $this->Session->setFlash('Invalid Role !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->Role->Validation()) {
                if ($this->Role->save($this->request->data)) {
                    $this->Session->setFlash('Role Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Role Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Role Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $role = $this->Role->find('first', array(
                'contain' => array(),
                'conditions' => array('ID' => $id)
            ));
            if(empty($role)) {
                $this->Session->setFlash('Invalid Role !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $role;
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
		
		if($Session_data["ROLE_ID"]!=ADMIN_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}
		
        if (!empty($Id)) {
            try {
                if ($this->Role->delete($Id)) {
                    $this->Session->setFlash('Role is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid Role.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }

    public function App_UserTypes()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;

        $conditions = array();

        $conditions = array(
            'ID' => array(STUDENT_ID,TEACHER_ID),
            'STATUS' => 1
        );
        
        $Role = $this->Role->find('all', array(
            'conditions' => $conditions,
            'fields' => array('ID','ROLE_NAME'),
            'contain' => array()
        ));

        $Roles = Set::extract('/Role/.', $Role);

        if(!empty($Roles))
        {
            $message = 'User Roles Found';
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
            'data' => $Roles
        );

        echo json_encode($result_array); die;

    }
    
    public function App_UserRoleForVacancies()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;

        $conditions = array();

        $conditions = array(
            'ID' => array(2,3,4,8,12,13),
            'STATUS' => 1
        );
        
        $Role = $this->Role->find('all', array(
            'conditions' => $conditions,
            'fields' => array('ID','ROLE_NAME'),
            'contain' => array()
        ));

        $Roles = Set::extract('/Role/.', $Role);

        if(!empty($Roles))
        {
            $message = 'User Roles Found';
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
            'data' => $Roles
        );

        echo json_encode($result_array); die;

    }
}