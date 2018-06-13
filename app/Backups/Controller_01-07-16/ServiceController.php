<?php
class ServiceController extends AppController
{
    var $name = 'Service';

    public $components = array('Session');

    public function beforeFilter()
    {
        parent::beforeFilter();

        if (isset($this->Security) && ($this->RequestHandler->isAjax() || $this->RequestHandler->isPost())) {
            $this->Security->validatePost = false;
            $this->Security->enabled = false;
            $this->Security->csrfCheck = false;
        }
        $this->Auth->allow('index');
    }


    public function index() {
        $this->Service->recursive = 0;
        $Services = $this->Service->find('all', array(
            'contain' => array(),
            'conditions' => array('Service.status' => 1),
            'fields' => array('id', 'name', 'description', 'image_url', 'tot')
        ));
        if(!empty($Services)) {
        $Services = Set::extract('/Service/.', $Services);
        echo '{"Services":'.json_encode($Services).'}'; die;
        } else {
        echo json_encode("false"); die;
        }
    }

    public function admin_index()
    {
        $this->layout = 'admin_form_layout';
        $this->Service->recursive = 1;
        $this->paginate = array(
            'condition' => '',
            'limit' => 20,
            'order' => 'Service.name ASC'
        );

        $service = $this->paginate('Service');
        $this->set('results', $service);
    }

    public function admin_view($id = null)
    {
        $this->layout = 'admin_form_layout';
        $this->Service->id = $id;
        if (!$this->Service->exists()) {
            $this->Session->setFlash('Invalid Service', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
        $this->set('data', $this->Service->read(null, $id));
    }

    public function admin_add()
    {
        $this->layout = 'admin_form_layout';
        if ($this->request->is('post')) {
            if ($this->Service->RegisterValidate()) {
                $this->Service->create();
                if ($this->Service->save($this->request->data)) {
                    $this->Session->setFlash('The Service has been saved', 'message_good');
                    Cache::delete('Service_list');
                    $this->redirect(array('action' => 'add'));
                } else {
                    $this->Session->setFlash('The Service could not be saved. Please, try again.', 'message_bad');
                }
            }
        }

    }

    public function admin_edit($id = null)
    {
        $this->layout = 'admin_form_layout';
        $this->Service->id = $id;
        if (!$this->Service->exists()) {
            $this->Session->setFlash('Invalid Service', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Service->RegisterValidate()) {
                if ($this->Service->save($this->request->data)) {
                    Cache::delete('Service_list');
                    $this->Session->setFlash('The Service has been saved', 'message_good');
                    $this->redirect(array('action' => 'add'));
                } else {
                    $this->Session->setFlash('The Service could not be saved. Please, try again.', 'message_bad');
                }
            }
        } else {
            $this->request->data = $this->Service->read(null, $id);
        }
    }

    public function admin_delete($Id = null)
    {
        $this->layout = 'admin_form_layout';
        if (!empty($Id)) {
            try {
                if ($this->Service->delete($Id)) {
                    Cache::delete('Service_list');
                    $this->Session->setFlash('Service is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid Service.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
    }
}
