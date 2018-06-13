<?php
// app/Controller/UsersController.php
class ExamListController extends AppController
{
    var $name = 'ExamList'; 

    public function beforeFilter()
    {
        parent::beforeFilter();

        $this->Auth->allow('App_GetExamlist','App_GetResultofExam','App_GetResult');

        if(isset($this->Security) &&  ($this->RequestHandler->isAjax() || $this->RequestHandler->isPost())){
            $this->Security->validatePost = false;
            $this->Security->enabled = false;
            $this->Security->csrfCheck = false;
        }
    }
    
    public function admin_index()
    {
	
		$Session = $this->Session->read('Auth.Admin');
		$conditions = array();
		//$conditions['ExamList.STATUS']=1;
        $this->layout = 'admin_form_layout';
       	$lists = $this->ExamList->find("all",array(
            //'conditions' => $conditions,
			 'contain' => array('ExamType','AcademicClass','Subject'),
            'limit' => PAGINATION_LIMIT_ADMIN,
            //'order' => 'ExamType.EX_TYPE_ID DESC'
        ));
		
        $this->set('listing', $lists);
    }
    
    
    public function admin_view($ID = null,$Type = null)
    {
        $this->layout = 'admin_form_layout';
		
		 switch($Type) {
            case 3:
				$conditions['ExamList.EXAM_TYPE_ID']= $ID;
                $conditions['ExamList.CLASS_ID BETWEEN ? AND ?'] = array(29,32);
                break;
            case 2:
				$conditions['ExamList.EXAM_TYPE_ID']= $ID;
                $conditions['ExamList.CLASS_ID BETWEEN ? AND ?'] = array(4,26);
                break;
            default:
				$conditions['ExamList.EXAM_TYPE_ID']= $ID;
                $conditions['ExamList.CLASS_ID'] = 1;
				$conditions['ExamList.CLASS_ID'] = 35;
				$conditions['ExamList.CLASS_ID'] = 38;
               
        }
        $ExamData = $this->ExamList->find('all', array(
            'contain' => array('AcademicClass','ExamType'),
            'conditions' => $conditions,
        ));
	
		$this->set('ExamData', $ExamData);
		
		$this->set('Section', $Type);
		
		 $ExamDate = $this->ExamList->find('all', array(
            'contain' => array(),
            'conditions' => $conditions,
			'group' => 'ExamList.EXAM_DATE',
        ));
	
		$this->set('ExamDate', $ExamDate);
		
		if($Type == 2)
		{
			$Examsub4 = $this->ExamList->find('all', array(
				'contain' => array('Subject'),
				'conditions' => array('ExamList.CLASS_ID' => 4),
				'order' => 'ExamList.EXAM_DATE',
			));
		
			$this->set('Examsub4', $Examsub4);
			
			$Examsub8 = $this->ExamList->find('all', array(
				'contain' => array('Subject'),
				'conditions' => array('ExamList.CLASS_ID' => 8),
				'order' => 'ExamList.EXAM_DATE',
			));
			
			$this->set('Examsub8', $Examsub8);
			
			$Examsub11 = $this->ExamList->find('all', array(
				'contain' => array('Subject'),
				'conditions' => array('ExamList.CLASS_ID' => 11),
				'order' => 'ExamList.EXAM_DATE',
			));
			
			$this->set('Examsub11', $Examsub11);
			
			$Examsub14 = $this->ExamList->find('all', array(
				'contain' => array('Subject'),
				'conditions' => array('ExamList.CLASS_ID' => 14),
				'order' => 'ExamList.EXAM_DATE',
			));
			$this->set('Examsub14', $Examsub14);
			
			$Examsub17 = $this->ExamList->find('all', array(
				'contain' => array('Subject'),
				'conditions' => array('ExamList.CLASS_ID' => 17),
				'order' => 'ExamList.EXAM_DATE',
			));
			$this->set('Examsub17', $Examsub17);
			
			$Examsub20 = $this->ExamList->find('all', array(
				'contain' => array('Subject'),
				'conditions' => array('ExamList.CLASS_ID' => 20),
				'order' => 'ExamList.EXAM_DATE',
			));
			$this->set('Examsub20', $Examsub20);
			
			$Examsub23 = $this->ExamList->find('all', array(
				'contain' => array('Subject'),
				'conditions' => array('ExamList.CLASS_ID' => 23),
				'order' => 'ExamList.EXAM_DATE',
			));
			$this->set('Examsub23', $Examsub23);
			
			$Examsub26 = $this->ExamList->find('all', array(
				'contain' => array('Subject'),
				'conditions' => array('ExamList.CLASS_ID' => 26),
				'order' => 'ExamList.EXAM_DATE',
			));
			$this->set('Examsub26', $Examsub26);
			
		}elseif($Type == 3)
		{
			$Examsub29 = $this->ExamList->find('all', array(
				'contain' => array('Subject'),
				'conditions' => array('ExamList.CLASS_ID' => 29),
				'order' => 'ExamList.EXAM_DATE',
			));
			$this->set('Examsub29', $Examsub29);
			
			$Examsub32 = $this->ExamList->find('all', array(
				'contain' => array('Subject'),
				'conditions' => array('ExamList.CLASS_ID' => 32),
				'order' => 'ExamList.EXAM_DATE',
			));
			$this->set('Examsub32', $Examsub32);
		}elseif($Type == 1)
		{
			$Examsub38 = $this->ExamList->find('all', array(
				'contain' => array('Subject'),
				'conditions' => array('ExamList.CLASS_ID' => 38),
				'order' => 'ExamList.EXAM_DATE',
			));
			$this->set('Examsub38', $Examsub38);
			
			$Examsub01 = $this->ExamList->find('all', array(
				'contain' => array('Subject'),
				'conditions' => array('ExamList.CLASS_ID' => 1),
				'order' => 'ExamList.EXAM_DATE',
			));
			$this->set('Examsub01', $Examsub01);
			
			$Examsub35 = $this->ExamList->find('all', array(
				'contain' => array('Subject'),
				'conditions' => array('ExamList.CLASS_ID' => 35),
				'order' => 'ExamList.EXAM_DATE',
			));
			$this->set('Examsub35', $Examsub35);
			
		}
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

           $this->ExamList->set($this->request->data);
				
            if ($this->ExamList->Validation()) {
                $this->ExamList->create();
                if ($this->ExamList->save($this->request->data)) {
				
					$date = $this->General->datefordb($this->request->data['ExamList']['EXAM_DATE']);
					$this->ExamList->saveField("EXAM_DATE",$date);
					
					$subject = $this->request->data['SUBJECT_ID'];
					$this->ExamList->saveField("SUBJECT_ID",$subject);
				
                    $this->Session->setFlash('Exam Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
            } else
            {
                $this->Session->setFlash('ExamType Not Added Please Try Again!', 'message_bad');
            }
        }
		
		$AcademicClass =  $this->ExamList->AcademicClass->GetAcademicClasses();
		$this->set('AcademicClass',$AcademicClass);
	   
	    $examType =  $this->ExamList->ExamType->GetExamTypes();
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
                if ($this->ExamList->delete($Id)) {
                    $this->Session->setFlash('Exam is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid Exam.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }
	
	public function admin_result($ExamId = null,$SID = null)
    {
		$this->layout = 'admin_form_layout';
		
		$this->User = ClassRegistry::init('User');
        $student =$this->User->find('first', array(
            'conditions' => array('User.ID'=>$SID), 
			'contain' => array('AcademicClass'),
			'fields' => array('User.ID','User.FIRST_NAME','User.MIDDLE_NAME','User.LAST_NAME','User.GR_NO'), 
        ));
		
		$std_cls = $student['AcademicClass']['CLASS_ID'];
		
		$this->set('student', $student);
		
		//======================================
		
		$con = array('ExamList.EXAM_TYPE_ID'=>$ExamId ,'ExamList.CLASS_ID'=>$std_cls ,'ExamList.SUBJECT_ID !='=>0);
		
		
		$subjectlist = $this->ExamList->find('all', array(
            'contain' => array('Subject'),
            'conditions' => $con,
		));
			
		$this->set('subjectlist', $subjectlist);
		
		//======================================
		
		$conditions = array('ExamList.EXAM_TYPE_ID' => $ExamId);
		
		 $Examtype = $this->ExamList->find('first', array(
            'contain' => array('ExamType'),
            'conditions' => $conditions,
		));
		
		$this->set('Examtype',$Examtype);
		
		//======================================
				
		 if ($this->request->is('post')) {
			
			$this->ExamList->set($this->request->data);
				
					if ($this->ExamList->save($this->request->data)) {
						
						
						$written = $this->request->data['written'];
						$oral = $this->request->data['oral'];
						$total =  $this->request->data['total']; 
						$grade =  $this->request->data['grade'];
						$remark =  $this->request->data['remark'];
						
						foreach($subjectlist as $key => $sl){
							
							$co = $sl['Subject']['CO_CURRICULAR'];	
							$subj = $sl['ExamList']['SUBJECT_ID'];
							
								
							foreach($written as $wri)
                                {	
                                    $wmark= $written[$key];
                                }
								
							foreach($oral as $or)
                                {
                                    $omark= $oral[$key];
                                }
							
							/*foreach($total as $to)
                                {
                                    $tmark= $total[$key];
                                }*/
								
							$tmark = $wmark + $omark;
								
							foreach($grade as $wri)
                                {
                                    $grd= $grade[$key];
                                }

							foreach($remark as $re)
                                {
                                    $rem= $remark[$key];
                                }	
							
							$this->Result = ClassRegistry::init('Result');
							$markdata['Result'] = array(
                                        'EXAM_TYPE_ID'=>$ExamId,
										'USER_ID'=>$SID,
										'WRITTENMARK'=>$wmark,
										'ORALMARK'=>$omark,
										'TOTALMARK'=>$tmark,
										'GRADE_ID'=>$grd,
										'EXAM_RE_ID'=>$rem,
										'CLASS_ID'=>$std_cls,
										'SUBJECT_ID'=>$subj,
										'PUBLISHED_DATE'=>$this->General->datefordb(date("Y-m-d")),
										'CO_CURRICULAR' => $co,
                                    );
								
                                 $this->Result->create();
                                 $this->Result->save($markdata);
						}
						 $this->redirect(array('action' => 'students'));
					}
        }
		
		$ExamGrade =  $this->ExamList->ExamGrade->GetExamGrade();
		$this->set('ExamGrade',$ExamGrade);
		
		$ExamRemark =  $this->ExamList->ExamRemark->GetExamRemark();
		$this->set('ExamRemark',$ExamRemark);
		
	}
	
	
	public function admin_students()
    {
		$this->layout = 'admin_form_layout';
        $Session = $this->Session->read('Auth.Admin');
        $conditions = array();
		
		$this->Users = ClassRegistry::init('Users');
		
		$conditions['ROLE_ID']=STUDENT_ID;
		
       if(isset($this->params->query["CLS"])) {
            $conditions["User.CLASS_ID"] = $this->params->query["CLS"];
            $this->request->data["User"]["CLS"] = $this->params->query["CLS"];
			
			$students = $this->User->find('all',array(
            'limit' => PAGINATION_LIMIT_ADMIN,
            'contain' => array('AcademicClass'),
			'fields' => array('ID','FIRST_NAME','MIDDLE_NAME','LAST_NAME','IMAGE_URL','GR_NO'),
            'conditions' => $conditions,
            'order' => 'User.FIRST_NAME ASC'
			));
			
			$this->set('users', $students);
			
        }else{
			$students = array();
			$this->set('users', $students);
		}
		
        $this->set('users', $students);
		
        $classes = $this->User->AcademicClass->GetAcademicClasses();
        $this->set('classes', $classes);
		
		$Examtypelist = $this->ExamList->find('all', array(
            'contain' => array('ExamType'),
			'group' => 'ExamList.EXAM_TYPE_ID',
        ));
	
		$this->set('Examtypelist', $Examtypelist);
    }
	
	public function admin_viewresult()
    {
		$this->layout = 'admin_form_layout';
        $Session = $this->Session->read('Auth.Admin');
        $conditions = array();
		
		$this->Users = ClassRegistry::init('Users');
		
		$conditions['ROLE_ID']=STUDENT_ID;
		
       if(isset($this->params->query["CLS"])) {
            $conditions["User.CLASS_ID"] = $this->params->query["CLS"];
            $this->request->data["User"]["CLS"] = $this->params->query["CLS"];
			
			$students = $this->User->find('all',array(
            'limit' => PAGINATION_LIMIT_ADMIN,
            'contain' => array('AcademicClass'),
			'fields' => array('ID','FIRST_NAME','MIDDLE_NAME','LAST_NAME','IMAGE_URL','GR_NO'),
            'conditions' => $conditions,
            'order' => 'User.FIRST_NAME ASC'
			));
			
			$this->set('users', $students);
			
        }else{
			$students = array();
			$this->set('users', $students);
		}
		
        $this->set('users', $students);
		
        $classes = $this->User->AcademicClass->GetAcademicClasses();
        $this->set('classes', $classes);
		
		$Examtypelist = $this->ExamList->find('all', array(
            'contain' => array('ExamType'),
			'group' => 'ExamList.EXAM_TYPE_ID',
        ));
	
		$this->set('Examtypelist', $Examtypelist);
    }
	
	public function admin_showresult($ExamId = null,$SID = null)
	{
		$this->layout = 'admin_form_layout';
		
		$this->User = ClassRegistry::init('User');
        $student =$this->User->find('first', array(
            'conditions' => array('User.ID'=>$SID), 
			'contain' => array('AcademicClass'),
			'fields' => array('User.ID','User.FIRST_NAME','User.MIDDLE_NAME','User.LAST_NAME','User.GR_NO'), 
        ));
		$std_cls = $student['AcademicClass']['CLASS_ID'];
		$this->set('student', $student);
		
		//======================================
		
		$con = array('ExamList.EXAM_TYPE_ID'=>$ExamId ,  'ExamList.CLASS_ID'=>$std_cls, 'ExamList.SUBJECT_ID !='=>0);
		
		$subjectlist = $this->ExamList->find('all', array(
            'contain' => array('Subject'),
            'conditions' => $con,
		));
		
		$this->set('subjectlist', $subjectlist);
		
		//======================================
		
		$conditions = array('ExamList.EXAM_TYPE_ID' => $ExamId);
		
		 $Examtype = $this->ExamList->find('first', array(
            'contain' => array('ExamType'),
            'conditions' => $conditions,
		));
		
		$this->set('Examtype',$Examtype);
		
		//======================================
		
		$this->Result = ClassRegistry::init('Result');
		
		$res =$this->Result->find('all', array(
            'conditions' => array('Result.USER_ID'=>$SID,'Result.EXAM_TYPE_ID'=>$ExamId,'Result.CO_CURRICULAR'=>0), 
			'contain' => array('ExamRemark','ExamGrade','Subject'),
        ));
		
		foreach($res as $r){
				$pdate = $r['Result']['PUBLISHED_DATE'];
		}
		
		$this->set('result', $res);
		
		
		$resco =$this->Result->find('all', array(
            'conditions' => array('Result.USER_ID'=>$SID,'Result.EXAM_TYPE_ID'=>$ExamId,'Result.CO_CURRICULAR'=>1), 
			'contain' => array('ExamRemark','ExamGrade','Subject'),
        ));
		
		$this->set('resultco', $resco);
		
		//======================================
		
		$this->ExamWritten = ClassRegistry::init('ExamWritten');
		
		$Written =$this->ExamWritten->find('all', array(
            'conditions' => array('ExamWritten.CLASS_ID'=>$std_cls,'ExamWritten.EXAM_TYPE_ID'=>$ExamId), 
			'contain' => array(),
        ));

		$this->set('Written', $Written);
		
		//======================================
		
		$this->ExamOral = ClassRegistry::init('ExamOral');
		
		$oral =$this->ExamOral->find('all', array(
            'conditions' => array('ExamOral.CLASS_ID'=>$std_cls,'ExamOral.EXAM_TYPE_ID'=>$ExamId), 
			'contain' => array(),
        ));

		$this->set('oral', $oral);
		
		//======================================
		
		$this->StudentAttendance = ClassRegistry::init('StudentAttendance');
		
		$att_con['StudentAttendance.ATTENDANCE_DATE BETWEEN ? AND ?'] = array('Y-06-01',$pdate);
		$att_con['StudentAttendance.ID'] =  $SID;
		
		$attendance =$this->StudentAttendance->find('all', array(
            'conditions' => $att_con, 
			'contain' => array(),
        ));
		
		
		$dStart = new DateTime('2016-06-01');
		   $dEnd  = new DateTime($pdate);
		   $dDiff = $dStart->diff($dEnd);
		  
		   $totalday = $dDiff->days;
		
		$this->set('totalday', $totalday);
		$this->set('attendance', $attendance);
		
		//======================================
	}
	
	public function App_GetExamlist()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;
		
		$conditions = '';
		
		$class = $this->request->data['CLASS_ID'];
		$examid = $this->request->data['EXAM_TYPE_ID'];
		
			$conditions['ExamList.CLASS_ID'] = $class;
			$conditions['ExamList.EXAM_TYPE_ID'] = $examid;
            
        $exam = $this->ExamList->find('all', array(
            'contain' => array('ExamType','AcademicClass','Subject'),
			'order' => 'ExamList.EXAM_DATE',
			'conditions' => $conditions,
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
	
	public function App_GetResultofExam()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;
		
		$conditions = '';
		
		$class = $this->request->data['CLASS_ID'];
		//$class = 29;
	
		$this->Result = ClassRegistry::init('Result');
			$conditions['Result.CLASS_ID'] = $class;
            
        $examtype = $this->Result->find('all', array(
            'contain' => array('ExamType'),
			'group' => 'Result.EXAM_TYPE_ID',
			'conditions' => $conditions,
			'fields' => 'Result.EXAM_TYPE_ID', 
        ));
		
        if(!empty($examtype))
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
            'data' => $examtype
        );

        echo json_encode($result_array); die;

    }
	
	public function App_GetResult()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;
		
		$condition = '';
		
		$examtype = 7;
		$userid = 1134;
		$classid = 1;
		
		
		/*$examtype = $this->request->data['EXAM_TYPE_ID'];
		$userid = $this->request->data['USER_ID'];*/
		
		$this->Result = ClassRegistry::init('Result');
		$condition['Result.EXAM_TYPE_ID'] = $examtype;
		$condition['Result.USER_ID'] = $userid;
		
		
        $examresult = $this->Result->find('all', array(
            'contain' => array('ExamType','Subject','ExamGrade'),
			'conditions' => $condition,
        ));
		
		$getoral = 0;
		foreach ($examresult as $er){
			$getoral = $getoral + $er['Result']['ORALMARK'];
		}
		
		$getwri = 0;
		foreach ($examresult as $er){
			$getwri = $getwri + $er['Result']['WRITTENMARK'];
		}
		
		$gettotal = 0;
		foreach ($examresult as $er){
			$gettotal = $gettotal + $er['Result']['TOTALMARK'];
		}
		
		$this->ExamOral = ClassRegistry::init('ExamOral');
		
			$condition02['ExamOral.EXAM_TYPE_ID'] = $examtype;
			$condition02['ExamOral.CLASS_ID'] = $classid;
			
			$outoral = $this->ExamOral->find('all', array(
				'contain' => array(),
				'conditions' => $condition02,
			));
			
			$outoforal = 0;
			foreach ($outoral as $er){
				$outoforal = $outoforal + $er['ExamOral']['MARK'];
			}
			
		$this->ExamWritten = ClassRegistry::init('ExamWritten');
		
			$condition03['ExamWritten.EXAM_TYPE_ID'] = $examtype;
			$condition03['ExamWritten.CLASS_ID'] = $classid;
			
			$outwri = $this->ExamWritten->find('all', array(
				'contain' => array(),
				'conditions' => $condition03,
			));
			
			$outofwri = 0;
			foreach ($outwri as $er){
				$outofwri = $outofwri + $er['ExamWritten']['MARK'];
			}
			
		$outtotal = $outoforal + $outofwri;
		
		$pi = ($gettotal*100)/$outtotal;
		
		$per = number_format($pi,2);
			

		$mark = array(
			'getwri' => $getwri,
			'getoral' => $getoral,
			'gettotal' => $gettotal,
			'outoral' => $outoforal,
			'outwri' => $outofwri,
			'outtotal' => $outtotal,
			'Percentage' => $per,
		);
		echo '<pre>';
		print_r(array_merge($examresult,$mark));
		die;
		
        if(!empty($examresult))
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
            'data' => $examresult
        );

        echo json_encode($result_array); die;
    }
	
}