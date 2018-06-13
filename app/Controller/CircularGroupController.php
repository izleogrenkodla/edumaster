<?php
class CircularGroupController extends AppController
{
    var $name = 'CircularGroup';

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
		
        $this->layout = 'admin_form_layout';
        $this->CircularGroup->recursive = 0;
        $this->paginate = array(
            'Contain' => array('AcademicClass'),
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'CircularGroup.created DESC'
        );

        $this->set('CircularGroup', $this->paginate('CircularGroup'));
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
            $this->CircularGroup->set($this->request->data);

            if ($this->CircularGroup->Validation()) {
             //   $this->Subject->create();
                if ($this->request->data) {
					$list = $this->request->data['CLASS_ID'];	

					 foreach($list as $key => $day_id)
                        {
                        $day = $day_id;
							$sub['CircularGroup'] = array(
							'TITLE' => $this->request->data['CircularGroup']['TITLE'],
							'CLASS_ID' => $day,
							'STATUS' => '1',
							 );
					
                            $this->CircularGroup->create();
                            $this->CircularGroup->save($sub);   
						}
                    $this->Session->setFlash('Circular Group Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
            } else {
                $this->Session->setFlash('Circular Group Not Added Please Try Again!', 'message_bad');
            }
        }

        $classes = $this->CircularGroup->AcademicClass->GetAcademicClasses();
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

        $this->CircularGroup->id = $id;
        if (empty($this->CircularGroup->id)) {
            $this->Session->setFlash('Invalid Circular Group !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->CircularGroup->Validation()) {
               
                if ($this->CircularGroup->save($this->request->data)) {

                   $this->Session->setFlash('Circular Group Updated Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Circular Group Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Circular Group Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $CircularGroup = $this->CircularGroup->find('first', array(
                'contain' => array(),
                'conditions' => array('CIR_GR_ID' => $id)
            ));
            if(empty($CircularGroup)) {
                $this->Session->setFlash('Invalid Circular Group !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $CircularGroup;
        }

        $classes = $this->CircularGroup->AcademicClass->GetAcademicClasses();
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
		
        $CircularGroup = $this->CircularGroup->find('first', array(
            'contain' => array(),
            'conditions' => array('CIR_GR_ID' => $Id)
        ));

       if (!empty($Id)) {
            try {
                if ($this->CircularGroup->delete($Id)) {
                    $this->Session->setFlash('Circular Group is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid Circular Group.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }

    /*public function App_GetSubjects()
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

    }*/
}