<?php
// app/Controller/UsersController.php
class ExamWrittenController extends AppController
{
    var $name = 'ExamWritten';

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
        $this->ExamOral->recursive = 0;
        $this->paginate = array(
            'conditions' => '',
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'ExamWritten.CLASS_ID'
        );

        $this->set('ExamWritten', $this->paginate('ExamWritten'));
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
			
           $this->ExamWritten->set($this->request->data);
				
            if ($this->ExamWritten->Validation()) {
                $this->ExamWritten->create();
                if ($this->ExamWritten->save($this->request->data)) {
					
					$subject = $this->request->data['SUBJECT_ID'];
					$this->ExamWritten->saveField("SUBJECT_ID",$subject);
				
                    $this->Session->setFlash('Exam Mark Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
            } else
            {
                $this->Session->setFlash('Exam Mark Not Added Please Try Again!', 'message_bad');
            }
        }
		
		$AcademicClass =  $this->ExamWritten->AcademicClass->GetAcademicClasses();
		$this->set('AcademicClass',$AcademicClass);
	   
	    $examType =  $this->ExamWritten->ExamType->GetExamTypes();
		$this->set('EXAM_TYPE_ID',$examType);
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
                if ($this->ExamWritten->delete($Id)) {
                    $this->Session->setFlash('Exam Mark is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid Exam Mark .', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }
    
    /*public function App_GetClasses()
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

    }*/
}