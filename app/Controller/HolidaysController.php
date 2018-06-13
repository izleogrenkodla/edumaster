<?php
// app/Controller/UsersController.php
class HolidaysController extends AppController 
{
    var $name = 'Holidays';

    public function beforeFilter()
    {
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
		$conditions = array();

		
        $this->layout = 'admin_form_layout';
        
        
		$lists = $this->Holiday->find("all",array(
            'conditions' => $conditions,
//            'Contain' => array('Role','AcademicClass'),
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'Holiday.HOLIDAY_ID DESC'
        ));
		$return = array();
		if(is_array($lists) && sizeof($lists)) { 
    		foreach ($lists as $list) { 
		    	$return[] = array(
					"id"=>$list["Holiday"]["HOLIDAY_ID"],
					"title"=>$list["Holiday"]["TITLE"],
					"description"=>$list["Holiday"]["DESCRIPTION"],
					"start"=>$list["Holiday"]["START_DATE"],
					"end"=>$list["Holiday"]["END_DATE"],
				);
			}
		}
	

        $this->set('listing', $return);
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
		
		//if($Session_data["ROLE_ID"]!=SUPERVISOR_ID && $Session_data["ROLE_ID"]!=HR_ID) {
		if($Session_data["ROLE_ID"]!=ADMIN_ID) {	
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}

        if ($this->request->is('post')) {

           $this->Holiday->set($this->request->data);

            if ($this->Holiday->Validation()) {

                $this->Holiday->create();
				
				$this->request->data["Holiday"]["START_DATE"] = isset($this->request->data["Holiday"]["START_DATE"])?$this->General->datefordb($this->request->data["Holiday"]["START_DATE"]):'';
				
				$this->request->data["Holiday"]["END_DATE"] = isset($this->request->data["Holiday"]["END_DATE"])?$this->General->datefordb($this->request->data["Holiday"]["END_DATE"]):'';
				
				$d1 = strtotime($this->request->data["Holiday"]["START_DATE"]);
                $d2 = strtotime($this->request->data["Holiday"]["END_DATE"]);
				
				$curdate=strtotime(date('d-m-Y'));

				if(($d2 < $d1) || ($curdate > $d1)) {
					$this->Session->setFlash('Please provide date in valid range.', 'message_good');
					$this->request->data["Holiday"]["START_DATE"] = $this->General->dbfordate($this->request->data["Holiday"]["START_DATE"]);
					$this->request->data["Holiday"]["END_DATE"] = $this->General->dbfordate($this->request->data["Holiday"]["END_DATE"]);
					return false;
				}	
				
                if ($this->Holiday->save($this->request->data)) {
                    $lastid = $this->Holiday->getLastInsertId();
                    $this->Session->setFlash('Holiday Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
            } else
            {
                $this->Session->setFlash('Holiday Not Added Please Try Again!', 'message_bad');
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
		
		//if($Session_data["ROLE_ID"]!=SUPERVISOR_ID && $Session_data["ROLE_ID"]!=HR_ID) {
		if($Session_data["ROLE_ID"]!=ADMIN_ID) {	
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}

        $this->Holiday->id = $id;
        if (empty($this->Holiday->id)) {
            $this->Session->setFlash('Invalid Holiday !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->Holiday->Validation()) {
                $this->request->data['Holiday']['START_DATE'] = $this->General->datefordb($this->request->data['Holiday']['START_DATE']);
                $this->request->data['Holiday']['END_DATE'] = $this->General->datefordb($this->request->data['Holiday']['END_DATE']);

                if ($this->Holiday->save($this->request->data)) {
                    $this->Session->setFlash('Holiday Updated Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Holiday Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Holiday Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $Holiday = $this->Holiday->find('first', array(
                'contain' => array(),
                'conditions' => array('HOLIDAY_ID' => $id)
            ));


            if(empty($Holiday)) {
                $this->Session->setFlash('Invalid Holiday !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }

            $Holiday['Holiday']['START_DATE'] = $this->General->dbfordate($Holiday['Holiday']['START_DATE']);
            $Holiday['Holiday']['END_DATE'] = $this->General->dbfordate($Holiday['Holiday']['END_DATE']);

            $this->request->data = $Holiday;
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
		
		//if($Session_data["ROLE_ID"]!=SUPERVISOR_ID && $Session_data["ROLE_ID"]!=HR_ID) {
		if($Session_data["ROLE_ID"]!=ADMIN_ID) {	
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}
		
        $Holiday = $this->Holiday->find('first', array(
            'contain' => array(),
            'conditions' => array('HOLIDAY_ID' => $Id)
        ));
        
        if (!empty($Id)) {
            try {
                if ($this->Holiday->delete($Id)) {
                    $this->Session->setFlash('Holiday is successfully deleted', 'message_good');
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
    
 
}