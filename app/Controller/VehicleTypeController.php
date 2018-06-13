<?php
class VehicleTypeController extends AppController
{ 
    var $name = 'VehicleType';

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
		 $result = $this->VehicleType->find("all", array(
            'contain' => array(),
			 'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'VehicleType.VEHICLE asc'
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
            $this->VehicleType->set($this->request->data);
		
            if ($this->VehicleType->Validation()) {
                $this->VehicleType->create();
				$this->request->data['Route']['USER_ID'] = $Session_data['ID'];
					$this->VehicleType->saveField("created_by",$Session_data['ID']);
					
					$ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
					$this->VehicleType->saveField("created_ip",$ip);
                if ($this->VehicleType->save($this->request->data)) {
                   
                    $this->Session->setFlash('Vehicle Type Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
            } else {
                $this->Session->setFlash('Vehicle Type Not Added Please Try Again!', 'message_bad');
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

        $this->VehicleType->id = $id;
        if (empty($this->VehicleType->id)) {
            $this->Session->setFlash('Invalid Vehicle !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
	

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->VehicleType->Validation()) {
                if ($this->VehicleType->save($this->request->data)) {
                    $this->Session->setFlash('Vehicle Type Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Vehicle Type Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Vehicle Type Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $VehicleType = $this->VehicleType->find('first', array(
                'contain' => array(),
                'conditions' => array('VEHICLE_TYPE_ID' => $id)
            ));
			
			//print_r($VehicleType);die;
            if(empty($VehicleType)) {
                $this->Session->setFlash('Invalid Vehicle Type !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $VehicleType;
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
                if ($this->VehicleType->delete($Id)) {
                    $this->Session->setFlash('Vehicle Type is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid Vehicle Type.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }
	   
	   
	   
      
	
	

}	