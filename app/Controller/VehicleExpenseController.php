<?php
class VehicleExpenseController extends AppController
{ 
    var $name = 'VehicleExpense';

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
		$Session = $this->Session->read('Auth.Admin');
		
		 $this->layout = 'admin_form_layout';
        //$this->VehicleExpense->recursive = 0;
        	
			$exp = array('Fuel'=>'Fuel',
					'Maintanence & Repairs'=>'Maintanence & Repairs',
					'Insurance'=>'Insurance',
					'Licence and Registration Fees'=>'Licence and Registration Fees',
					'Motor vehicle leasing costs'=>'Motor vehicle leasing costs');
			$this->set('exp',$exp);
			
			
			if(isset($this->request->data["VehicleExpense"]["EXPENSE_TYPE"]) && ($this->request->data["VehicleExpense"]["EXPENSE_TYPE"])!="" )
		{
			
			$VehicleExpense =$this->request->data["VehicleExpense"]["EXPENSE_TYPE"];
			$conditions = array('VehicleExpense.EXPENSE ' => $VehicleExpense);
				
				
			
		}
			$VehicleExpense = $this->VehicleExpense->find("all",array(
            'conditions' => $conditions,
            'limit' => PAGINATION_LIMIT_ADMIN));
			$this->set('expense', $VehicleExpense);
	}
	
	public function admin_view($ID=null){
		
		
		 $this->layout = 'admin_form_layout';
        //$this->VehicleExpense->recursive = 0;
        	$VehicleExpense = $this->VehicleExpense->find('first', array(
            'conditions' => array('EXPENSE_ID' => $ID)
        ));
			
			
			$this->set('expense', $VehicleExpense);
		
		
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
		
		$this->loadModel('Vehicle');
		$result = $this->Vehicle->GetVehicle();
		$this->set('vehicle',$result);
    
		$exp = array('Fuel'=>'Fuel',
					'Maintanence & Repairs'=>'Maintanence & Repairs',
					'Insurance'=>'Insurance',
					'Licence and Registration Fees'=>'Licence and Registration Fees',
					'Motor vehicle leasing costs'=>'Motor vehicle leasing costs');
		$this->set('exp',$exp);
        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
		
	}
	
	if ($this->request->is('post')) {
            $this->VehicleExpense->set($this->request->data);
            if ($this->VehicleExpense->Validation()) {
                $this->VehicleExpense->create();
				
               
					
					$this->request->data["VehicleExpense"]["DATE"] = $this->General->datefordb($this->request->data["VehicleExpense"]["DATE"]);
					
						
					$this->request->data['VehicleExpense']['USER_ID'] = $Session_data['ID'];
					$this->VehicleExpense->saveField("created_by",$Session_data['ID']);
					
					$ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
					$this->VehicleExpense->saveField("created_ip",$ip);
					 if ($this->VehicleExpense->save($this->request->data)) {
					
                    $this->Session->setFlash('VehicleExpense Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
                } else {
                $this->Session->setFlash('Vehicle Expense Not Added Please Try Again!', 'message_bad');
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
		
		$this->loadModel('Vehicle');
		$result = $this->Vehicle->GetVehicle();
		$this->set('vehicle',$result);
		$exp = array('Fuel'=>'Fuel',
					'Maintanence & Repairs'=>'Maintanence & Repairs',
					'Insurance'=>'Insurance',
					'Licence and Registration Fees'=>'Licence and Registration Fees',
					'Motor vehicle leasing costs'=>'Motor vehicle leasing costs');
		$this->set('exp',$exp);

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        
        if ($this->request->is('put') || $this->request->is('post')) {
			
			$this->request->data['VehicleExpense']['DATE'] = $this->General->datefordb($this->request->data['VehicleExpense']['DATE']);
            if ($this->VehicleExpense->Validation()) {
                if ($this->VehicleExpense->save($this->request->data)) {
					
					
                    $this->Session->setFlash('Vehicle Expense Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Vehicle Expense Type Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Vehicle Expense Type Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $VehicleExpense = $this->VehicleExpense->find('first', array(
                'contain' => array(),
                'conditions' => array('EXPENSE_ID' => $id)
            ));
			
			//print_r($VehicleExpense);die;
            if(empty($VehicleExpense)) {
                $this->Session->setFlash('Invalid Vehicle Expense !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
			
			$VehicleExpense['VehicleExpense']['DATE'] = date('d/m/Y', strtotime(str_replace('-','/',$VehicleExpense['VehicleExpense']['DATE'])));
            
			$this->request->data = $VehicleExpense;
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
                if ($this->VehicleExpense->delete($Id)) {
                    $this->Session->setFlash('Vehicle Expense is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid Vehicle Expense.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }
	

}	