<?php
// app/Controller/UsersController.php
class StaffVacancyController extends AppController
{
    var $name = 'StaffVacancy'; 
 
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
        $this->StaffVacancy->recursive = 0;
        $this->paginate = array(
           // 'conditions' => array("Vacancy.STATUS"=>1),
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'StaffVacancy.created DESC'
        );

        $this->set('StaffVacancy', $this->paginate('StaffVacancy'));
    }
	
 public function admin_add()
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		if($Session_data["ROLE_ID"]!=HR_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}

        if ($this->request->is('post')) {
            $this->StaffVacancy->set($this->request->data);
            if ($this->StaffVacancy->Validation()) {
				
                $this->StaffVacancy->create();
                if ($this->StaffVacancy->save($this->request->data)) {
					
						$this->request->data['StaffVacancy']['USER_ID'] = $Session_data['ID'];
					$this->StaffVacancy->saveField("created_by",$Session_data['ID']);
					
					$ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
					$this->StaffVacancy->saveField("created_ip",$ip);
		
				$this->request->data['StaffVacancy']['LAST_DATE'] = $this->General->datefordb($this->request->data['StaffVacancy']['LAST_DATE']);
					$this->StaffVacancy->saveField("LAST_DATE",$this->request->data['StaffVacancy']['LAST_DATE']);
					
                    $this->Session->setFlash('Vacancy Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
                } else {
                $this->Session->setFlash('Vacancy Not Added Please Try Again!', 'message_bad');
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
		
		if($Session_data["ROLE_ID"]!=HR_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}

        $this->StaffVacancy->id = $id;
        if (empty($this->StaffVacancy->id)) {
            $this->Session->setFlash('Invalid Vacancy !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->StaffVacancy->Validation()) {
                if ($this->StaffVacancy->save($this->request->data)) {
					
                    $this->Session->setFlash('Vacancy Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Vacancy Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Vacancy Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $StaffVacancy = $this->StaffVacancy->find('first', array(
                'contain' => array(),
                'conditions' => array('VACANCY_ID' => $id) 
            ));
			
			$StaffVacancy['StaffVacancy']['LAST_DATE'] = date('d/m/Y', strtotime(str_replace('-','/',$StaffVacancy['StaffVacancy']['LAST_DATE'])));
			
            if(empty($StaffVacancy)) {
                $this->Session->setFlash('Invalid Vacancy !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $StaffVacancy;
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
		
		if($Session_data["ROLE_ID"]!=HR_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}
		
        if (!empty($Id)) {
            try {
                if ($this->StaffVacancy->delete($Id)) {
                    $this->Session->setFlash('Vacancy is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid Vacancy.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }
	
	  public function admin_view($id = null)
    {
        $this->layout = 'admin_form_layout';
        $this->StaffVacancy->id = $id;

        if (empty($this->StaffVacancy->id)) {

            $this->Session->setFlash('Invalid Vacancy !', 'message_bad');
            $this->redirect(array('action' => 'index'));

        }

        $StaffVacancy = $this->StaffVacancy->read(null, $id);

        if (empty($StaffVacancy)) {
            $this->Session->setFlash('Invalid user !', 'message_bad');
            $this->redirect(array('action' => 'teachers'));
        }
        $this->request->data = $StaffVacancy;

    }
	

}
?>