<?php
// app/Controller/UsersController.php
class BloodGroupsController extends AppController
{
    var $name = 'BloodGroups';

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
        $this->BloodGroup->recursive = 0;
        $this->paginate = array(
            'conditions' => '',
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'BloodGroup.BLOOD_GROUP_NAME ASC'
        );

        $this->set('bloodgroups', $this->paginate('BloodGroup'));
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
            $this->BloodGroup->set($this->request->data);
            if ($this->BloodGroup->Validation()) {
                $this->BloodGroup->create();
                if ($this->BloodGroup->save($this->request->data)) {
                    $this->Session->setFlash('Blood Group Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
                } else {
                $this->Session->setFlash('Blood Group Not Added Please Try Again!', 'message_bad');
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

        $this->BloodGroup->id = $id;
        if (empty($this->BloodGroup->id)) {
            $this->Session->setFlash('Invalid Blood Group !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->BloodGroup->Validation()) {
                if ($this->BloodGroup->save($this->request->data)) {
                    $this->Session->setFlash('Blood Group Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Blood Group Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Blood Group Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $BloodGroup = $this->BloodGroup->find('first', array(
                'contain' => array(),
                'conditions' => array('BLOOD_GROUP_ID' => $id)
            ));
            if(empty($BloodGroup)) {
                $this->Session->setFlash('Invalid Blood Group !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $BloodGroup;
        }
    }

    public function admin_delete($Id = null)
    {
        $this->layout = 'admin_form_layout';
        if (!empty($Id)) {
            try {
                if ($this->BloodGroup->delete($Id)) {
                    $this->Session->setFlash('Blood Group is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid Blood Group.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }
}