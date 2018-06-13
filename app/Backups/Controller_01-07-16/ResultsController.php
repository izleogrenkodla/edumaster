<?php
class ResultsController extends AppController
{
    var $name = 'Results';

    public function beforeFilter()
    {
        parent::beforeFilter();

        $this->Auth->allow('App_StudentExamResultList','App_StudentExamResult','App_TeacherExamResultList');

        if(isset($this->Security) &&  ($this->RequestHandler->isAjax() || $this->RequestHandler->isPost())){
            $this->Security->validatePost = false;
            $this->Security->enabled = false;
            $this->Security->csrfCheck = false;
        }
    }

      public function admin_index()
    {
        $this->layout = 'admin_form_layout';
        $this->Result->recursive = 0;
		$Session_data = $this->Session->read('Auth.Admin');
		$conditions = array();
		$conditions["Result.STATUS"] = 1;
		switch($Session_data["ROLE_ID"]) {
			case TEACHER_ID:
				$conditions["Exam.CLASS_ID"] = $Session_data["CLASS_ID"];
			break;
			case STUDENT_ID:
				$conditions["Result.STUDENT_ID"] = $Session_data["ID"];
				$conditions[] = "Result.PUBLISH_DATE <= CURDATE()";
				
				
			break;
		}
		
		
       $lists = $this->Result->find('all', array(
	   		'contain'=>array("Student","Exam"=>array("AcademicClass","ExamType")),
			'conditions' => array($conditions),
			'order'=>'Result.EX_ID DESC'
		));

		$this->set('results',$lists);
    }



	
	public function admin_view($id = null) { 
		
        $this->layout = 'admin_form_layout';
		
        $Session_data = $this->Session->read('Auth.Admin');
		 $this->ExamXref = ClassRegistry::init('ExamXref');
        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		

        $this->Result->id = $id;
        if (empty($this->Result->id)) {
            $this->Session->setFlash('Invalid Result!', 'message_bad');
          //  $this->redirect(array('action' => 'index'));
        }

		
            $Result = $this->Result->find('first', array(
               'contain'=>array("Student","Exam"=>array("AcademicClass","ExamType","Supervisor")),
               'conditions' => array('RS_ID' => $id)
            ));

            if(empty($Result)) {
                $this->Session->setFlash('Invalid Result!', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
			$this->request->data = $Result;
        
			$this->ResultXref =  ClassRegistry::init('ResultXref');	
			$ResultXref = $this->ResultXref->find("all",array(
				'contain'=>array("ExamXref"=>array("Subject")),
				'conditions'=>array(
					'ResultXref.RS_ID'=>$id,
					'ResultXref.STATUS'=>1,
				),
			));

			$this->set('Result_xref',$ResultXref);	
		   $this->User =  ClassRegistry::init('User');	
	
	}// end of function
	
	
	public function admin_list() { 
		  $this->layout = 'admin_form_layout';
		  $Session_data = $this->Session->read('Auth.Admin');
		  
		  $this->Exam =  ClassRegistry::init('Exam');	
		  $exams = $this->Exam->find('all',array(
		  	'contain'=>array('ExamXref'=>array("Subject"),'ExamType'),
		  	'conditions'=>array(
				'Exam.CLASS_ID'=>$Session_data["CLASS_ID"],
				'Exam.STATUS'=>1,
				'CURDATE() BETWEEN DATE_SUB(Exam.START_DATE, INTERVAL 30 DAY) AND Exam.END_DATE',
			),	
			'order'=>'Exam.EX_ID DESC'
		  ));

		  $return = array();
		  if(is_array($exams) && sizeof($exams)) {
		  	foreach($exams as $list) { 
				if(is_array($list["ExamXref"]) && sizeof($list["ExamXref"])) {
					foreach($list["ExamXref"] as $lst) { 
						$return[] = array(
							"id"=>$lst["EX_REF_ID"],
							"title"=>$list["ExamType"]["TITLE"].' ['.$lst["Subject"]["TITLE"].']',
							"description"=>'',
							"start"=>$lst["EX_DATE"],
						);
					}
				}
			}
		  }
		  $this->set('listing',$return);
	}
	
      public function admin_delete($Id = null)
    {
   //     $this->layout = 'admin_form_layout';
        if (!empty($Id)) {
            try {
				$this->Exam->id = $Id;
                if ($this->Exam->saveField("STATUS",0)) {
                    $this->Session->setFlash('Exam is successfully deleted', 'message_good');
                   // $this->redirect(array('action' => 'index'));
                } else {
                  //  $this->redirect(array('action' => 'index'));
                    $this->Session->setFlash('Record was not deleted. Unknown error.', 'message_bad');
                }
            } catch (Exception $e) {
                $this->Session->setFlash("Delete failed. {$e->getMessage()}", 'message_bad');
               // $this->redirect(array('action' => 'index'));
            }
            //$this->redirect(array('action' => 'index'));
        } else {
            $this->Session->setFlash('Invalid Exam.', 'message_bad');
          //  $this->redirect(array('action' => 'index'));
        }
        $this->redirect(array('action' => 'index'));
    }

    public function App_StudentExamResultList()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;
        
        if(!empty($this->request->data))
        {
            $UserId = $this->request->data['STUDENT_ID'];
            $currentDate = date('Y-m-d');
        
	$ExamResultList = $this->Result->find('all', array(
	            'fields' => array(),
	            'conditions' => array('Result.PUBLISH_DATE <=' => 'CURDATE()', 'Result.STUDENT_ID' => $UserId),
	            'contain' => array('Exam' => array('ExamType')),
		    'order' => 'Result.PUBLISH_DATE DESC'
	        ));
	        
	        $status = true;
	        $message = 'Available Exam Result List!';
	        
        }
        else
        {
            $message = 'Opps something wrong!';
            $status = false;
        }

        $result_array = array(
            'status' => $status,
            'message' => $message,
            'data' => $ExamResultList
        );

        echo json_encode($result_array); die;
    }
    
    public function App_StudentExamResult()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;
        
        if(!empty($this->request->data))
        {
            $UserId = $this->request->data['STUDENT_ID'];
            $ResultId = $this->request->data['RS_ID'];
            $ExamId = $this->request->data['EX_ID'];
        
		$ExamResult = $this->Result->find('first', array(
	            'fields' => array('RS_ID','EX_ID','RESULT_UPLOAD','EXAM_STATUS'),
	            'conditions' => array('Result.STUDENT_ID ' => $UserId, 'Result.EX_ID' => $ExamId,'Result.RS_ID' => $ResultId),
	            'contain' => array('Exam'=> array('ExamType'),'ResultXref'),
	        ));
	        
		if(isset($ExamResult['Result']['RESULT_UPLOAD']) && $ExamResult['Result']['RESULT_UPLOAD'] != '')
		{
			$data = $ExamResult;
		}
		else
		{
			//$this->ResultXref = ClassRegistry::init('ResultXref');
			
			$ExamMarkResult = $this->Result->find('first', array(
		            'conditions' => array('Result.RS_ID ' => $ResultId),
		            'contain' => array('ResultXref'=>array('ExamXref'=>array('Subject'))),
	        	));
	        	
	        	$data = $ExamMarkResult;
		}
		
		$status = true;
		$message = 'Avaiable Result!';
	        
        }
        else
        {
            $message = 'Opps something wrong!';
            $status = false;
        }

        $result_array = array(
            'status' => $status,
            'message' => $message,
            'data' => $data
        );

        echo json_encode($result_array); die;
    }
    
    public function App_TeacherExamResultList()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;
        
        if(!empty($this->request->data))
        {
            $classId = $this->request->data['CLASS_ID'];
            $studentId = $this->request->data['STUDENT_ID'];
        
	$ExamResultList = $this->Result->find('all', array(
//	            'fields' => array('Exam.CLASS_ID'),
	            'conditions' => array('Exam.CLASS_ID' => $classId, 'Result.STUDENT_ID' => $studentId),
	            'contain' => array('Exam'=>array("ExamType")),
		    'order' => 'Result.PUBLISH_DATE DESC'
	        ));
	        
	    $message = 'Avaiable Exam Result List!';
            $status = true;
	        
        }
        else
        {
            $message = 'Opps something wrong!';
            $status = false;
        }

        $result_array = array(
            'status' => $status,
            'message' => $message,
            'data' => $ExamResultList
        );

        echo json_encode($result_array); die;
    }
	
	 public function admin_download($id = null)
    {
		/*$this->Uploaddocument = ClassRegistry::init('Uploaddocument');
		
		$Uploaddocument = $this->Uploaddocument->find('first', array(
                'contain' => array(),
                'conditions' => array('INQUIRY_ID'=>$id)
            ));
		$doc =  $Uploaddocument['Uploaddocument']['DOC_NAME'];*/
		
		$abc =  SITE_URL . 'files/upload_results'.'/'.$id;
		$this->redirect($abc);
		//die;
		
	}
}