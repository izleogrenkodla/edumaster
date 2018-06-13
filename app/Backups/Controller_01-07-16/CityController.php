<?php
// app/Controller/UsersController.php
class CityController extends AppController
{
    var $name = 'City';

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
        $this->City->recursive = 0;
        $this->paginate = array(
            'conditions' => '',
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'City.CITY_NAME ASC'
        );

        $this->set('cities', $this->paginate('City'));
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
            $this->City->set($this->request->data);
            if ($this->City->Validation()) {
                $this->City->create();
                if ($this->City->save($this->request->data)) {
                    $this->Session->setFlash('City Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
            } else {
                $this->Session->setFlash('City Not Added Please Try Again!', 'message_bad');
            }
        }

        $states = $this->City->State->GetStates();
        $this->set('states', $states);

    }

    public function admin_edit($id = null)
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        $this->City->id = $id;
        if (empty($this->City->id)) {
            $this->Session->setFlash('Invalid City !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->City->Validation()) {
                if ($this->City->save($this->request->data)) {
                    $this->Session->setFlash('City Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('City Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('City Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $City = $this->City->find('first', array(
                'contain' => array(),
                'conditions' => array('CITY_ID' => $id)
            ));
            if(empty($City)) {
                $this->Session->setFlash('Invalid City !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $City;
        }

        $states = $this->City->State->GetStates();
        $this->set('states', $states);
    }

    public function admin_delete($Id = null)
    {
        $this->layout = 'admin_form_layout';
        if (!empty($Id)) {
            try {
                if ($this->City->delete($Id)) {
                    $this->Session->setFlash('City is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid City.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }
}