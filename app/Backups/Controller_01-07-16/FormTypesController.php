<?php
// app/Controller/UsersController.php
class FormTypesController extends AppController
{
    var $name = 'FormTypes';

    public function beforeFilter()
    {
        parent::beforeFilter();

        $this->Auth->allow('App_UserTypes');

        if(isset($this->Security) &&  ($this->RequestHandler->isAjax() || $this->RequestHandler->isPost())){
            $this->Security->validatePost = false;
            $this->Security->enabled = false;
            $this->Security->csrfCheck = false;
        }
    }

    public function admin_index()
    {
        $this->layout = 'admin_form_layout';
        $this->FormType->recursive = 0;
        $this->paginate = array(
            'conditions' => '',
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'FormType.FORM_TYPE_NAME ASC'
        );

        $this->set('types', $this->paginate('FormType'));
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
            $this->FormType->set($this->request->data);
            if ($this->FormType->Validation()) {
                $this->FormType->create();
                if ($this->FormType->save($this->request->data)) {
                    $this->Session->setFlash('Form Type Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
                } else {
                $this->Session->setFlash('Form Type Not Added Please Try Again!', 'message_bad');
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

        $this->FormType->id = $id;
        if (empty($this->FormType->id)) {
            $this->Session->setFlash('Invalid Form Type !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->FormType->Validation()) {
                if ($this->FormType->save($this->request->data)) {
                    $this->Session->setFlash('Form Type Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Form Type Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Form Type Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $FormTypes = $this->FormType->find('first', array(
                'contain' => array(),
                'conditions' => array('FORM_TYPE_ID' => $id)
            ));
            if(empty($FormTypes)) {
                $this->Session->setFlash('Invalid Form Type !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $FormTypes;
        }
    }

    public function admin_delete($Id = null)
    {
        $this->layout = 'admin_form_layout';
        if (!empty($Id)) {
            try {
                if ($this->FormType->delete($Id)) {
                    $this->Session->setFlash('FormType is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid Form Type.', 'message_bad');
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
}