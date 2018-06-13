<?php
// app/Controller/UsersController.php
class SurveyController extends AppController
{
    var $name = 'Survey';

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
        $this->Survey->recursive = 0;
        $this->paginate = array(
            'conditions' => array('Survey.STATUS'=>1),
            'limit' => PAGINATION_LIMIT_ADMIN, 
            'order' => ''
        );

        $this->set('ser', $this->paginate('Survey'));
		
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
            $this->Survey->set($this->request->data);
            if ($this->Survey->Validation()) {
                $this->Survey->create();
                if ($this->Survey->save($this->request->data)) {
                    $this->Session->setFlash('Survey Data Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
            } else {
                $this->Session->setFlash('Survey Data Not Added Please Try Again!', 'message_bad');
            }
        }

       $classes = $this->User->AcademicClass->GetAcademicClasses();
        $this->set('classes', $classes);

    }

    public function admin_edit($id = null)
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        $this->Survey->id = $id;
        if (empty($this->Survey->id)) {
            $this->Session->setFlash('Invalid Survey Data !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->sms->Validation()) {
                if ($this->Survey->save($this->request->data)) {
                    $this->Session->setFlash('Survey Data Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('City Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('City Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $City = $this->Survey->find('first', array(
                'contain' => array(),
                'conditions' => array('STD_ID' => $id)
            ));
            if(empty($Survey)) {
                $this->Session->setFlash('Invalid City !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $City;
        }

         $classes = $this->User->AcademicClass->GetAcademicClasses();
        $this->set('classes', $classes);
    }

    public function admin_delete($Id = null)
    {
        $this->layout = 'admin_form_layout';
        if (!empty($Id)) {
            try {
                if ($this->Survey->delete($Id)) {
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
?>