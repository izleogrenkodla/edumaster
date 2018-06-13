<?php
// app/Controller/UsersController.php
class ExamTypesController extends AppController
{
    var $name = 'ExamTypes'; 

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
		$conditions['ExamType.STATUS']=1;
        $this->layout = 'admin_form_layout';
       	$lists = $this->ExamType->find("all",array(
            'conditions' => $conditions,
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'ExamType.EX_TYPE_ID DESC'
        ));
		
        $this->set('listing', $lists);
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
		
		if($Session_data["ROLE_ID"]!=ADMIN_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}

        if ($this->request->is('post')) {

           $this->ExamType->set($this->request->data);

            if ($this->ExamType->Validation()) {
                $this->ExamType->create();
                if ($this->ExamType->save($this->request->data)) {
                    $this->Session->setFlash('ExamType Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
            } else
            {
                $this->Session->setFlash('ExamType Not Added Please Try Again!', 'message_bad');
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
		
		$this->ExamType->id = $id;
        if (empty($this->ExamType->id)) {
            $this->Session->setFlash('Invalid ExamType !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {

           $this->ExamType->set($this->request->data);

            if ($this->ExamType->Validation()) {
                if ($this->ExamType->save($this->request->data)) {
                    $this->Session->setFlash('ExamType Edit Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
            } else
            {
                $this->Session->setFlash('ExamType Not Added Please Try Again!', 'message_bad');
            }
        }else{
			$list = $this->ExamType->find("first",array(
					"conditions"=>array(
						'EX_TYPE_ID'=>$id,
						'STATUS'=>1
					),
				));
			if(sizeof($list)>0) { 
				$this->request->data = $list;
			}else{
				$this->Session->setFlash('Invalid ExamType!', 'message_bad');
				$this->redirect(array("action"=>"index"));
			}	
		}
    }
    
    public function admin_delete($Id = null)
    {
		
		$Session_data = $this->Session->read('Auth.Admin');
 
        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		if($Session_data["ROLE_ID"]!=ADMIN_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}
		
        $ExamType = $this->ExamType->find('first', array(
            'contain' => array(),
            'conditions' => array('EX_TYPE_ID' => $Id)
        ));

        if(sizeof($ExamType)>0) { 
			$this->ExamType->id = $Id;
			$this->ExamType->saveField("STATUS",0);
			$this->Session->setFlash('Event type Successfully Removed', 'message_bad');
			$this->redirect(array('action' => 'index'));
		}else{
			$this->Session->setFlash('Invalid Type.', 'message_bad');
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