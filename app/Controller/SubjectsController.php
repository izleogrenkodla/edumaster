<?php
class SubjectsController extends AppController
{
    var $name = 'Subjects';

    public function beforeFilter()
    {
        parent::beforeFilter();

        $this->Auth->allow('App_GetSubjects');

        if(isset($this->Security) &&  ($this->RequestHandler->isAjax() || $this->RequestHandler->isPost())){
            $this->Security->validatePost = false;
            $this->Security->enabled = false;
            $this->Security->csrfCheck = false;
        }
    }
    
    public function admin_index()
    {
    $Session = $this->Session->read('Auth.Admin');
		$conditions = array('Subject.STATUS'=>1);

		
        $this->layout = 'admin_form_layout';
        //$this->EBook->recursive = 0;
        $this->paginate = array(
            'conditions' => $conditions,
            'Contain' => array('AcademicClass'),
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'Subject.created DESC'
        );

        $this->set('subjects', $this->paginate('Subject'));
    }
    
    public function admin_add()
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		//if($Session_data["ROLE_ID"]!=SUPERVISOR_ID) {
		if($Session_data["ROLE_ID"]!=ADMIN_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}

        if ($this->request->is('post')) {
            $this->Subject->set($this->request->data);

            if ($this->Subject->Validation()) {
             //   $this->Subject->create();
                if ($this->request->data) {
					$list = $this->request->data['CLASS_ID'];	

					 foreach($list as $key => $day_id)
                        {
                        $day = $day_id;
							$sub['Subject'] = array(
							'TITLE' => $this->request->data['Subject']['TITLE'],
							'CLASS_ID' => $day,
							'STATUS' => '1',
							'CO_CURRICULAR' => $this->request->data['Subject']['CO_CURRICULAR'],
							 );
					
                            $this->Subject->create();
                            $this->Subject->save($sub);   
						}
                    $this->Session->setFlash('Subject Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
            } else {
                $this->Session->setFlash('Subject Not Added Please Try Again!', 'message_bad');
            }
        }

        $classes = $this->Subject->AcademicClass->GetAcademicClasses();
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
		
		//if($Session_data["ROLE_ID"]!=SUPERVISOR_ID) {
		if($Session_data["ROLE_ID"]!=ADMIN_ID) {	
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}

        $this->Subject->id = $id;
        if (empty($this->Subject->id)) {
            $this->Session->setFlash('Invalid EBook !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->Subject->Validation()) {
                $pdf = '';
               
                if ($this->Subject->save($this->request->data)) {

                   $this->Session->setFlash('Subject Updated Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Subject Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Subject Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $Subject = $this->Subject->find('first', array(
                'contain' => array(),
                'conditions' => array('SUBJECT_ID' => $id)
            ));
            if(empty($Subject)) {
                $this->Session->setFlash('Invalid Subject !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $Subject;
        }

        $classes = $this->Subject->AcademicClass->GetAcademicClasses();
        $this->set('classes', $classes);
      
    }

    public function admin_delete($Id = null)
    {		
		$this->layout = 'admin_form_layout';
		
		$Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		//if($Session_data["ROLE_ID"]!=SUPERVISOR_ID) {
		if($Session_data["ROLE_ID"]!=ADMIN_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}
		
        $Subject = $this->Subject->find('first', array(
            'contain' => array(),
            'conditions' => array('SUBJECT_ID' => $Id)
        ));

        if (!empty($Id)) {
			$this->Subject->id = $Id;
			if($this->Subject->saveField("STATUS",0)) { 
				$this->Session->setFlash('Subject has been removed successfully.', 'message_good');
				$this->redirect(array('action' => 'index'));
			}
		} else {
            $this->Session->setFlash('Invalid Subject.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }

    public function App_GetSubjects()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;

        $conditions = array();

        $conditions = array(
            'STATUS' => 1
        );

        $Subjects = $this->Subject->find('all', array(
            'conditions' => $conditions,
            'fields' => array('SUBJECT_ID','TITLE'),
            'contain' => array()
        ));

        $Subjects = Set::extract('/Subject/.', $Subjects);

        if(!empty($Subjects))
        {
            $message = 'Classes Found';
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
            'data' => $Subjects
        );

        echo json_encode($result_array); die;

    }
}