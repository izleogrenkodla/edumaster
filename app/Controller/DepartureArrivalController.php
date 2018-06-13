<?php
class DepartureArrivalController extends AppController
{ 
    var $name = 'DepartureArrival';

    public function beforeFilter()
    {
        parent::beforeFilter();

        $this->Auth->allow('App_GetDepartureArrival');

        if(isset($this->Security) &&  ($this->RequestHandler->isAjax() || $this->RequestHandler->isPost())){
            $this->Security->validatePost = false;
            $this->Security->enabled = false;
            $this->Security->csrfCheck = false;
        }
    }
	
	
		public function admin_index(){
			
			
			
        $this->layout = 'admin_form_layout';
		 $result = $this->DepartureArrival->find("all", array(
			 'limit' => PAGINATION_LIMIT_ADMIN,
        ));
		// echo "<pre>";
		// print_r($result);die;

        $this->set('data', $result);
		}
		
		
		public function admin_view($ID=null){
		
		
		  $this->layout = 'admin_form_layout';
        //$this->VehicleExpense->recursive = 0;
        	$result = $this->DepartureArrival->find('first', array(
            'conditions' => array('DEP_ARR_ID' => $ID)
        ));
			
		
			
			$this->set('dep', $result);
		
	
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
		

        if ($this->request->is('post')) {
            $this->DepartureArrival->set($this->request->data);
				$dtime = $this->request->data['DepartureArrival']['DEPARTURE_TIME'];
				$s =  date('H:i:s',strtotime($dtime));
				// echo $s;
				// die;
            if ($this->DepartureArrival->Validation()) {
                $this->DepartureArrival->create();
				$this->DepartureArrival->saveField("DEPARTURE_TIME ",$s);
				$this->request->data["DepartureArrival"]["DATE"] = $this->General->datefordb($this->request->data["DepartureArrival"]["DATE"]);
				$this->request->data['Route']['USER_ID'] = $Session_data['ID'];
					$this->DepartureArrival->saveField("created_by",$Session_data['ID']);
					
					$ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
					$this->DepartureArrival->saveField("created_ip",$ip);
                if ($this->DepartureArrival->save($this->request->data)) {
                   
                    $this->Session->setFlash('Departure Arrival Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
            } else {
                $this->Session->setFlash('Departure Arrival Not Added Please Try Again!', 'message_bad');
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

        $this->DepartureArrival->id = $id;
        if (empty($this->DepartureArrival->id)) {
            $this->Session->setFlash('Invalid Vehicle !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		$this->loadModel('VehicleShift');
		$result = $this->VehicleShift->GetVehicleShift();
		$this->set('shift', $result);
		
		
		$this->loadModel('Vehicle');
		$vehicle = $this->Vehicle->GetVehicle();
		$this->set('vehicle', $vehicle);

        if ($this->request->is('put') || $this->request->is('post')) {
			
			$this->request->data['DepartureArrival']['DATE'] = $this->General->datefordb($this->request->data['DepartureArrival']['DATE']);
			
            if ($this->DepartureArrival->Validation()) {
                if ($this->DepartureArrival->save($this->request->data)) {
                    $this->Session->setFlash('Departure Arrival Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Departure Arrival Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Departure Arrival Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $DepartureArrival = $this->DepartureArrival->find('first', array(
                'contain' => array(),
                'conditions' => array('DEP_ARR_ID' => $id)
            ));
			
			//print_r($DepartureArrival);die;
            if(empty($DepartureArrival)) {
                $this->Session->setFlash('Invalid Departure Arrival !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
			
			$DepartureArrival['DepartureArrival']['DATE'] = date('d/m/Y', strtotime(str_replace('-','/',$DepartureArrival['DepartureArrival']['DATE'])));
			
            $this->request->data = $DepartureArrival;
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
                if ($this->DepartureArrival->delete($Id)) {
                    $this->Session->setFlash('Departure Arrival is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid Departure Arrival.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }
	 
	 public function App_GetDepartureArrival()
    {
        $this->layout = 'ajax';
        $this->autoRender = false;
        $message = '';
        $result_array = array();
        $status = false;
		
		$Vehicle = $this->request->data['Vehicle'];
		
        $conditions = array('DepartureArrival.VEHICLE_ID' => $Vehicle);

        $Vehicle = $this->DepartureArrival->find('all', array(
            'conditions' => $conditions,
            'contain' => array('VehicleShift','Vehicle'),
			'order' => 'DepartureArrival.DATE asc',
        ));
		
        if(!empty($Vehicle))
        {
            $message = 'Vehicle Departure Arrival Found';
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
            'data' => $Vehicle
        );

        echo json_encode($result_array); die;

    }
}	