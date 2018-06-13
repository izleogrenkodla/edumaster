<?php
// app/Controller/UsersController.php
class ExamSyllabusController extends AppController
{
    var $name = 'ExamSyllabus';

    public function beforeFilter()
    {
        parent::beforeFilter();

        $this->Auth->allow('App_GetExam','App_GetExamSyllabus');

        if(isset($this->Security) &&  ($this->RequestHandler->isAjax() || $this->RequestHandler->isPost())){
            $this->Security->validatePost = false;
            $this->Security->enabled = false;
            $this->Security->csrfCheck = false;
        }
    }

    public function admin_index()
    {
        $this->layout = 'admin_form_layout';
		$Session = $this->Session->read('Auth.Admin');
		$conditions = '';
		switch($Session["ROLE_ID"]) { 
			
			case STUDENT_ID:
				$conditions['ExamSyllabus.CLASS_ID'] = $Session["CLASS_ID"];	
			break;
			default:
					
			break;
			
		}
		
        $this->ExamSyllabus->recursive = 0;
        $this->paginate = array(
            'conditions' => $conditions,
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'ExamSyllabus.EXAM_TYPE_ID'
        );

        $this->set('ExamSyllabus', $this->paginate('ExamSyllabus'));
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
            $this->ExamSyllabus->set($this->request->data);
            if ($this->ExamSyllabus->Validation()) {
                $this->ExamSyllabus->create();
                if ($this->ExamSyllabus->save($this->request->data)) {
					
					$subject = $this->request->data['SUBJECT_ID'];
					$this->ExamSyllabus->saveField("SUBJECT_ID",$subject);
					
                    $this->Session->setFlash('Exam Syllabus Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
                } else {
                $this->Session->setFlash('Exam Syllabus Not Added Please Try Again!', 'message_bad');
                }
        }
		
		$AcademicClass =  $this->ExamSyllabus->AcademicClass->GetAcademicClasses();
		$this->set('AcademicClass',$AcademicClass);
	   
	    $examType =  $this->ExamSyllabus->ExamType->GetExamTypes();
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
                if ($this->ExamSyllabus->delete($Id)) {
                    $this->Session->setFlash('Exam Syllabus is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid Exam Syllabus.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }
	
	public function App_GetExam()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;

		$this->loadModel('ExamList');
        $exam = $this->ExamList->find('all', array(
            'contain' => array('ExamType','AcademicClass'),
			'group' => 'ExamList.EXAM_TYPE_ID',
        ));

        if(!empty($exam))
        {
            $message = 'Exam Found';
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
            'data' => $exam
        );

        echo json_encode($result_array); die;

    }
	
	public function App_GetExamSyllabus()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;
		
		$conditions = '';
		
		$class = $this->request->data['CLASS_ID'];
        $RoleId = $this->request->data['ROLE_ID'];
		$examid = $this->request->data['EXAM_TYPE_ID'];
		
		if(isset($class) && !empty($class))
        {
            if(isset($RoleId) && $RoleId == STUDENT_ID)
            {
                $conditions['ExamSyllabus.CLASS_ID'] = $class;
				$conditions['ExamSyllabus.EXAM_TYPE_ID'] = $examid;
            }else{
				
			}
        }
		
        $exam = $this->ExamSyllabus->find('all', array(
            'contain' => array('ExamType','AcademicClass','Subject'),
			'conditions' => $conditions,
        ));
		
        if(!empty($exam))
        {
            $message = 'Exam Syllabus Found';
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
            'data' => $exam
        );

        echo json_encode($result_array); die;

    }
	
	
    
   
}