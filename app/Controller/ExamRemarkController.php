<?php
// app/Controller/UsersController.php
class ExamRemarkController extends AppController
{
    var $name = 'ExamRemark';

    public function beforeFilter()
    {
        parent::beforeFilter();

        $this->Auth->allow('App_GetClasses');

        if(isset($this->Security) &&  ($this->RequestHandler->isAjax() || $this->RequestHandler->isPost())){
            $this->Security->validatePost = false;
            $this->Security->enabled = false;
            $this->Security->csrfCheck = false;
        }
    }

    public function admin_index()
    {
        $this->layout = 'admin_form_layout';
        $this->AcademicClass->recursive = 0;
        $this->paginate = array(
            'conditions' => '',
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'ExamRemark.EXAM_RE_ID desc'
        );

        $this->set('ExamRemark', $this->paginate('ExamRemark'));
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
            $this->ExamRemark->set($this->request->data);
            if ($this->ExamRemark->Validation()) {
                $this->ExamRemark->create();
                if ($this->ExamRemark->save($this->request->data)) {
                    $this->Session->setFlash('Exam Remark Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
                } else {
                $this->Session->setFlash('Exam Remark Not Added Please Try Again!', 'message_bad');
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

        $this->ExamRemark->id = $id;
        if (empty($this->ExamRemark->id)) {
            $this->Session->setFlash('Invalid Exam Remark!', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->ExamRemark->Validation()) {
                if ($this->ExamRemark->save($this->request->data)) {
                    $this->Session->setFlash('Exam Remark Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Exam Remark Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Exam Remark Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $ExamRemark = $this->ExamRemark->find('first', array(
                'contain' => array(),
                'conditions' => array('EXAM_RE_ID' => $id)
            ));
            if(empty($ExamRemark)) {
                $this->Session->setFlash('Invalid Exam Remark !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $ExamRemark;
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
                if ($this->ExamRemark->delete($Id)) {
                    $this->Session->setFlash('Exam Remark is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid Exam Remark.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }
    
    public function App_GetClasses()
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

        $Classes = $this->AcademicClass->find('all', array(
            'conditions' => $conditions,
            'fields' => array('CLASS_ID','CLASS_NAME'),
            'contain' => array()
        ));

        $Classes = Set::extract('/AcademicClass/.', $Classes);

        if(!empty($Classes))
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
            'data' => $Classes
        );

        echo json_encode($result_array); die;

    }
}