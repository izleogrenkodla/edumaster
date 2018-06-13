<?php
class ExamsController extends AppController
{
    var $name = 'Exams';

    public function beforeFilter()
    {
        parent::beforeFilter();

        $this->Auth->allow('App_ExamSchedulesList','App_ExamData');

        if(isset($this->Security) &&  ($this->RequestHandler->isAjax() || $this->RequestHandler->isPost())){
            $this->Security->validatePost = false;
            $this->Security->enabled = false;
            $this->Security->csrfCheck = false;
        }
    }

      public function admin_index()
    {
        $this->layout = 'admin_form_layout';
        $this->Exam->recursive = 0;
		$Session_data = $this->Session->read('Auth.Admin');
		$conditions = array();
		$conditions["Exam.STATUS"] = 1;
		
		switch($Session_data["ROLE_ID"]) {
			case TEACHER_ID:
				$conditions["Exam.CLASS_ID"] =$Session_data["CLASS_ID"];				
			break;
		}

       $months = array("01"=>"JAN","02"=>"FEB","03"=>"MAR","04"=>"APR","05"=>"MAY","06"=>"JUN","07"=>"JUL","08"=>"AUG","09"=>"SEP","10"=>"OCT","11"=>"NOV","12"=>"DEC");
		$this->set('months',$months);
		
	   if(isset($this->params->query["data"]["Exam"]["CLASS_ID"]) && $this->params->query["data"]["Exam"]["CLASS_ID"]!='') {
	   		$conditions["Exam.CLASS_ID"] = $this->params->query["data"]["Exam"]["CLASS_ID"];
	   }

	   if(isset($this->params->query["data"]["Exam"]["MONTH"]) && $this->params->query["data"]["Exam"]["MONTH"]!='') {
	   		$conditions["? BETWEEN MONTH(Exam.START_DATE) AND MONTH(Exam.END_DATE)"] = array($this->params->query["data"]["Exam"]["MONTH"]);
	   }

       $lists = $this->Exam->find('all', array(
			'contain' => array("AcademicClass","Supervisor","ExamType"),
			'conditions' => array($conditions),
			'order'=>'Exam.EX_ID DESC'
		));
		
		$this->Session->write('Filter_Exam',$lists);
	
		$return = array();

		$this->set('exams',$lists);
		$AcademicClass =  $this->Exam->AcademicClass->GetAcademicClasses();
	   $this->set('AcademicClass',$AcademicClass);
    }

    public function admin_export_exams() { 
		App::import('Vendor', 'Export', array('file' => 'Export' . DS . '/excel_xml.php'));
		$xls = new Excel_XML('UTF-8', false, 'Applicant Report');
		
		  $report_column = array('Exam Type','Class','Supervisor', 'Start Date', 'End Date');
				$lists = $this->Session->read('Filter_Exam');
			//	pr($lists);die;
				$i = 0;
		        foreach($lists as $list) { 
						$exams[0] = $report_column;
						$exams[$i+1]  = array(
						$list["ExamType"]["TITLE"],
						$list["AcademicClass"]["CLASS_NAME"],
						$list["Supervisor"]["FIRST_NAME"].' '.$list["Supervisor"]["LAST_NAME"],
						$list["Exam"]["START_DATE"],
						$list["Exam"]["END_DATE"],
					);
					$i++;
				}

			$xls->addArray($exams);
            $xls->generateXML('exams_'.date('d-m-Y'));
			//$this->Session->delete('Filter_Exam');
            die;
		
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
            $this->Exam->set($this->request->data);
            if ($this->Exam->Validation()) {
				//pr($this->request->data);die;
				$start_dt = new DateTime($this->General->datefordb($this->request->data["Exam"]["START_DATE"]));
				$end_dt = new DateTime($this->General->datefordb($this->request->data["Exam"]["END_DATE"]));
				
				if(($end_dt < $start_dt)) {
					$this->Session->setFlash('Invalid date selected. Please try again.!', 'message_bad');
					
				}else{
					$this->Exam->create();
					
						$this->request->data["Exam"]["CREATED_BY"] = $Session_data['ID'];
						$this->request->data["Exam"]["START_DATE"] = $this->General->datefordb($this->request->data["Exam"]["START_DATE"]);
						$this->request->data["Exam"]["END_DATE"] = $this->General->datefordb($this->request->data["Exam"]["END_DATE"]);;
					if ($this->Exam->save($this->request->data)) {
						$this->Session->setFlash('Exam Added Successfully!', 'message_good');
						$idx = $this->Exam->getLastInsertId();
						$exams = $this->Exam->Subject->find("all",array(
							'conditions'=>array(
								'Subject.STATUS'=>1,
								'Subject.CLASS_ID'=>$this->request->data["Exam"]["CLASS_ID"],
							),
						));

				        $this->ExamXref = ClassRegistry::init('ExamXref');
						if(is_array($exams) && sizeof($exams)) {
							foreach($exams as $kk=>$exam) { 
								$tmp = array();
								$tmp["EX_ID"] = $idx;
								$tmp["SUBJECT_ID"] = $exam["Subject"]["SUBJECT_ID"];
								$this->ExamXref->create();
								$this->ExamXref->save(array("ExamXref"=>$tmp));
							}
						}
						$this->redirect(array('action' => 'edit',$idx));
					}
				}
			} else {
				$this->Session->setFlash('Exam Not Added Please Try Again!', 'message_bad');
			}
				
        }
       
       $AcademicClass =  $this->Exam->AcademicClass->GetAcademicClasses();
	   $this->set('AcademicClass',$AcademicClass);
	   
       $supervisor =  $this->Exam->User->GetUserGroupWise(SUPERVISOR_ID);
	   $this->set('supervisor',$supervisor);
	   
	    $examType =  $this->Exam->ExamType->GetExamTypes();
	   $this->set('exam_types',$examType);
	   
    }

    public function admin_edit($id = null)
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');
		 $this->ExamXref = ClassRegistry::init('ExamXref');
        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		

        $this->Exam->id = $id;
        if (empty($this->Exam->id)) {
            $this->Session->setFlash('Invalid Exams!', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->Exam->Validation()) {
				$examXref = $this->request->data["ExamXref"];
				if(is_array($examXref) && sizeof($examXref)) { 
					foreach($examXref as $exk=>$exv) { 
						$this->ExamXref->id = $exk;
						//echo $this->General->datefordb($exv["EX_DATE"]);die;
						$this->ExamXref->saveField('EX_DATE',$this->General->datefordb($exv["EX_DATE"]));
						$this->ExamXref->saveField('TOTAL_MARKS',$exv["TOTAL_MARKS"]);	 
					}
				}
				$this->Session->setFlash('Exam Saved Successfully!', 'message_good');
				$this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Exam Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $Exam = $this->Exam->find('first', array(
                'contain' => array(),
                'conditions' => array('EX_ID' => $id)
            ));
            if(empty($Exam)) {
                $this->Session->setFlash('Invalid Exam!', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
			$Exam["Exam"]["START_DATE"] = $this->General->dbfordate($Exam["Exam"]["START_DATE"]);
			$Exam["Exam"]["END_DATE"] = $this->General->dbfordate($Exam["Exam"]["END_DATE"]);
			$this->request->data = $Exam;
	       
			$ExamXref = $this->ExamXref->find('all', array(
                'contain' => array("Subject"),
                'conditions' => array('EX_ID' => $id)
            ));
			
			 $examType =  $this->Exam->ExamType->GetExamTypes();
			  $this->set('exam_types',$examType);
			
			$this->set('exam_xref',$ExamXref);	
            
        }
		
	   $AcademicClass =  $this->Exam->AcademicClass->GetAcademicClasses();
	   $this->set('AcademicClass',$AcademicClass);
	   
       		$supervisor =  $this->Exam->User->GetUserGroupWise(SUPERVISOR_ID);
	   $this->set('supervisor',$supervisor);
    }
	
	public function admin_result($id = null) { 
		
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');
		$this->ExamXref = ClassRegistry::init('ExamXref');
		 
        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        $this->Exam->id = $id;
        if (empty($this->Exam->id)) {
            $this->Session->setFlash('Invalid Exams!', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
				$this->Exam->set($this->request->data);
            if ($this->Exam->Validation()) {
			
		        $this->Result = ClassRegistry::init('Result');
				$result = $this->Result->find('first',array(
					'conditions'=>array(
						'Result.EX_ID'=>$id,
						'Result.STUDENT_ID'=>$this->request->data["Exam"]["STUDENT_ID"],
						'Result.STATUS'=>1,
					),
				));

				if(is_array($result) && sizeof($result)>0)	 {
					$this->Result->id = $result["Result"]["RS_ID"];
				}else{
					$this->Result->create();
				}
				
				
				$tmp_result = array(
					"EX_ID"=>$id,
					"STUDENT_ID"=>$this->request->data["Exam"]["STUDENT_ID"],
					"UPLOAD_BY"=>$Session_data["ID"],
					"PUBLISH_DATE"=>$this->General->datefordb($this->request->data["Exam"]["PUBLISH_DATE"]),
					"EXAM_STATUS"=>$this->request->data["Exam"]["EXAM_STATUS"],
				);
	
					$this->Result->save(array("Result"=>$tmp_result));
					if(is_array($result) && sizeof($result)>0)	 {
						$result_idx = $result["Result"]["RS_ID"];
					}else{
						$result_idx = $this->Result->getLastInsertId();						
					}
					
				if(isset($this->request->data["Exam"]["RESULT_UPLOAD"]["size"]) && $this->request->data["Exam"]["RESULT_UPLOAD"]["size"]>0) {
					$result_upload  = $this->request->data["Exam"]["RESULT_UPLOAD"];
					$ext  = explode(".",strtolower($result_upload["name"]));
					$ex_list = explode(",",ALLOWED_EXT);
					if(in_array($ext[1],$ex_list)) { 
						$filepath = 'upload_results/';
						$fname = $result_idx.'.'.$ext[1];
						if(move_uploaded_file($result_upload["tmp_name"],UPLOADURL.$filepath.$fname)) { 
							$this->Result->id = $result_idx;
							$this->Result->saveField("RESULT_UPLOAD",SITE_URL.'files/'.$filepath.$fname);
							$this->Session->setFlash('Exam Saved Successfully!', 'message_good');
							$this->redirect(array('action' => 'index'));
						}	
						
					}else{
						$this->Session->setFlash('You are trying to upload invalid image. Please try to upload allowed extention', 'message_bad');
						$this->redirect(array('action' => 'index'));
					}
				}
				
				if(is_array($this->request->data["ExamXref"]) && sizeof($this->request->data["ExamXref"])>0) { 
					$this->Result->id = $result_idx;
					$this->Result->saveField('RESULT_UPLOAD','');					
					$this->ResultXref = ClassRegistry::init('ResultXref');
					$this->ResultXref->deleteAll(array("ResultXref.RS_ID"=>$result_idx)); 
					
					foreach($this->request->data["ExamXref"] as $examkey=>$examXref) { 
						$result_xref = array(
							"RS_ID"=>$result_idx,
							"MARKS"=>$examXref["MARKS"],
							"EX_REF_ID"=>$examXref["EX_REF_ID"],
							"UPLOAD_BY"=>$Session_data["ID"],
							"SUBJECT_STATUS"=>$examXref["SUBJECT_STATUS"],
						);
						
						$this->ResultXref->create();
						$this->ResultXref->save(array("ResultXref"=>$result_xref));	
					}
				}

				$this->Session->setFlash('Exam Saved Successfully!', 'message_good');
				$this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Exam Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $Exam = $this->Exam->find('first', array(
                'contain' => array(),
                'conditions' => array('EX_ID' => $id)
            ));
            if(empty($Exam)) {
                $this->Session->setFlash('Invalid Exam!', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
			$Exam["Exam"]["START_DATE"] = $this->General->dbfordate($Exam["Exam"]["START_DATE"]);
			$Exam["Exam"]["END_DATE"] = $this->General->dbfordate($Exam["Exam"]["END_DATE"]);
			$this->request->data = $Exam;
        }
		
			
		  $ExamXref = $this->ExamXref->find('all', array(
                'contain' => array("Subject"),
                'conditions' => array('EX_ID' => $id)
            ));

			$this->set('exam_xref',$ExamXref);	
			
			$examType =  $this->Exam->ExamType->GetExamTypes();
	  		 $this->set('exam_types',$examType);
			
			$students =  $this->Exam->User->getStudentsByClass($Exam["Exam"]["CLASS_ID"]);
			
			$this->set('students',$students); 
			
		  $AcademicClass =  $this->Exam->AcademicClass->GetAcademicClasses();
	   $this->set('AcademicClass',$AcademicClass);
	   
       $supervisor =  $this->Exam->User->GetUserGroupWise(SUPERVISOR_ID);
	   $this->set('supervisor',$supervisor);
	   $subject_status = array(
				SUB_COMPARTMENT=>"COMPARTMENT",
				SUB_FAIL=>"FAIL",
				SUB_PASS=>"PASS"
			);
	   $this->set('subject_status',$subject_status);
    
	
	}// end of function
	
	
	public function admin_list() { 
		  $this->layout = 'admin_form_layout';
		  $Session_data = $this->Session->read('Auth.Admin');
		  
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

    public function App_ExamSchedulesList()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;

        if(!empty($this->request->data))
        {

		$classId = $this->request->data['CLASS_ID'];
	        
	        $ExamData = $this->Exam->find('all', array(
	            'fields' => array(),
	            'conditions' => array('Exam.CLASS_ID' => $classId),
	            'contain' => array('AcademicClass','ExamType','User'),
	            'order' => 'Exam.EX_ID ASC'
	        ));
	
	        if(!empty($ExamData))
	        {
	            $message = 'Available Exam Data';
	            $status = true;
	        }
	        else
	        {
	            $message = 'No Data Found';
	            $status = false;
	        }
        }
        else
        {
            $message = 'Opps something wrong!';
            $status = false;
        }

        $result_array = array(
            'status' => $status,
            'message' => $message,
            'data' => $ExamData
        );

        echo json_encode($result_array); die;
    }
    
    public function App_ExamData()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;

        if(!empty($this->request->data))
        {

		$examId = $this->request->data['EX_ID'];
	        
	        $this->ExamXref = ClassRegistry::init('ExamXref');
	        
	        $ExamData = $this->ExamXref->find('all', array(
	            'conditions' => array('ExamXref.EX_ID' => $examId),
	            'contain' => array('Subject'),
	            'order' => 'ExamXref.EX_DATE ASC'
	        ));
	
	        if(!empty($ExamData))
	        {
	            $message = 'Available Exam Data';
	            $status = true;
	        }
	        else
	        {
	            $message = 'No Data Found';
	            $status = false;
	        }
        }
        else
        {
            $message = 'Opps something wrong!';
            $status = false;
        }

        $result_array = array(
            'status' => $status,
            'message' => $message,
            'data' => $ExamData
        );

        echo json_encode($result_array); die;
    }
}