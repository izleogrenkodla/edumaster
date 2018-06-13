<?php
// app/Controller/UsersController.php
class EventsController extends AppController
{
    var $name = 'Events';

    public function beforeFilter()
    {
        parent::beforeFilter();

        $this->Auth->allow('App_EventList','App_EventDetails');

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
		$conditions['Event.STATUS']=1;
		 switch($Session["ROLE_ID"]) {
		 	case STUDENT_ID:
				$conditions['Event.CLASS_ID']=$Session["CLASS_ID"];
			break;
			case TEACHER_ID:
				$conditions['Event.CLASS_ID']=$Session["CLASS_ID"];
			break;
		 }
		 
		 if(isset($this->params->query["data"]["Event"]) && is_array($this->params->query["data"]["Event"])) {
			$post = $this->params->query["data"]["Event"];
			
			if(isset($post["CLASS_ID"]) && $post["CLASS_ID"]!='') {
				$conditions['Event.CLASS_ID'] = $post["CLASS_ID"]; 
			}
			
			if((isset($post["from_date"]) && $post["from_date"]!='')) {				
				$dt = $this->General->datefordb($post["from_date"]);
				$month = date("m",strtotime($dt));
				$year = date("Y",strtotime($dt));
//				$conditions['MONTH(EVENT_START) OR MONTH(EVENT_END)'] = array($month); 
				
//				$conditions['YEAR(?) BETWEEN YEAR(EVENT_START) AND YEAR(EVENT_END)'] = array($year); 
			}
		
		}	
		 

        $this->layout = 'admin_form_layout';
       	$lists = $this->Event->find("all",array(
		'fields'=>array('Event.EVENT_ID','Event.EVENT_TITLE','Event.EVENT_DESC','Event.EVENT_START','Event.EVENT_END',
		'(CASE WHEN CURDATE() <= Event.EVENT_END THEN \'yes\' ELSE \'no\' END) AS t'),
		
            'conditions' => $conditions,
            'contain' => array('AcademicClass'),
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'Event.EVENT_ID DESC'
        ));
		$return = array();
	//	pr($lists);die;
		if(is_array($lists) && sizeof($lists)) { 
    		foreach ($lists as $k=>$list) { 
			$color = 'red';
			$datetime1 = new DateTime(date("Y-m-d"));

			
		$color = (isset($lists[$k][0]["t"]) && $lists[$k][0]["t"]=='yes')?'green':'red';
		    	$return[] = array(
					"id"=>$list["Event"]["EVENT_ID"],
					"title"=>$list["Event"]["EVENT_TITLE"],
					"description"=>$list["Event"]["EVENT_DESC"],
					"start"=>$list["Event"]["EVENT_START"],
					"end"=>$list["Event"]["EVENT_END"],
					"view_start"=>$this->General->dbfordate($list["Event"]["EVENT_START"]),
					"view_end"=>$this->General->dbfordate($list["Event"]["EVENT_END"]),
					"color"=>$color,
				);
			}
		}
		
		if(sizeof($lists)>0) {
			$this->Session->write('Filter_Event',$lists);
		}
		
		$class_list = $this->Event->AcademicClass->GetAcademicClasses();
		
		$this->set('class_list',$class_list);
		
        $this->set('listing', $return);
    }
    
    public function admin_export_events() 
    {
        App::import('Vendor', 'Export', array('file' => 'Export' . DS . '/excel_xml.php'));
        $xls = new Excel_XML('UTF-8', false, 'Applicant Report');

        $report_column = array('Event Title','Class',
            'Start Date', 'End Date','Description');
        $session_var = 'Filter_Event';
        $lists = $this->Session->read($session_var);
        $i = 0;
        foreach($lists as $list) {
            $events[0] = $report_column;
            $events[$i+1]  = array(
                $list["Event"]["EVENT_TITLE"],
                $list["AcademicClass"]["CLASS_NAME"],
                $list["Event"]["EVENT_START"],
                $list["Event"]["EVENT_END"],
                $list["Event"]["EVENT_DESC"],
            );
            $i++;
        }

        $xls->addArray($events);
        $xls->generateXML('Event_'.date('d-m-Y'));
        $this->Session->delete($session_var);
        die;

    }
    
    
      public function admin_view($ID = null)
    {
        $this->layout = 'admin_form_layout';
        $EventData = $this->Event->find('first', array(
            'contain' => array('AcademicClass'),
            'conditions' => array('EVENT_ID' => $ID)
        ));
	
		$this->set('EventData', $EventData);
    }
    
    public function admin_add()
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		if($Session_data["ROLE_ID"]!=SUPERVISOR_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}

        if ($this->request->is('post')) {

           $this->Event->set($this->request->data);

            if ($this->Event->Validation()) {
                $this->Event->create();
                $img = '';
                if($this->request->data["Event"]["UPLOAD_IMAGE"]["size"]>0) {
                    $img = $this->request->data["Event"]["UPLOAD_IMAGE"];
                    unset($this->request->data["Event"]["UPLOAD_IMAGE"]);
                }


                $this->request->data['Event']['EVENT_START'] = date('Y-m-d', strtotime(str_replace('/','-',$this->request->data['Event']['EVENT_START'])));
                $this->request->data['Event']['EVENT_END'] = date('Y-m-d', strtotime(str_replace('/','-',$this->request->data['Event']['EVENT_END'])));

                if ($this->Event->save($this->request->data)) {

                    $lastid = $this->Event->getLastInsertId();

                    if(is_array($img) && $img["size"]>0) {

                        $extension = $img['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname = strtotime(date('Y-m-d H:i:s')).$lastid.'.'.$ext[1];
                        move_uploaded_file($img["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        //$imdata = base64_encode($im);

                        $this->Event->id = $lastid;

                        $this->Event->saveField("EVENT_IMAGE",$fname);
                        //$this->Event->saveField("BASE_CODE",$imdata);
                    }

                    $this->Session->setFlash('Event Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
            } else
            {
                $this->Session->setFlash('Event Not Added Please Try Again!', 'message_bad');
            }
        }

        $classes = $this->Event->AcademicClass->GetAcademicClasses();
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
		
		if($Session_data["ROLE_ID"]!=SUPERVISOR_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}

        $this->Event->id = $id;
        if (empty($this->Event->id)) {
            $this->Session->setFlash('Invalid Event !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->Event->Validation()) {
                $img = '';
                if($this->request->data["Event"]["UPLOAD_IMAGE"]["size"]>0) {
                    $img = $this->request->data["Event"]["UPLOAD_IMAGE"];
                    unset($this->request->data["Event"]["UPLOAD_IMAGE"]);
                }

                $this->request->data['Event']['EVENT_START'] = date('Y-m-d', strtotime(str_replace('/','-',$this->request->data['Event']['EVENT_START'])));
                $this->request->data['Event']['EVENT_END'] = date('Y-m-d', strtotime(str_replace('/','-',$this->request->data['Event']['EVENT_END'])));

                if ($this->Event->save($this->request->data)) {
                    if(is_array($img) && $img["size"]>0) {

                        $extension = $img['name'];
                        $ext = explode('.',$extension);

                        $path = WWW_ROOT . "/files/upload_document/";
                        $fname = strtotime(date('Y-m-d H:i:s')).$id.'.'.$ext[1];
                        move_uploaded_file($img["tmp_name"],$path.$fname);

                        $im = file_get_contents($path.$fname);
                        //$imdata = base64_encode($im);

                        $this->Event->id = $id;

                        $EventData = $this->Event->find('first', array(
                            'contain' => array(),
                            'conditions' => array('EVENT_ID' => $id)
                        ));

                        $fileName = $EventData['Event']['EVENT_IMAGE'];

                        if($fileName != '')
                        {
                            $this->General->delete_file("/files/upload_document/".$fileName);
                        }

                        $this->Event->saveField("EVENT_IMAGE",$fname);
                        //$this->Event->saveField("BASE_CODE",$imdata);
                    }

                    $this->Session->setFlash('Event Updated Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Event Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Event Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $Event = $this->Event->find('first', array(
                'contain' => array(),
                'conditions' => array('EVENT_ID' => $id)
            ));


            if(empty($Event)) {
                $this->Session->setFlash('Invalid Event !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }

            $Event['Event']['EVENT_START'] = date('d/m/Y', strtotime(str_replace('-','/',$Event['Event']['EVENT_START'])));
            $Event['Event']['EVENT_END'] = date('d/m/Y', strtotime(str_replace('-','/',$Event['Event']['EVENT_END'])));

            $this->request->data = $Event;
        }

        $classes = $this->Event->AcademicClass->GetAcademicClasses();
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
		
		if($Session_data["ROLE_ID"]!=SUPERVISOR_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}
		
        $EventData = $this->Event->find('first', array(
            'contain' => array(),
            'conditions' => array('EVENT_ID' => $Id)
        ));

        $fileName = $EventData['Event']['EVENT_IMAGE'];
        
        if (!empty($Id)) {
            try {
                if ($this->Event->delete($Id)) {

                    $this->General->delete_file("/files/upload_document/".$fileName);

                    $this->Session->setFlash('Event is successfully deleted', 'message_good');
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
    
    public function App_EventList()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;

        $classId = $this->request->data['CLASS_ID'];

        $conditions = array();

        $this->Event->virtualFields = array(
            'EVENT_START' => "DATE_FORMAT(EVENT_START,'%d/%m/%Y')",
            'EVENT_END' => "DATE_FORMAT(EVENT_END,'%d/%m/%Y')"
        );

        if(isset($this->request->data['PAST'])) {
            $conditions[] = array('DATE(EVENT_START) <' => date('Y-m-d'),'CLASS_ID' => $classId, 'STATUS' => 1);
        }
        if(isset($this->request->data['UPCOMMING'])) {
            $conditions[] = array('DATE(EVENT_START) >' => date('Y-m-d'),'CLASS_ID' => $classId, 'STATUS' => 1);
        }

        $EventData = $this->Event->find('all', array(
            'conditions' => $conditions,
            'fields' => array('EVENT_ID','EVENT_TITLE','EVENT_START','EVENT_END','BASE_CODE'),
            'contain' => array()
        ));

        $Event = Set::extract('/Event/.', $EventData);

        if(!empty($Event))
        {
            $message = 'Available Events';
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
            'data' => $Event
        );

        echo json_encode($result_array); die;

    }
    
    public function App_EventDetails()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;

        $eventId = $this->request->data['EVENT_ID'];

        $this->Event->virtualFields = array(
            'created' => "DATE_FORMAT(created,'%d/%m/%Y %h:%i %p')",
            'EVENT_START' => "DATE_FORMAT(EVENT_START,'%d/%m/%Y')",
            'EVENT_END' => "DATE_FORMAT(EVENT_END,'%d/%m/%Y')"
        );

        if(!empty($eventId))
        {
            $TempData = $this->Event->find('first', array(
                'contain' => array(),
                'conditions' => array('EVENT_ID' => $eventId)
            ));

            $Data = Set::extract('/Event/.', $TempData);

            if(!empty($Data))
            {
                $message = 'Event Details!';
                $status = true;
            }
            else
            {
                $message = 'No Records Found!';
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
            'data' => $Data
        );

        echo json_encode($result_array); die;

    }
}