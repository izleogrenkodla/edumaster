<?php
class VehicleRouteController extends AppController
{ 
    var $name = 'VehicleRoute';

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
		$this->loadModel('VehicleShift');
		$this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');
			
		
		$VehicleRoute = $this->VehicleRoute->find('all');
		
		// echo "<pre>";
		// print_r($VehicleRoute);
		// exit();
		$this->set('VehicleRoute',$VehicleRoute);
				
				
			

			
			
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
		
		$this->loadModel('Vehicle');
		$vehicle = $this->Vehicle->GetVehicle();
		$this->set('vehicle', $vehicle);
		
		$this->loadModel('Route');
		$route = $this->Route->GetRoute();
		$this->set('route', $route);
		
		$this->loadModel('Driver');
		$driver = $this->Driver->GetDrivers();
		$this->set('driver', $driver);

		if ($this->request->is('post')) {
            $this->VehicleRoute->set($this->request->data);
            if ($this->VehicleRoute->Validation()) {
                $this->VehicleRoute->create();
				
            
					
					$this->request->data['Vehicle']['USER_ID'] = $Session_data['ID'];
					$this->VehicleRoute->saveField("created_by",$Session_data['ID']);
					
					
					
					$ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
					$this->VehicleRoute->saveField("created_ip",$ip);
					
					
					
					 if ($this->VehicleRoute->save($this->request->data)) {
					
                    $this->Session->setFlash('Vehicle Route Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
                } else {
                $this->Session->setFlash('Vehicle Route Not Added Please Try Again!', 'message_bad');
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
		
		$this->loadModel('Vehicle');
		$vehicle = $this->Vehicle->GetVehicle();
		$this->set('vehicle', $vehicle);
		
		$this->loadModel('Route');
		$route = $this->Route->GetRoute();
		$this->set('route', $route);
		
		$this->loadModel('Driver');
		$driver = $this->Driver->GetDrivers();
		$this->set('driver', $driver);

        
        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->VehicleRoute->Validation()) {
                if ($this->VehicleRoute->save($this->request->data)) {
					
					
                    $this->Session->setFlash('VehicleRoute Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('VehicleRoute Type Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('VehicleRoute Type Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $VehicleRoute = $this->VehicleRoute->find('first', array(
                'contain' => array(),
                'conditions' => array('ROUTE_RELATION_ID' => $id)
            ));
			
			//print_r($VehicleRoute);die;
            if(empty($VehicleRoute)) {
                $this->Session->setFlash('Invalid VehicleRoute !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $VehicleRoute;
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
                if ($this->VehicleRoute->delete($Id)) {
                    $this->Session->setFlash('VehicleRoute is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid VehicleRoute .', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }
	   
	

}	