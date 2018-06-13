<?php
// app/Controller/UsersController.php
class TeacherTimeTablesController extends AppController 
{ 
    var $name = 'TeacherTimeTables';

    public function beforeFilter()
    {
		$this->Auth->allow('App_Get_Student_Time_Table', 'App_Get_Teacher_Time_Table');
        parent::beforeFilter();
        $this->Auth->allow('App_CheckHoliday');
        if(isset($this->Security) &&  ($this->RequestHandler->isAjax() || $this->RequestHandler->isPost())){
            $this->Security->validatePost = false;
            $this->Security->enabled = false;
            $this->Security->csrfCheck = false;
        }
    }
    
     public function admin_index()
    {
		$Session = $this->Session->read('Auth.Admin');
		$conditions = array(
			'TeacherTimeTable.STATUS'=>1
		);
		
		switch($Session["ROLE_ID"]) { 
			case TEACHER_ID:
				$conditions['TeacherTimeTable.TEACHER_ID'] = $Session["ID"];	
			break;
			case STUDENT_ID:
				$conditions['TeacherTimeTable.CLASS_ID'] = $Session["CLASS_ID"];	
			break;
		}
		
        $this->layout = 'admin_form_layout';
		
		if(isset($this->params->query["data"]["TeacherTimeTables"]["CLASS_ID"]) && 
		($this->params->query["data"]["TeacherTimeTables"]["CLASS_ID"] > 0) &&
		isset($this->params->query["data"]["TeacherTimeTables"]["TEACHER_ID"]) && 
		($this->params->query["data"]["TeacherTimeTables"]["TEACHER_ID"] > 0))
		{
			$class =   $this->params->query["data"]["TeacherTimeTables"]["CLASS_ID"] ;
			$techer =   $this->params->query["data"]["TeacherTimeTables"]["TEACHER_ID"] ;
			
			$conditions = array('TeacherTimeTable.CLASS_ID' => $class,
			'TeacherTimeTable.TEACHER_ID' => $techer);
		}elseif(isset($this->params->query["data"]["TeacherTimeTables"]["CLASS_ID"]) && 
		($this->params->query["data"]["TeacherTimeTables"]["CLASS_ID"] > 0) &&
		isset($this->params->query["data"]["TeacherTimeTables"]["SUBJECT_ID"]) && 
		($this->params->query["data"]["TeacherTimeTables"]["SUBJECT_ID"] > 0))
		{
			$class =   $this->params->query["data"]["TeacherTimeTables"]["CLASS_ID"] ;
			$sub =   $this->params->query["data"]["TeacherTimeTables"]["SUBJECT_ID"] ;
			
			$conditions = array('TeacherTimeTable.CLASS_ID' => $class,
			'TeacherTimeTable.SUBJECT_ID' => $sub);
		}elseif(isset($this->params->query["data"]["TeacherTimeTables"]["TEACHER_ID"]) && 
		($this->params->query["data"]["TeacherTimeTables"]["TEACHER_ID"] > 0) &&
		isset($this->params->query["data"]["TeacherTimeTables"]["SUBJECT_ID"]) && 
		($this->params->query["data"]["TeacherTimeTables"]["SUBJECT_ID"] > 0))
		{
			$teacher =   $this->params->query["data"]["TeacherTimeTables"]["TEACHER_ID"] ;
			$sub =   $this->params->query["data"]["TeacherTimeTables"]["SUBJECT_ID"] ;
			
			$conditions = array('TeacherTimeTable.TEACHER_ID' => $teacher,
			'TeacherTimeTable.SUBJECT_ID' => $sub);
		}elseif(isset($this->params->query["data"]["TeacherTimeTables"]["CLASS_ID"]) && 
		($this->params->query["data"]["TeacherTimeTables"]["CLASS_ID"]) > 0)
		{
			$class =   $this->params->query["data"]["TeacherTimeTables"]["CLASS_ID"] ;
		 	$conditions = array('TeacherTimeTable.CLASS_ID' => $class);
			
		}elseif(isset($this->params->query["data"]["TeacherTimeTables"]["SUBJECT_ID"]) && 
		$this->params->query["data"]["TeacherTimeTables"]["SUBJECT_ID"] > 0)
		{
			 $sub =  $this->params->query["data"]["TeacherTimeTables"]["SUBJECT_ID"] ;
			$conditions = array('TeacherTimeTable.SUBJECT_ID' => $sub);
			
		}elseif(isset($this->params->query["data"]["TeacherTimeTables"]["TEACHER_ID"]) &&
		$this->params->query["data"]["TeacherTimeTables"]["TEACHER_ID"] > 0)
		{
			$techer =   $this->params->query["data"]["TeacherTimeTables"]["TEACHER_ID"] ;
			$conditions = array('TeacherTimeTable.TEACHER_ID' => $techer);
			
		}

		$lists = $this->TeacherTimeTable->find("all",array(
            'conditions' => $conditions,
			
//            'Contain' => array('Role','AcademicClass'),
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'TeacherTimeTable.TT_ID DESC'
        ));
		
		$this->set('lists',$lists);
		
		 $classes = $this->TeacherTimeTable->AcademicClass->GetAcademicClasses();
         $this->set('classes', $classes);
		 
		 	$Teachers = $this->TeacherTimeTable->User->find('all',array(
			'conditions'=>array(
				'ROLE_ID'=>TEACHER_ID
			),
		));
		
		$teacher_lists = array();
		$teacher_lists[""]="Select Teacher";
		if(is_array($Teachers) && sizeof($Teachers)) { 
			foreach($Teachers as $t) {
				$teacher_lists[$t['User']["ID"]] = $t['User']['FIRST_NAME'].' '.$t['User']['LAST_NAME'];
			}
		}
		
		$this->set('teacher',$teacher_lists);
		 
		 $sub = $this->TeacherTimeTable->Subject->GetSubjects();
         $this->set('subject', $sub);
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

           $this->TeacherTimeTable->set($this->request->data);
		 
            if ($this->TeacherTimeTable->Validation()) {

              //  $this->TeacherTimeTable->create();
				
                if ($this->request->data) {
					
		        	$list = $this->request->data['TT_DATE'];
					
					$start = $this->request->data['TeacherTimeTable']['START_TIME'];
					$end = $this->request->data['TeacherTimeTable']['END_TIME'];
					
					$s =  date('H:i:s',strtotime($start));
					$e =  date('H:i:s',strtotime($end));
					
					//$this->TeacherTimeTable->saveField("START_TIME",$s);
					//$this->TeacherTimeTable->saveField("END_TIME",$e);
					
					$date1Timestamp = strtotime($start);
					$date2Timestamp = strtotime($end);
 
					//Calculate the difference.
					$difference = $date2Timestamp - $date1Timestamp;
 
					$DURATION =  $difference/60;
					
					//$this->TeacherTimeTable->saveField("DURATION",$DURATION);
					
					  foreach($list as $key => $day_id)
                        {

                        $day = $day_id;
                        $ttdata['TeacherTimeTable'] = array(
                        'CLASS_ID' => $this->request->data['TeacherTimeTable']['CLASS_ID'],
                       'TEACHER_ID' => $this->request->data['TeacherTimeTable']['TEACHER_ID'],
                         'SUBJECT_ID' => $this->request->data['TeacherTimeTable']['SUBJECT_ID'],
						 'TT_DATE' => $day , 
						 'START_TIME' => $s ,
						 'END_TIME' => $e,
						 'NARRATION' => $this->request->data['TeacherTimeTable']['NARRATION'],
						 'DURATION' => $DURATION,
						   );

                            $this->TeacherTimeTable->create();
                            $this->TeacherTimeTable->save($ttdata);
						}
					
                    $this->Session->setFlash('Teacher Time Table Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
            } else
            {
                $this->Session->setFlash('Teacher Time Table Not Added Please Try Again!', 'message_bad');
            }
        }
		
		$GetAcademic = $this->TeacherTimeTable->AcademicClass->GetAcademicClasses();
		$this->set('GetAcademicClasses',$GetAcademic);
		
		$this->subjects = ClassRegistry::init('Subject');
		$subjects = $this->subjects->GetSubjects();
		$this->set('subjects',$subjects);

	  
		$Teachers = $this->TeacherTimeTable->User->find('all',array(
			'conditions'=>array(
				'ROLE_ID'=>TEACHER_ID
			),
		));
		
		$teacher_lists = array();
		$teacher_lists[""]="Select Teacher";
		if(is_array($Teachers) && sizeof($Teachers)) { 
			foreach($Teachers as $t) {
				$teacher_lists[$t['User']["ID"]] = $t['User']['FIRST_NAME'].' '.$t['User']['LAST_NAME'].' ['. $t['User']['EMAIL_ID'] .']';
			}
		}
		
		$this->set('teacher_lists',$teacher_lists);
		
    }
	

    
    public function admin_edit($id = null)
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        $this->TeacherTimeTable->id = $id;
        if (empty($this->TeacherTimeTable->id)) {
            $this->Session->setFlash('Invalid Time Table !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->TeacherTimeTable->Validation()) {
             

                if ($this->TeacherTimeTable->save($this->request->data)) {
					
						$start = $this->request->data['TeacherTimeTable']['START_TIME'];
					$end = $this->request->data['TeacherTimeTable']['END_TIME'];
					
					$s =  date('H:i:s',strtotime($start));
					$e =  date('H:i:s',strtotime($end));
					
					$this->TeacherTimeTable->saveField("START_TIME",$s);
					$this->TeacherTimeTable->saveField("END_TIME",$e);
					
					$date1Timestamp = strtotime($start);
					$date2Timestamp = strtotime($end);
 
					//Calculate the difference.
					$difference = $date2Timestamp - $date1Timestamp;
 
					$DURATION =  $difference/60;
					
					$this->TeacherTimeTable->saveField("DURATION",$DURATION);
					
					$STATUS = 1;
					
					$this->TeacherTimeTable->saveField("STATUS",$STATUS);
					
                    $this->Session->setFlash('Teacher Time Table Updated Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Teacher Time Table Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Teacher Time Table Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $TeacherTimeTable = $this->TeacherTimeTable->find('first', array(
                'contain' => array(),
                'conditions' => array('TT_ID' => $id),
				//'fields'=>array('END_TIME' , 'START_TIME')
				
            ));
			 foreach($TeacherTimeTable as $key => $report){
				 
				 $report['END_TIME'] = date('h:i:s',strtotime($report['END_TIME']));
				 $report['START_TIME'] = date('h:i:s',strtotime($report['START_TIME']));

			 } 
				/*echo '<pre>';
				print_r($report);*/
				
				//$TeacherTimeTable[] = array($report);
				/*echo '<pre>';
				print_r($TeacherTimeTable);*/
				
            if(empty($TeacherTimeTable)) {
                $this->Session->setFlash('Invalid TeacherTimeTable !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $TeacherTimeTable;
        }
		
		$GetAcademic = $this->TeacherTimeTable->AcademicClass->GetAcademicClasses();
		$this->set('GetAcademicClasses',$GetAcademic);
		
		$this->subjects = ClassRegistry::init('Subject');
		$subjects = $this->subjects->GetSubjects();
		$this->set('subjects',$subjects);

		$Teachers = $this->TeacherTimeTable->User->find('all',array(
			'conditions'=>array(
				'ROLE_ID'=>TEACHER_ID
			),
		));
		
		$teacher_lists = array();
		$teacher_lists[""]="Select Teacher";
		if(is_array($Teachers) && sizeof($Teachers)) { 
			foreach($Teachers as $t) {
				$teacher_lists[$t['User']["ID"]] = $t['User']['FIRST_NAME'].' '.$t['User']['LAST_NAME'].' ['. $t['User']['EMAIL_ID'] .']';
			}
		}
		$this->set('teacher_lists',$teacher_lists);
    }
    
	public function admin_view($id = null)
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        $this->TeacherTimeTable->id = $id;
        if (empty($this->TeacherTimeTable->id)) {
            $this->Session->setFlash('Invalid Time Table !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

       
            $TeacherTimeTable = $this->TeacherTimeTable->find('first', array(
                'conditions' => array('TT_ID' => $id)
            ));


            if(empty($TeacherTimeTable)) {
                $this->Session->setFlash('Invalid TeacherTimeTable !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }

            
            $this->request->data = $TeacherTimeTable;
       
		
		$GetAcademic = $this->TeacherTimeTable->AcademicClass->GetAcademicClasses();
		$this->set('GetAcademicClasses',$GetAcademic);
		
		$this->subjects = ClassRegistry::init('Subject');
		$subjects = $this->subjects->GetSubjects();
		$this->set('subjects',$subjects);

		$Teachers = $this->TeacherTimeTable->User->find('all',array(
			'conditions'=>array(
				'ROLE_ID'=>TEACHER_ID
			),
		));
		
		$teacher_lists = array();
		$teacher_lists[""]="Select Teacher";
		if(is_array($Teachers) && sizeof($Teachers)) { 
			foreach($Teachers as $t) {
				$teacher_lists[$t['User']["ID"]] = $t['User']['FIRST_NAME'].' '.$t['User']['LAST_NAME'].' ['. $t['User']['EMAIL_ID'] .']';
			}
		}
		$this->set('teacher_lists',$teacher_lists);
    }
    
    public function admin_delete($Id = null)
    {
        $TeacherTimeTable = $this->TeacherTimeTable->find('first', array(
            'contain' => array(),
            'conditions' => array('TT_ID' => $Id)
        ));

        $this->layout = 'admin_form_layout';
        if (!empty($Id)) {
				$this->TeacherTimeTable->id = $Id;
            try {
                if ($this->TeacherTimeTable->saveField('STATUS',0)) {
                    $this->Session->setFlash('Teacher Time Table is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid Event.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
    }
    
  public function App_CheckHoliday()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;

        $conditions = array();

        if(!empty($this->request->data))
        {
            $currentDate = $this->request->data['CURRENT_DATE'];

            $conditions = array('START_DATE' => $currentDate,'STATUS' => '1');

            $holidayData = $this->Holiday->find('all',array(
                'conditions' => $conditions,
                'fields' => array()
            ));

            if(isset($holidayData) && !empty($holidayData))
            {
                $message = 'Today is Holiday';
                $status = true;

                $result_array = array(
                    'status' => $status,
                    'message' => $message,
                    'data' => $holidayData
                );

            }
            else
            {
                $message = 'Today is Working Day';
                $status = false;


                $result_array = array(
                    'status' => $status,
                    'message' => $message,
                );
            }
        }
        else
        {
            $message = 'Opps something wrong!';
            $status = false;

            $result_array = array(
                'status' => $status,
                'message' => $message
            );

        }

        echo json_encode($result_array); die;
    }

	public function App_Get_Student_Time_Table()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;

        $conditions = array();
		
		$day_f_week = array(
		'Monday' => '1',
		'Tuesday' => '2',
		'Wednesday' => '3',
		'Thursday' => '4',
		'Friday' => '5',
		'Saturday' => '6'
		);
		
        if(!empty($_POST))
        {
            $currentDate = $this->request->data['CURRENT_DATE'];        
			$week_day = strftime("%A",strtotime($currentDate));
			$day = $day_f_week[$week_day];
			$conditions[] = array('TeacherTimeTable.STATUS' => '1');
			$conditions[] = array('TeacherTimeTable.TT_DATE' => $day);
			$conditions[] = array('TeacherTimeTable.CLASS_ID' => $this->request->data['CLASS_ID']);
			
            $time_table_data = $this->TeacherTimeTable->find('all', array(
				'contain' => array('User', 'Subject', 'AcademicClass'),
                'conditions' => $conditions                
            ));
			$time_table = array();
			foreach($time_table_data as $tmt)
			{
				$time_table[] = array(
				'TT_ID' => $tmt['TeacherTimeTable']['TT_ID'],
				'START_TIME' => $tmt['TeacherTimeTable']['START_TIME'],
				'END_TIME' => $tmt['TeacherTimeTable']['END_TIME'],
				'NARRATION' => $tmt['TeacherTimeTable']['NARRATION'],
				'FIRST_NAME' => $tmt['User']['FIRST_NAME'],
				'MIDDLE_NAME' => $tmt['User']['MIDDLE_NAME'],
				'LAST_NAME' => $tmt['User']['LAST_NAME'],
				'CLASS_ID' => $tmt['AcademicClass']['CLASS_ID'],
				'CLASS_NAME' => $tmt['AcademicClass']['CLASS_NAME'],
				'SUBJECT_ID' => $tmt['Subject']['SUBJECT_ID'],
				'TITLE' => $tmt['Subject']['TITLE'],
				'CLASS_WORK' => $this->Get_ClassWork($currentDate, $tmt['AcademicClass']['CLASS_ID'], $tmt['Subject']['SUBJECT_ID'], $tmt['TeacherTimeTable']['TEACHER_ID']),
				);
			}
            if(isset($time_table) && !empty($time_table))
            {
                $message = 'Time Table List';
                $status = true;

                $result_array = array(
                    'status' => $status,
                    'message' => $message,
                    'data' => $time_table
                );
            }
            else
            {
                $message = 'No Data Found';
                $status = false;


                $result_array = array(
                    'status' => $status,
                    'message' => $message,
                );
            }
        }
        else
        {
            $message = 'Opps something wrong!';
            $status = false;

            $result_array = array(
                'status' => $status,
                'message' => $message
            );
        }

        echo json_encode($result_array); die;
    }
    
	public function App_Get_Teacher_Time_Table()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;

        $conditions = array();
		
		$day_f_week = array(
		'Monday' => '1',
		'Tuesday' => '2',
		'Wednesday' => '3',
		'Thursday' => '4',
		'Friday' => '5',
		'Saturday' => '6'
		);
		
        if(!empty($this->request->data))
        {
            $currentDate = $this->request->data['CURRENT_DATE'];        
			$week_day = strftime("%A",strtotime($currentDate));
			$day = $day_f_week[$week_day];
			$conditions[] = array('TeacherTimeTable.STATUS' => '1');
			$conditions[] = array('TeacherTimeTable.TT_DATE' => $day);
			$conditions[] = array('TeacherTimeTable.TEACHER_ID' => $this->request->data['TEACHER_ID']);
			
            
            
            $time_table_data = $this->TeacherTimeTable->find('all', array(
				'contain' => array('User', 'Subject', 'AcademicClass'),
                'conditions' => $conditions                
            ));
			$time_table = array();
			foreach($time_table_data as $tmt)
			{
				$time_table[] = array(
				'TT_ID' => $tmt['TeacherTimeTable']['TT_ID'],
				'START_TIME' => $tmt['TeacherTimeTable']['START_TIME'],
				'END_TIME' => $tmt['TeacherTimeTable']['END_TIME'],
				'NARRATION' => $tmt['TeacherTimeTable']['NARRATION'],
				'FIRST_NAME' => $tmt['User']['FIRST_NAME'],
				'MIDDLE_NAME' => $tmt['User']['MIDDLE_NAME'],
				'LAST_NAME' => $tmt['User']['LAST_NAME'],
				'CLASS_ID' => $tmt['AcademicClass']['CLASS_ID'],
				'CLASS_NAME' => $tmt['AcademicClass']['CLASS_NAME'],
				'SUBJECT_ID' => $tmt['Subject']['SUBJECT_ID'],
				'TITLE' => $tmt['Subject']['TITLE'],
				'CLASS_WORK' => $this->Get_ClassWork($currentDate, $tmt['AcademicClass']['CLASS_ID'], $tmt['Subject']['SUBJECT_ID'], $tmt['TeacherTimeTable']['TEACHER_ID']),
				);
			}
            if(isset($time_table) && !empty($time_table))
            {
                $message = 'Time Table List';
                $status = true;

                $result_array = array(
                    'status' => $status,
                    'message' => $message,
                    'data' => $time_table
                );
            }
            else
            {
                $message = 'No Data Found';
                $status = false;


                $result_array = array(
                    'status' => $status,
                    'message' => $message,
                );
            }
        }
        else
        {
            $message = 'Opps something wrong!';
            $status = false;

            $result_array = array(
                'status' => $status,
                'message' => $message
            );
        }

        echo json_encode($result_array); die;
    }
	
	public function Get_ClassWork($DATE, $CLASS_ID, $SUBJECT_ID, $TEACHER_ID)
	{
			$conditions = array();
			$result = '';
			$conditions[] = array('Classwork.CW_DATE' => date('Y-m-d', strtotime($DATE)));
			$conditions[] = array('Classwork.CLASS_ID' => $CLASS_ID);
			$conditions[] = array('Classwork.SUBJECT_ID' => $SUBJECT_ID);
			$conditions[] = array('Classwork.TEACHER_ID' => $TEACHER_ID);
			
			//pr($conditions);die;			
			
			$this->Classwork = ClassRegistry::init('Classwork');
			$class_work = $this->Classwork->find('first', array(
			'contain' => array(),
			'fields' => array('NARRATION'),
			'conditions' => $conditions		
			));
			if(!empty($class_work))
			{
				$result = $class_work['Classwork']['NARRATION'];
			}
			return $result;
	}
}