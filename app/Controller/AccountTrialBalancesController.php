<?php
class AccountTrialBalancesController extends AppController
{ 
    var $name = 'AccountTrialBalances';

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
		$result = $this->AccountTrialBalance->find("all", array(
            'contain' => array('AccountGroup'),
			'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'AccountTrialBalance.SORT_ORDER asc'
        ));
		
        $this->set('data', $result);
		
		/*$this->loadModel('AccountDepartment');
		$result = $this->AccountDepartment->GetAccountDepartment();
		$this->set('account_departments', $result);*/
		
		}
		
		public function admin_view($ID=null){		
		
		 $this->layout = 'admin_form_layout';
        //$this->AccountTrialBalance->recursive = 0;
        	$AccountTrialBalance = $this->AccountTrialBalance->find('first', array(
			'contain' => array('AccountGroup'),
            'conditions' => array('ACCOUNT_TRIAL_BAL_ID' => $ID)
        ));
		
		if(isset($AccountTrialBalance['AccountTrialBalance']['DATE']) && $AccountTrialBalance['AccountTrialBalance']['DATE']!="")
		{
			$AccountTrialBalance['AccountTrialBalance']['DATE'] = Date('d/m/Y',strtotime($AccountTrialBalance['AccountTrialBalance']['DATE']));
		}
		else
		{
			$AccountTrialBalance['AccountTrialBalance']['DATE'] = "";
		}
		
		$this->set('data', $AccountTrialBalance);
		
		}
	
		public function admin_add(){		
		
		$this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		if($Session_data["ROLE_ID"]!=ACCOUNT_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}

		$this->loadModel('AccountGroup');
		$result = $this->AccountGroup->GetAccountGroup();		
		$this->set('account_groups', $result);
		
        if ($this->request->is('post')) {
						
            $this->AccountTrialBalance->set($this->request->data);

			/*echo "<pre>";
			print_r($this->AccountTrialBalance);
			die;*/
			
            if ($this->AccountTrialBalance->Validation()) {
                $this->AccountTrialBalance->create();
								
				if(isset($this->request->data["AccountTrialBalance"]["DATE"]) && $this->request->data["AccountTrialBalance"]["DATE"] != "")
				{					
					$this->request->data["AccountTrialBalance"]["DATE"] = $this->General->datefordb($this->request->data["AccountTrialBalance"]["DATE"]);
				}
								
				$this->AccountTrialBalance->saveField("created_by",$Session_data['ID']);
				
				$ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
				$this->AccountTrialBalance->saveField("created_ip",$ip);
				
                if ($this->AccountTrialBalance->save($this->request->data)) {
                   
                    $this->Session->setFlash('Account Trial Balance Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
            } else {
                $this->Session->setFlash('Account Trial Balance Not Added Please Try Again!', 'message_bad');
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
		
		if($Session_data["ROLE_ID"]!=ACCOUNT_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}

        $this->AccountTrialBalance->id = $id;
        if (empty($this->AccountTrialBalance->id)) {
            $this->Session->setFlash('Invalid Account Trial Balance!', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
	
		$this->loadModel('AccountGroup');
		$result = $this->AccountGroup->GetAccountGroup();
		$this->set('account_groups', $result);

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->AccountTrialBalance->Validation()) {
				
				if(isset($this->request->data["AccountTrialBalance"]["DATE"]) && $this->request->data["AccountTrialBalance"]["DATE"] != "")
				{					
					$this->request->data["AccountTrialBalance"]["DATE"] = $this->General->datefordb($this->request->data["AccountTrialBalance"]["DATE"]);
				}
				
                if ($this->AccountTrialBalance->save($this->request->data)) {
                    $this->Session->setFlash('Account Trial Balance Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Account Trial Balance Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Account Trial Balance Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $AccountTrialBalances = $this->AccountTrialBalance->find('first', array(
                'contain' => array(),
                'conditions' => array('ACCOUNT_TRIAL_BAL_ID' => $id)
            ));
			
			
			//print_r($AccountTrialBalances);die;
            if(empty($AccountTrialBalances)) {
                $this->Session->setFlash('Invalid Account Trial Balance!', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
			
			if(isset($AccountTrialBalances['AccountTrialBalance']['DATE']) && $AccountTrialBalances['AccountTrialBalance']['DATE']!="")
			{
				$AccountTrialBalances['AccountTrialBalance']['DATE'] = Date('d/m/Y',strtotime($AccountTrialBalances['AccountTrialBalance']['DATE']));
			}
			else
			{
				$AccountTrialBalances['AccountTrialBalance']['DATE'] = "";
			}
			
            $this->request->data = $AccountTrialBalances;
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
		
		if($Session_data["ROLE_ID"]!=ACCOUNT_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}
		
        if (!empty($Id)) {
            try {
                if ($this->AccountTrialBalance->delete($Id)) {
                    $this->Session->setFlash('Account Trial Balance Deleted Successfully', 'message_good');
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
            $this->Session->setFlash('Invalid Account Trial Balance!', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }
	   
	public function admin_report(){
			
        $this->layout = 'admin_form_layout';
		
		$this->set('school',null);				
		$this->set('disp_req_date',null);
		$this->set('req_date',null);		
		
		if ($this->request->is('post')) {
						
            $this->AccountTrialBalance->set($this->request->data);

			/*echo "<pre>";
			print_r($_POST);
			print_r($this->AccountTrialBalance);
			die;*/
			
            if ($this->AccountTrialBalance->Validation()) {
                $this->AccountTrialBalance->create();
							
				if(isset($this->request->data["AccountTrialBalance"]["DATE"]) && $this->request->data["AccountTrialBalance"]["DATE"] != "")
				{	
					$disp_req_date = Date('F d, Y',strtotime($this->General->datefordb($this->request->data["AccountTrialBalance"]["DATE"])));
					$this->request->data["AccountTrialBalance"]["DATE"] = $this->General->datefordb($this->request->data["AccountTrialBalance"]["DATE"]);
					$req_date = $this->request->data["AccountTrialBalance"]["DATE"];
				}
				else
				{
					$disp_req_date = "";
					$this->request->data["AccountTrialBalance"]["DATE"] = "";
					$req_date = "";
				}
				
				$this->loadModel('School');
				$result_scl = $this->School->GetSchoolDetail();
				$this->set('school',$result_scl);
				
				$this->loadModel('AccountGroup');
				$income_ag_id = $this->AccountGroup->GetIncomeAccountGroupId();		
				$this->set('income_ag_id', $income_ag_id);
				$expense_ag_id = $this->AccountGroup->GetExpenseAccountGroupId();
				$this->set('expense_ag_id', $expense_ag_id);
				$income_ag_title = $this->AccountGroup->GetIncomeAccountGroupTitle();		
				$this->set('income_ag_title', $income_ag_title);
				$expense_ag_title = $this->AccountGroup->GetExpenseAccountGroupTitle();
				$this->set('expense_ag_title', $expense_ag_title);
				
				$result = $this->AccountTrialBalance->GetATBByDate($req_date);
				$this->set('data', $result);
				
				/*echo "<pre>";
				print_r($result);
				die;*/
				
				$this->set('req_date',$req_date);
				$this->set('disp_req_date',$disp_req_date);
				
				if(isset($this->request->data["AccountTrialBalance"]["DATE"]) && $this->request->data["AccountTrialBalance"]["DATE"] != "")
				{	
					$disp_req_date = Date('d/m/Y',strtotime($this->General->datefordb($this->request->data["AccountTrialBalance"]["DATE"])));
					$this->request->data["AccountTrialBalance"]["DATE"] = $disp_req_date;
					$req_date = $this->request->data["AccountTrialBalance"]["DATE"];
				}
				else
				{
					$disp_req_date = "";
					$this->request->data["AccountTrialBalance"]["DATE"] = "";
					$req_date = "";
				}
				
				if(empty($result))
				{
					$this->Session->setFlash('Account Trial Balance Detail Not Found!', 'message_bad');
				}				
				
            } else {
                $this->Session->setFlash('Account Trial Balance Detail Not Found!', 'message_bad');
            }
        }
		
	}

}	