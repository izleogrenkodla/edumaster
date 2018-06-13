<?php
class StoppageController extends AppController
{ 
    var $name = 'Stoppage';

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
		
		$this->loadModel('VehicleShift');

		
		
		$this->loadModel('VehicleType');
		$type = $this->VehicleType->GetVehicleType();
		$this->set('type', $type);
		$shifts = array();
		$this->loadModel('VehicleShift');	
		
		$Stoppage = $this->Stoppage->find('all');
		
		// echo "<pre>";
		// print_r($Stoppage);
		// exit();
		$this->set('Stoppage',$Stoppage);
				
				
			// $type = $this->Stoppage->VehicleShift->GetVehicleShift();
			// $this->set('type', $type);
			// $Vehicletype = $this->Stoppage->VehicleType->GetVehicleType();
			// $this->set('Vehicletype', $Vehicletype);

			
			
		}
	
		public function admin_add(){
		
		
		$this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');
		
		
		
		$this->loadModel('Route');
		$type = $this->Route->GetRoute();
		$this->set('route', $type);
		
    

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        
		if ($this->request->is('post')) {
            $this->Stoppage->set($this->request->data);
            if ($this->Stoppage->Validation()) {
                $this->Stoppage->create();
				
               
					
					
					
						
					$this->request->data['Stoppage']['USER_ID'] = $Session_data['ID'];
					$this->Stoppage->saveField("created_by",$Session_data['ID']);
					
					$ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
					$this->Stoppage->saveField("created_ip",$ip);
					 if ($this->Stoppage->save($this->request->data)) {
					
                    $this->Session->setFlash('Stoppage Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
                } else {
                $this->Session->setFlash('Stoppage Not Added Please Try Again!', 'message_bad');
                }
        }
		
		
		
		
        
       }
	   
	   	public function admin_edit($id=null){
		
		
		$this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');
		
		
		$this->loadModel('Route');
		$type = $this->Route->GetRoute();
		$this->set('route', $type);
		
    

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        
        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->Stoppage->Validation()) {
                if ($this->Stoppage->save($this->request->data)) {
					
					
                    $this->Session->setFlash('Stoppage Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Stoppage Type Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Stoppage Type Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $Stoppage = $this->Stoppage->find('first', array(
                'contain' => array(),
                'conditions' => array('STOPPAGE_ID' => $id)
            ));
			
			//print_r($Stoppage);die;
            if(empty($Stoppage)) {
                $this->Session->setFlash('Invalid Stoppage !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $Stoppage;
			}
        }
		
		
		
		
		
        
        public function admin_delete($Id = null)
    {
        $this->layout = 'admin_form_layout';
        if (!empty($Id)) {
            try {
                if ($this->Stoppage->delete($Id)) {
                    $this->Session->setFlash('Stoppage is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid Stoppage .', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }
	   
	   
  
	   
	   
      
	
	

}	