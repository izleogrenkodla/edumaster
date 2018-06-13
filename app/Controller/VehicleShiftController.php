<?php
class VehicleShiftController extends AppController
{ 
    var $name = 'VehicleShift';

    public function beforeFilter()
    {
        parent::beforeFilter();

        $this->Auth->allow('App_AllocateTransport');

        if(isset($this->Security) &&  ($this->RequestHandler->isAjax() || $this->RequestHandler->isPost())){
            $this->Security->validatePost = false;
            $this->Security->enabled = false;
            $this->Security->csrfCheck = false;
        }
    }
	
	
		public function admin_index(){
			
			
			
        $this->layout = 'admin_form_layout';
		 $result = $this->VehicleShift->find("all", array(
            'contain' => array(),
			 'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'VehicleShift.VEHICLE_SHIFT_TYPE asc'
        ));
		
        $this->set('data', $result);
		}
	
		public function admin_add(){
		
		$this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		if($Session_data["ROLE_ID"]!=TRANSPORTATION_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}

        if ($this->request->is('post')) {
            $this->VehicleShift->set($this->request->data);

            if ($this->VehicleShift->Validation()) {
                $this->VehicleShift->create();

                if ($this->VehicleShift->save($this->request->data)) {
                   
                    $this->Session->setFlash('Vehicle Shift Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
            } else {
                $this->Session->setFlash('Vehicle Shift Not Added Please Try Again!', 'message_bad');
            }
        }
        
       }
	   
	   
	public function admin_edit($id = null){		
		
		 $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		if($Session_data["ROLE_ID"]!=TRANSPORTATION_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}

        $this->VehicleShift->id = $id;
        if (empty($this->VehicleShift->id)) {
            $this->Session->setFlash('Invalid Vehicle !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
	

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->VehicleShift->Validation()) {
                if ($this->VehicleShift->save($this->request->data)) {
                    $this->Session->setFlash('Vehicle Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Vehicle Shift Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Vehicle Shift Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $VehicleShift = $this->VehicleShift->find('first', array(
                'contain' => array(),
                'conditions' => array('SHIFT_ID' => $id)
            ));
			
			
			//print_r($VehicleShift);die;
            if(empty($VehicleShift)) {
                $this->Session->setFlash('Invalid Vehicle Shift !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $VehicleShift;
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
		
		if($Session_data["ROLE_ID"]!=TRANSPORTATION_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}
		
        if (!empty($Id)) {
            try {
                if ($this->VehicleShift->delete($Id)) {
                    $this->Session->setFlash('Vehicle Shift is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid Vehicle Shift.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }
	   
	   
	   
      
	
	

}	