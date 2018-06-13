<?php
class VehicleController extends AppController
{ 
    var $name = 'Vehicle';

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
		
		$conditions = array();
		$this->loadModel('VehicleShift');
		$this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');
		
		$this->loadModel('VehicleShift');

		
		
		$this->loadModel('VehicleType');
		$type = $this->VehicleType->GetVehicleType();
		$this->set('type', $type);
		$shifts = array();
		$this->loadModel('VehicleShift');	
		if(isset($this->request->data["Vehicle"]["VEHICLE_TYPE"]) && ($this->request->data["Vehicle"]["VEHICLE_TYPE"])>0)
		{
			
			$Vehicle =$this->request->data["Vehicle"]["VEHICLE_TYPE"];
			$conditions = array('Vehicle.VEHICLE_TYPE_ID ' => $Vehicle);
				
				
			
		}
		$Vehicle = $this->Vehicle->find('all',array(
            'conditions' => $conditions,
            'limit' => PAGINATION_LIMIT_ADMIN));
		
		
		$this->set('Vehicle',$Vehicle);
				
				
			
			
			
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
		
		$this->loadModel('VehicleShift');
		$result = $this->VehicleShift->GetVehicleShift();
		$this->set('shift', $result);
		
		
		$this->loadModel('VehicleType');
		$type = $this->VehicleType->GetVehicleType();
		$this->set('type', $type);
		        
		if ($this->request->is('post')) {
            $this->Vehicle->set($this->request->data);
            if ($this->Vehicle->Validation()) {
                $this->Vehicle->create();
				
               
					
					
					
						
					$this->request->data['Vehicle']['USER_ID'] = $Session_data['ID'];
					$this->Vehicle->saveField("created_by",$Session_data['ID']);
					
					$ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
					$this->Vehicle->saveField("created_ip",$ip);
					 if ($this->Vehicle->save($this->request->data)) {
					
                    $this->Session->setFlash('Vehicle Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
                } else {
                $this->Session->setFlash('Vehicle Not Added Please Try Again!', 'message_bad');
                }
        }
		
		
		
		
        
       }
	   
	   	public function admin_edit($id=null){		
		
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
		
		$this->loadModel('VehicleShift');
		$result = $this->VehicleShift->GetVehicleShift();
		$this->set('shift', $result);
		
		$this->loadModel('VehicleType');
		$type = $this->VehicleType->GetVehicleType();
		$this->set('type', $type);
        
        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->Vehicle->Validation()) {
                if ($this->Vehicle->save($this->request->data)) {
					
					
                    $this->Session->setFlash('Vehicle Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Vehicle Type Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Vehicle Type Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $Vehicle = $this->Vehicle->find('first', array(
                'contain' => array(),
                'conditions' => array('ID' => $id)
            ));
			
			//print_r($Vehicle);die;
            if(empty($Vehicle)) {
                $this->Session->setFlash('Invalid Vehicle !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $Vehicle;
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
                if ($this->Vehicle->delete($Id)) {
                    $this->Session->setFlash('Vehicle is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid Vehicle .', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }
	   
	   
  
	   
	   
      
	
	

}	