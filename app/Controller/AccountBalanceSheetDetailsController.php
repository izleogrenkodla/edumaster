<?php
class AccountBalanceSheetDetailsController extends AppController
{ 
    var $name = 'AccountBalanceSheetDetails';

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
		$result = $this->AccountBalanceSheetDetail->find("all", array(
            'contain' => array('AccountBalanceSheetHead','AccountBalanceSheetSubHead'),
			'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'AccountBalanceSheetDetail.SORT_ORDER asc'
        ));
		
        $this->set('data', $result);
		
		/*$this->loadModel('AccountBalanceSheetHead');
		$result = $this->AccountBalanceSheetHead->GetAccountBalanceSheetHead();
		$this->set('account_balance_sheet_heads', $result);*/
		
		}

		public function admin_view($ID=null){		
		
		 $this->layout = 'admin_form_layout';
        //$this->AccountBalanceSheetDetail->recursive = 0;
        	$AccountBalanceSheetDetail = $this->AccountBalanceSheetDetail->find('first', array(
			'contain' => array('AccountBalanceSheetHead','AccountBalanceSheetSubHead'),
            'conditions' => array('ACCOUNT_BALANCE_SHEET_DET_ID' => $ID)
        ));
		
		if(isset($AccountBalanceSheetDetail['AccountBalanceSheetDetail']['DATE']) && $AccountBalanceSheetDetail['AccountBalanceSheetDetail']['DATE']!="")
		{
			$AccountBalanceSheetDetail['AccountBalanceSheetDetail']['DATE'] = Date('d/m/Y',strtotime($AccountBalanceSheetDetail['AccountBalanceSheetDetail']['DATE']));
		}
		else
		{
			$AccountBalanceSheetDetail['AccountBalanceSheetDetail']['DATE'] = "";
		}
		
		$this->set('data', $AccountBalanceSheetDetail);
		
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

		$this->loadModel('AccountBalanceSheetHead');
		$result = $this->AccountBalanceSheetHead->GetAccountBalanceSheetHead();		
		$this->set('account_balance_sheet_heads', $result);
		
		$result = array();
        $result[0] = 'Select Account Balance Sheet Sub Head';
		$this->set('account_balance_sheet_sub_heads', $result);
		
		
        if ($this->request->is('post')) {
						
            $this->AccountBalanceSheetDetail->set($this->request->data);

			/*echo "<pre>";
			print_r($_POST);
			print_r($this->AccountBalanceSheetDetail);
			die;*/
			
            if ($this->AccountBalanceSheetDetail->Validation()) {
                $this->AccountBalanceSheetDetail->create();
							
				if(isset($this->request->data["AccountBalanceSheetDetail"]["DATE"]) && $this->request->data["AccountBalanceSheetDetail"]["DATE"] != "")
				{					
					$this->request->data["AccountBalanceSheetDetail"]["DATE"] = $this->General->datefordb($this->request->data["AccountBalanceSheetDetail"]["DATE"]);
				}
							
				$this->AccountBalanceSheetDetail->saveField("created_by",$Session_data['ID']);
				
				$ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
				$this->AccountBalanceSheetDetail->saveField("created_ip",$ip);
				
                if ($this->AccountBalanceSheetDetail->save($this->request->data)) {
                   
                    $this->Session->setFlash('Account Balance Sheet Detail Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
            } else {
                $this->Session->setFlash('Account Balance Sheet Detail Not Added Please Try Again!', 'message_bad');
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

        $this->AccountBalanceSheetDetail->id = $id;
        if (empty($this->AccountBalanceSheetDetail->id)) {
            $this->Session->setFlash('Invalid Account Balance Sheet Detail!', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
	
		$this->loadModel('AccountBalanceSheetHead');
		$result = $this->AccountBalanceSheetHead->GetAccountBalanceSheetHead();
		$this->set('account_balance_sheet_heads', $result);
		
		$AccountBalanceSheetDetails_1 = $this->AccountBalanceSheetDetail->find('first', array(
                'contain' => array(),
                'conditions' => array('ACCOUNT_BALANCE_SHEET_DET_ID' => $id)
            ));
		
		$BS_HEAD_ID=$AccountBalanceSheetDetails_1['AccountBalanceSheetDetail']['ACCOUNT_BALANCE_SHEET_HEAD_ID'];
		
		$this->loadModel('AccountBalanceSheetSubHead');
		$result = $this->AccountBalanceSheetSubHead->GetAccountBalanceSheetSubHeadByHeadId($BS_HEAD_ID);
		
		$this->set('account_balance_sheet_sub_heads', $result);

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->AccountBalanceSheetDetail->Validation()) {
				
				if(isset($this->request->data["AccountBalanceSheetDetail"]["DATE"]) && $this->request->data["AccountBalanceSheetDetail"]["DATE"] != "")
				{					
					$this->request->data["AccountBalanceSheetDetail"]["DATE"] = $this->General->datefordb($this->request->data["AccountBalanceSheetDetail"]["DATE"]);
				}
				
                if ($this->AccountBalanceSheetDetail->save($this->request->data)) {
                    $this->Session->setFlash('Account Balance Sheet Detail Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Account Balance Sheet Detail Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Account Balance Sheet Detail Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $AccountBalanceSheetDetails = $this->AccountBalanceSheetDetail->find('first', array(
                'contain' => array(),
                'conditions' => array('ACCOUNT_BALANCE_SHEET_DET_ID' => $id)
            ));
			
			
			//print_r($AccountBalanceSheetDetails);die;
            if(empty($AccountBalanceSheetDetails)) {
                $this->Session->setFlash('Invalid Account Balance Sheet Detail!', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
			
			if(isset($AccountBalanceSheetDetails['AccountBalanceSheetDetail']['DATE']) && $AccountBalanceSheetDetails['AccountBalanceSheetDetail']['DATE']!="")
			{
				$AccountBalanceSheetDetails['AccountBalanceSheetDetail']['DATE'] = Date('d/m/Y',strtotime($AccountBalanceSheetDetails['AccountBalanceSheetDetail']['DATE']));
			}
			else
			{
				$AccountBalanceSheetDetails['AccountBalanceSheetDetail']['DATE'] = "";
			}
			
            $this->request->data = $AccountBalanceSheetDetails;
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
                if ($this->AccountBalanceSheetDetail->delete($Id)) {
                    $this->Session->setFlash('Account Balance Sheet Detail Deleted Successfully', 'message_good');
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
            $this->Session->setFlash('Invalid Account Balance Sheet Detail!', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }

	public function admin_report(){
			
        $this->layout = 'admin_form_layout';
		
		$this->set('school',null);				
		$this->set('disp_req_date',null);
		$this->set('req_date',null);
		
		if ($this->request->is('post')) {
						
            $this->AccountBalanceSheetDetail->set($this->request->data);

			/*echo "<pre>";
			print_r($_POST);
			print_r($this->AccountBalanceSheetDetail);
			die;*/
			
            if ($this->AccountBalanceSheetDetail->Validation()) {
                $this->AccountBalanceSheetDetail->create();
							
				if(isset($this->request->data["AccountBalanceSheetDetail"]["DATE"]) && $this->request->data["AccountBalanceSheetDetail"]["DATE"] != "")
				{	
					$disp_req_date = Date('F d, Y',strtotime($this->General->datefordb($this->request->data["AccountBalanceSheetDetail"]["DATE"])));
					$this->request->data["AccountBalanceSheetDetail"]["DATE"] = $this->General->datefordb($this->request->data["AccountBalanceSheetDetail"]["DATE"]);
					$req_date = $this->request->data["AccountBalanceSheetDetail"]["DATE"];					
				}
				else
				{
					$disp_req_date = "";
					$this->request->data["AccountBalanceSheetDetail"]["DATE"] = "";
					$req_date = "";					
				}
				$result_heads = $this->AccountBalanceSheetDetail->GetABSDHeads($req_date);				
				$this->set('data', $result_heads);
				
				$this->loadModel('School');
				$result = $this->School->GetSchoolDetail();
				$this->set('school',$result);
				
				$this->set('req_date',$req_date);
				
				$this->set('disp_req_date',$disp_req_date);
				
				if(isset($this->request->data["AccountBalanceSheetDetail"]["DATE"]) && $this->request->data["AccountBalanceSheetDetail"]["DATE"] != "")
				{	
					$disp_req_date = Date('d/m/Y',strtotime($this->General->datefordb($this->request->data["AccountBalanceSheetDetail"]["DATE"])));
					$this->request->data["AccountBalanceSheetDetail"]["DATE"] = $disp_req_date;
					$req_date = $this->request->data["AccountBalanceSheetDetail"]["DATE"];					
				}
				else
				{
					$disp_req_date = "";
					$this->request->data["AccountBalanceSheetDetail"]["DATE"] = "";
					$req_date = "";										
				}
				
				if(empty($result_heads))
				{
					$this->Session->setFlash('Account Balance Sheet Detail Not Found!', 'message_bad');
				}				
				
            } else {
                $this->Session->setFlash('Account Balance Sheet Detail Not Found!', 'message_bad');
            }
        }
		
		/*$this->loadModel('AccountBalanceSheetHead');
		$result = $this->AccountBalanceSheetHead->GetAccountBalanceSheetHead();
		$this->set('account_balance_sheet_heads', $result);*/
		
	}
	

	public function admin_ajax_getSubHeadsbyHead(){
		
		$id=$this->request->data['id'];
		
		$this->loadModel('AccountBalanceSheetSubHead');
		$result = $this->AccountBalanceSheetSubHead->GetAccountBalanceSheetSubHeadByHeadId($id);
		//$this->set('account_balance_sheet_sub_heads', $result);

		App::uses('FormHelper', 'View/Helper');
		$this->Form = new FormHelper(new View());
		
		echo $this->Form->input('AccountBalanceSheetDetail][ACCOUNT_BALANCE_SHEET_SUB_HEAD_ID]', array('options' => $result,
		'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control select2me' , 'onchange' => 'select()' ,'id'=>'role','onchange' => 'showOptions(this)'));
		
		  /*echo '<select name="CLS"  class="form-control select2me">';
		foreach($classes as $key => $value):
			echo '<option value="' . htmlspecialchars($key) . '">' . htmlspecialchars($value) . '</option>';
		endforeach;*/
	   exit();
       
	}	
	   
	   
      
	
	

}	