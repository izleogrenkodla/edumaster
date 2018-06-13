<?php
// app/Controller/UsersController.php
class CountryController extends AppController
{
    var $name = 'Country';

    public function beforeFilter()
    {
        parent::beforeFilter();

        $this->Auth->allow('App_GetCountries');

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
            'order' => 'Country.COUNTRY_NAME ASC'
        );
		
        $this->set('states', $this->paginate('Country'));
    }

    public function admin_add()
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		//if($Session_data["ROLE_ID"]!=ADMIN_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		//}

        if ($this->request->is('post')) {
            $this->Country->set($this->request->data);
            if ($this->Country->Validation()) {
                $this->Country->create();
                if ($this->Country->save($this->request->data)) {
                    $this->Session->setFlash('Country Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
            } else {
                $this->Session->setFlash('Country Not Added Please Try Again!', 'message_bad');
            }
        }

        /*$countries = $this->State->Country->GetCountries();
        $this->set('countries', $countries);*/

    }

    public function admin_edit($id = null)
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		//if($Session_data["ROLE_ID"]!=ADMIN_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		//}

        $this->Country->id = $id;
        if (empty($this->Country->id)) {
            $this->Session->setFlash('Invalid Country !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->Country->Validation()) {
                if ($this->Country->save($this->request->data)) {
                    $this->Session->setFlash('Country Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Country Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Country Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $Country = $this->Country->find('first', array(
                'contain' => array(),
                'conditions' => array('COUNTRY_ID' => $id)
            ));
            if(empty($Country)) {
                $this->Session->setFlash('Invalid Country !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $Country;
        }

        /*$countries = $this->State->Country->GetCountries();
        $this->set('countries', $countries);*/
    }

    public function admin_delete($Id = null)
    {
        $this->layout = 'admin_form_layout';
		
		$Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		//if($Session_data["ROLE_ID"]!=ADMIN_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		//}
		
        if (!empty($Id)) {
            try {
                if ($this->Country->delete($Id)) {
                    $this->Session->setFlash('Country is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid Country.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }
	
    public function App_GetCountries()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;

        $Country = $this->Country->find('all', array(
            'fields' => array('COUNTRY_ID','COUNTRY_NAME'),
            'conditions' => array('STATUS' => 1),
            'contain' => array()
        ));

        $Countries = Set::extract('/Country/.', $Country);

        if(!empty($Countries))
        {
            $message = 'Countries Found';
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
            'data' => $Countries
        );

        echo json_encode($result_array); die;

    }
}
