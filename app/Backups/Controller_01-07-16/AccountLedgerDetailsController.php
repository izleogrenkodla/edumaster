<?php
class AccountLedgerDetailsController extends AppController
{ 
    var $name = 'AccountLedgerDetails';

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
		$result = $this->AccountLedgerDetail->find("all", array(
            'contain' => array('AccountDepartment','AccountName','AccountGroup','AccountPaymentType'),
			'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'AccountLedgerDetail.SORT_ORDER asc'
        ));
		
        $this->set('data', $result);
		
		/*$this->loadModel('AccountLedgerDetail');
		$result = $this->AccountLedgerDetail->GetAccountLedgerDetail();
		$this->set('account_ledger_details', $result);*/
		
		}

		public function admin_view($ID=null){		
		
		 $this->layout = 'admin_form_layout';
        //$this->AccountLedgerDetail->recursive = 0;
        	$AccountLedgerDetail = $this->AccountLedgerDetail->find('first', array(
			'contain' => array('AccountDepartment','AccountName','AccountGroup','AccountPaymentType'),
            'conditions' => array('ACCOUNT_LEDGER_DET_ID' => $ID)
        ));
		
		$ACCOUNT_LEDGER_DOCUMENT=$AccountLedgerDetail['AccountLedgerDetail']['ACCOUNT_LEDGER_DOCUMENT'];
		$ACCOUNT_LEDGER_DOCUMENT_DL="";
		if(isset($ACCOUNT_LEDGER_DOCUMENT) && $ACCOUNT_LEDGER_DOCUMENT != "")
		{
		$ACCOUNT_LEDGER_DOCUMENT_DL=DOWNLOADURL.UPLOAD_ACC_LEDG_DOC.$ACCOUNT_LEDGER_DOCUMENT;
		}
		$this->set('ACCOUNT_LEDGER_DOCUMENT', $ACCOUNT_LEDGER_DOCUMENT);
		$this->set('ACCOUNT_LEDGER_DOCUMENT_DL', $ACCOUNT_LEDGER_DOCUMENT_DL);
		
		$A_DEPT_ID=$AccountLedgerDetail['AccountLedgerDetail']['ACCOUNT_DEPARTMENT_ID'];
		$this->loadModel('AccountName');
		$result = $this->AccountName->GetAccountNameNoByDeptId($A_DEPT_ID);
		$this->set('account_names', $result);
		
		if(isset($AccountLedgerDetail['AccountLedgerDetail']['DATE']) && $AccountLedgerDetail['AccountLedgerDetail']['DATE']!="")
		{
			$AccountLedgerDetail['AccountLedgerDetail']['DATE'] = Date('d/m/Y',strtotime($AccountLedgerDetail['AccountLedgerDetail']['DATE']));
		}
		else
		{
			$AccountLedgerDetail['AccountLedgerDetail']['DATE'] = "";
		}
		
		$this->set('data', $AccountLedgerDetail);
		
		}
		
		public function admin_add(){		
		
		$this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

		$this->loadModel('AccountDepartment');
		$result = $this->AccountDepartment->GetAccountDepartment();		
		$this->set('account_departments', $result);
		
		$result = array();
        $result[0] = 'Select Account Name [ Account Number ]';
		$this->set('account_names', $result);
		
		$this->loadModel('AccountGroup');
		$result = $this->AccountGroup->GetAccountGroup();		
		$this->set('account_groups', $result);
		
		$this->loadModel('AccountPaymentType');
		$result = $this->AccountPaymentType->GetAccountPaymentType();		
		$this->set('account_payment_types', $result);
		
		
        if ($this->request->is('post')) {
						
			if(empty($this->request->data)){
			 $this->Session->setFlash('Please make sure your file is less than '.UPLOAD_ALLOWED_SIZE.' MB.', 'message_bad');
			 $this->redirect(array('action' => 'index'));
			}			
						
            $this->AccountLedgerDetail->set($this->request->data);

			/*echo "<pre>";
			print_r($_POST);
			print_r($this->AccountLedgerDetail);
			die;*/
			
            if ($this->AccountLedgerDetail->Validation()) {
                $this->AccountLedgerDetail->create();
							
				$req_acc_ledg_doc = '';
				$req_empty_acc_ledg_doc = '';
                if($this->request->data["AccountLedgerDetail"]["ACCOUNT_LEDGER_DOCUMENT"]["size"]>0) {
                    $req_acc_ledg_doc = $this->request->data["AccountLedgerDetail"]["ACCOUNT_LEDGER_DOCUMENT"];
                    unset($this->request->data["AccountLedgerDetail"]["ACCOUNT_LEDGER_DOCUMENT"]);
                }		
				if(is_array($req_acc_ledg_doc) && $req_acc_ledg_doc["size"]>0) {
					//$lastid = $this->AccountLedgerDetail->getLastInsertId();
					$unique_id = uniqid();
					$path = UPLOADURL.UPLOAD_ACC_LEDG_DOC;
					$up_doc_ext_arr = explode(".",$req_acc_ledg_doc['name']);
					$up_doc_ext = end($up_doc_ext_arr);
					if(isset($up_doc_ext) && $up_doc_ext != "")
					{	
					$fname = strtotime(date('Y-m-d H:i:s')).$unique_id.".".$up_doc_ext;
					}
					else
					{
					$fname = $req_acc_ledg_doc['name'];
					}
					move_uploaded_file($req_acc_ledg_doc["tmp_name"],$path.$fname);
					//$this->AccountLedgerDetail->id = $lastid;
					$this->AccountLedgerDetail->saveField("ACCOUNT_LEDGER_DOCUMENT",$fname);
				}
				else
				{
					$req_empty_acc_ledg_doc = $this->request->data["AccountLedgerDetail"]["ACCOUNT_LEDGER_DOCUMENT"];
                    unset($this->request->data["AccountLedgerDetail"]["ACCOUNT_LEDGER_DOCUMENT"]);
				}	
							
				if(isset($this->request->data["AccountLedgerDetail"]["DATE"]) && $this->request->data["AccountLedgerDetail"]["DATE"] != "")
				{					
					$this->request->data["AccountLedgerDetail"]["DATE"] = $this->General->datefordb($this->request->data["AccountLedgerDetail"]["DATE"]);
				}
				
				$this->AccountLedgerDetail->saveField("created_by",$Session_data['ID']);
				
				$ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
				$this->AccountLedgerDetail->saveField("created_ip",$ip);
				
                if ($this->AccountLedgerDetail->save($this->request->data)) {
                   
                    $this->Session->setFlash('Account Ledger Detail Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
            } else {
                $this->Session->setFlash('Account Ledger Detail Not Added Please Try Again!', 'message_bad');
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

        $this->AccountLedgerDetail->id = $id;
        if (empty($this->AccountLedgerDetail->id)) {
            $this->Session->setFlash('Invalid Account Ledger Detail!', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
	
		$this->loadModel('AccountDepartment');
		$result = $this->AccountDepartment->GetAccountDepartment();
		$this->set('account_departments', $result);
		
		$this->loadModel('AccountGroup');
		$result = $this->AccountGroup->GetAccountGroup();		
		$this->set('account_groups', $result);
		
		$this->loadModel('AccountPaymentType');
		$result = $this->AccountPaymentType->GetAccountPaymentType();		
		$this->set('account_payment_types', $result);
		
		$AccountLedgerDetails_1 = $this->AccountLedgerDetail->find('first', array(
                'contain' => array(),
                'conditions' => array('ACCOUNT_LEDGER_DET_ID' => $id)
            ));
			
		$ACCOUNT_LEDGER_DOCUMENT=$AccountLedgerDetails_1['AccountLedgerDetail']['ACCOUNT_LEDGER_DOCUMENT'];
		$ACCOUNT_LEDGER_DOCUMENT_DL="";
		if(isset($ACCOUNT_LEDGER_DOCUMENT) && $ACCOUNT_LEDGER_DOCUMENT != "")
		{
		$ACCOUNT_LEDGER_DOCUMENT_DL=DOWNLOADURL.UPLOAD_ACC_LEDG_DOC.$ACCOUNT_LEDGER_DOCUMENT;
		}
		$this->set('ACCOUNT_LEDGER_DOCUMENT', $ACCOUNT_LEDGER_DOCUMENT);
		$this->set('ACCOUNT_LEDGER_DOCUMENT_DL', $ACCOUNT_LEDGER_DOCUMENT_DL);
		
		$A_DEPT_ID=$AccountLedgerDetails_1['AccountLedgerDetail']['ACCOUNT_DEPARTMENT_ID'];
		$this->loadModel('AccountName');
		$result = $this->AccountName->GetAccountNameNoByDeptId($A_DEPT_ID);
		$this->set('account_names', $result);
		
        if ($this->request->is('put') || $this->request->is('post')) {
						
			if(empty($this->request->data)){
			 $this->Session->setFlash('Please make sure your file is less than '.UPLOAD_ALLOWED_SIZE.' MB.', 'message_bad');
			 $this->redirect(array('action' => 'index'));
			}			
			
            if ($this->AccountLedgerDetail->Validation()) {
				
				$req_acc_ledg_doc = '';
				$req_empty_acc_ledg_doc = '';
                if($this->request->data["AccountLedgerDetail"]["ACCOUNT_LEDGER_DOCUMENT"]["size"]>0) {
                    $req_acc_ledg_doc = $this->request->data["AccountLedgerDetail"]["ACCOUNT_LEDGER_DOCUMENT"];
                    unset($this->request->data["AccountLedgerDetail"]["ACCOUNT_LEDGER_DOCUMENT"]);
                }
				
				if(is_array($req_acc_ledg_doc) && $req_acc_ledg_doc["size"]>0) {
					//$lastid = $this->AccountLedgerDetail->getLastInsertId();
					$unique_id = uniqid();
					$path = UPLOADURL.UPLOAD_ACC_LEDG_DOC;
					$up_doc_ext_arr = explode(".",$req_acc_ledg_doc['name']);
					$up_doc_ext = end($up_doc_ext_arr);
					if(isset($up_doc_ext) && $up_doc_ext != "")
					{	
					$fname = strtotime(date('Y-m-d H:i:s')).$unique_id.".".$up_doc_ext;
					}
					else
					{
					$fname = $req_acc_ledg_doc['name'];
					}
					move_uploaded_file($req_acc_ledg_doc["tmp_name"],$path.$fname);
					//$this->AccountLedgerDetail->id = $lastid;
					$this->AccountLedgerDetail->saveField("ACCOUNT_LEDGER_DOCUMENT",$fname);
					
					$path_dd = UPLOADURL.UPLOAD_ACC_LEDG_DOC;
					$this->General->delete_file($path_dd.$ACCOUNT_LEDGER_DOCUMENT);
					
				}
				else if(isset($ACCOUNT_LEDGER_DOCUMENT) && $ACCOUNT_LEDGER_DOCUMENT != "")
				{
					$this->request->data["AccountLedgerDetail"]["ACCOUNT_LEDGER_DOCUMENT"]=$ACCOUNT_LEDGER_DOCUMENT;
					$this->AccountLedgerDetail->saveField("ACCOUNT_LEDGER_DOCUMENT",$ACCOUNT_LEDGER_DOCUMENT);
				}
				else
				{
					$req_empty_acc_ledg_doc = $this->request->data["AccountLedgerDetail"]["ACCOUNT_LEDGER_DOCUMENT"];
                    unset($this->request->data["AccountLedgerDetail"]["ACCOUNT_LEDGER_DOCUMENT"]);
				}
				
				if(isset($this->request->data["AccountLedgerDetail"]["DATE"]) && $this->request->data["AccountLedgerDetail"]["DATE"] != "")
				{					
					$this->request->data["AccountLedgerDetail"]["DATE"] = $this->General->datefordb($this->request->data["AccountLedgerDetail"]["DATE"]);
				}
				
                if ($this->AccountLedgerDetail->save($this->request->data)) {
                    $this->Session->setFlash('Account Ledger Detail Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Account Ledger Detail Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Account Ledger Detail Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $AccountLedgerDetails = $this->AccountLedgerDetail->find('first', array(
                'contain' => array(),
                'conditions' => array('ACCOUNT_LEDGER_DET_ID' => $id)
            ));
			
			
			//print_r($AccountLedgerDetails);die;
            if(empty($AccountLedgerDetails)) {
                $this->Session->setFlash('Invalid Account Ledger Detail!', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
			
			if(isset($AccountLedgerDetails['AccountLedgerDetail']['DATE']) && $AccountLedgerDetails['AccountLedgerDetail']['DATE']!="")
			{
				$AccountLedgerDetails['AccountLedgerDetail']['DATE'] = Date('d/m/Y',strtotime($AccountLedgerDetails['AccountLedgerDetail']['DATE']));
			}
			else
			{
				$AccountLedgerDetails['AccountLedgerDetail']['DATE'] = "";
			}
			
            $this->request->data = $AccountLedgerDetails;
        }
	}
	
	
	 public function admin_delete($Id = null)
    {
        $this->layout = 'admin_form_layout';
        if (!empty($Id)) {
            try {
				
				$AccountLedgerDetailData = $this->AccountLedgerDetail->find('first', array(
					'contain' => array(),
					'conditions' => array('ACCOUNT_LEDGER_DET_ID' => $Id)
				));

				$fileName = $AccountLedgerDetailData['AccountLedgerDetail']['ACCOUNT_LEDGER_DOCUMENT'];
				
                if ($this->AccountLedgerDetail->delete($Id)) {
					
					$path = UPLOADURL.UPLOAD_ACC_LEDG_DOC;
					$this->General->delete_file($path.$fileName);
					
                    $this->Session->setFlash('Account Ledger Detail Deleted Successfully', 'message_good');
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
            $this->Session->setFlash('Invalid Account Ledger Detail!', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }

	public function admin_report(){
			
        $this->layout = 'admin_form_layout';
		
		$this->loadModel('AccountDepartment');
		$result = $this->AccountDepartment->GetAccountDepartment();		
		$this->set('account_departments', $result);
		
		$result = array();
        $result[0] = 'Select Account Name [ Account Number ]';
		$this->set('account_names', $result);
		
		$this->loadModel('AccountPaymentType');
		$result = $this->AccountPaymentType->GetAccountPaymentType();		
		$this->set('account_payment_types', $result);
		
		$this->set('school',null);				
		$this->set('disp_req_from_date',null);
		$this->set('req_from_date',null);
		$this->set('disp_req_to_date',null);
		$this->set('req_to_date',null);
		
		if ($this->request->is('post')) {
						
            $this->AccountLedgerDetail->set($this->request->data);

			/*echo "<pre>";
			print_r($_POST);
			print_r($this->AccountLedgerDetail);
			die;*/
			
            if ($this->AccountLedgerDetail->ValidationSearch()) {
                $this->AccountLedgerDetail->create();
							
				if(isset($this->request->data["AccountLedgerDetail"]["FROM_DATE"]) && $this->request->data["AccountLedgerDetail"]["FROM_DATE"] != "")
				{	
					$disp_req_from_date = Date('F d, Y',strtotime($this->General->datefordb($this->request->data["AccountLedgerDetail"]["FROM_DATE"])));
					$this->request->data["AccountLedgerDetail"]["FROM_DATE"] = $this->General->datefordb($this->request->data["AccountLedgerDetail"]["FROM_DATE"]);
					$req_from_date = $this->request->data["AccountLedgerDetail"]["FROM_DATE"];
				}
				else
				{
					$disp_req_from_date = "";
					$this->request->data["AccountLedgerDetail"]["FROM_DATE"] = "";
					$req_from_date = "";
				}
				
				if(isset($this->request->data["AccountLedgerDetail"]["TO_DATE"]) && $this->request->data["AccountLedgerDetail"]["TO_DATE"] != "")
				{	
					$disp_req_to_date = Date('F d, Y',strtotime($this->General->datefordb($this->request->data["AccountLedgerDetail"]["TO_DATE"])));
					$this->request->data["AccountLedgerDetail"]["TO_DATE"] = $this->General->datefordb($this->request->data["AccountLedgerDetail"]["TO_DATE"]);
					$req_to_date = $this->request->data["AccountLedgerDetail"]["TO_DATE"];
				}
				else
				{
					$disp_req_to_date = "";
					$this->request->data["AccountLedgerDetail"]["TO_DATE"] = "";
					$req_to_date = "";
				}
				
				$req_acc_dept = $this->request->data["AccountLedgerDetail"]["ACCOUNT_DEPARTMENT_ID"];
				$req_acc_name_no = $this->request->data["AccountLedgerDetail"]["ACCOUNT_NAME_ID"];
				$req_acc_payment_type = $this->request->data["AccountLedgerDetail"]["ACCOUNT_PAYMENT_TYPE_ID"];
				if($req_acc_payment_type==0)
				{
					$req_acc_payment_type="";
				}
				$this->set('account_payment_type_id',$req_acc_payment_type);
				
				$this->loadModel('AccountDepartment');
				$result_ad = $this->AccountDepartment->GetAccountDepartmentById($req_acc_dept);				
				$this->set('account_department', $result_ad["AccountDepartment"]["ACCOUNT_DEPARTMENT_TITLE"]);
				
				$this->loadModel('AccountPaymentType');
				$result = $this->AccountPaymentType->GetAccountPaymentType();		
				$this->set('account_payment_types', $result);
				$result_apt = $this->AccountPaymentType->GetAccountPaymentTypeById($req_acc_payment_type);
				$acc_payment_type_str="";	
				if(isset($result_apt['AccountPaymentType']['ACCOUNT_PAYMENT_TYPE']) && $result_apt['AccountPaymentType']['ACCOUNT_PAYMENT_TYPE'] != "")
				{
					$acc_payment_type_str = $result_apt['AccountPaymentType']['ACCOUNT_PAYMENT_TYPE'];
				}				
				$this->set('account_payment_type', $acc_payment_type_str);
				
				
				$req_acc_rpt_title = $this->request->data["AccountLedgerDetail"]["REPORT_TITLE"];				
				$this->set('account_report_title',$req_acc_rpt_title);
				
				$this->loadModel('School');
				$result_scl = $this->School->GetSchoolDetail();
				$this->set('school',$result_scl);
				
				$this->loadModel('AccountName');
				$result_ann = $this->AccountName->GetAccountNameNoByDeptId($req_acc_dept);
				$this->set('account_names', $result_ann);
				$result_anns = $this->AccountName->GetAccountNameById($req_acc_name_no);		
				$this->set('account_name', $result_anns['AccountName']['ACCOUNT_NAME']);
				$this->set('account_number', $result_anns['AccountName']['ACCOUNT_NUMBER']);
				
				$this->loadModel('AccountGroup');
				$result_ag = $this->AccountGroup->GetAccountGroup();		
				$this->set('account_groups', $result_ag);
				$income_ag_id = $this->AccountGroup->GetIncomeAccountGroupId();		
				$this->set('income_ag_id', $income_ag_id);
				$expense_ag_id = $this->AccountGroup->GetExpenseAccountGroupId();
				$this->set('expense_ag_id', $expense_ag_id);
				$income_ag_title = $this->AccountGroup->GetIncomeAccountGroupTitle();		
				$this->set('income_ag_title', $income_ag_title);
				$expense_ag_title = $this->AccountGroup->GetExpenseAccountGroupTitle();
				$this->set('expense_ag_title', $expense_ag_title);
				
				$result = $this->AccountLedgerDetail->GetALDByParams($req_from_date,$req_to_date,$req_acc_dept,$req_acc_name_no,$req_acc_payment_type);
				$this->set('data', $result);
				
				/*echo "<pre>";
				print_r($result);
				die;*/
				
				$this->set('req_from_date',$req_from_date);				
				$this->set('disp_req_from_date',$disp_req_from_date);
				
				$this->set('req_to_date',$req_to_date);
				$this->set('disp_req_to_date',$disp_req_to_date);
				
				if(isset($this->request->data["AccountLedgerDetail"]["FROM_DATE"]) && $this->request->data["AccountLedgerDetail"]["FROM_DATE"] != "")
				{	
					$disp_req_from_date = Date('d/m/Y',strtotime($this->General->datefordb($this->request->data["AccountLedgerDetail"]["FROM_DATE"])));
					$this->request->data["AccountLedgerDetail"]["FROM_DATE"] = $disp_req_from_date;
					$req_from_date = $this->request->data["AccountLedgerDetail"]["FROM_DATE"];
				}
				else
				{
					$disp_req_from_date = "";
					$this->request->data["AccountLedgerDetail"]["FROM_DATE"] = "";
					$req_from_date = "";
				}
				
				if(isset($this->request->data["AccountLedgerDetail"]["TO_DATE"]) && $this->request->data["AccountLedgerDetail"]["TO_DATE"] != "")
				{	
					$disp_req_to_date = Date('d/m/Y',strtotime($this->General->datefordb($this->request->data["AccountLedgerDetail"]["TO_DATE"])));
					$this->request->data["AccountLedgerDetail"]["TO_DATE"] = $disp_req_to_date;
					$req_to_date = $this->request->data["AccountLedgerDetail"]["TO_DATE"];
				}
				else
				{
					$disp_req_to_date = "";
					$this->request->data["AccountLedgerDetail"]["TO_DATE"] = "";
					$req_to_date = "";
				}
				
				if(empty($result))
				{
					$this->Session->setFlash('Account Ledger Detail Not Found!', 'message_bad');
				}				
				
            } else {
                $this->Session->setFlash('Account Ledger Detail Not Found!', 'message_bad');
            }
        }
		
	}
	
	public function admin_account_budget(){
			
        $this->layout = 'admin_form_layout';
		
		$this->set('school',null);				
		$this->set('disp_req_from_date',null);
		$this->set('req_from_date',null);
		$this->set('disp_req_to_date',null);
		$this->set('req_to_date',null);
		$this->set('data_income', null);
		$this->set('data_expense', null);
		
		if ($this->request->is('post')) {
						
            $this->AccountLedgerDetail->set($this->request->data);

			/*echo "<pre>";
			print_r($_POST);
			print_r($this->AccountLedgerDetail);
			die;*/
			
            if ($this->AccountLedgerDetail->ValidationSearch()) {
                $this->AccountLedgerDetail->create();
							
				if(isset($this->request->data["AccountLedgerDetail"]["FROM_DATE"]) && $this->request->data["AccountLedgerDetail"]["FROM_DATE"] != "")
				{	
					$disp_req_from_date = Date('F d, Y',strtotime($this->General->datefordb($this->request->data["AccountLedgerDetail"]["FROM_DATE"])));
					$this->request->data["AccountLedgerDetail"]["FROM_DATE"] = $this->General->datefordb($this->request->data["AccountLedgerDetail"]["FROM_DATE"]);
					$req_from_date = $this->request->data["AccountLedgerDetail"]["FROM_DATE"];
				}
				else
				{
					$disp_req_from_date = "";
					$this->request->data["AccountLedgerDetail"]["FROM_DATE"] = "";
					$req_from_date = "";
				}
				
				if(isset($this->request->data["AccountLedgerDetail"]["TO_DATE"]) && $this->request->data["AccountLedgerDetail"]["TO_DATE"] != "")
				{	
					$disp_req_to_date = Date('F d, Y',strtotime($this->General->datefordb($this->request->data["AccountLedgerDetail"]["TO_DATE"])));
					$this->request->data["AccountLedgerDetail"]["TO_DATE"] = $this->General->datefordb($this->request->data["AccountLedgerDetail"]["TO_DATE"]);
					$req_to_date = $this->request->data["AccountLedgerDetail"]["TO_DATE"];
				}
				else
				{
					$disp_req_to_date = "";
					$this->request->data["AccountLedgerDetail"]["TO_DATE"] = "";
					$req_to_date = "";
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
				
				$result_income = $this->AccountLedgerDetail->GetABIncomeByParams($req_from_date,$req_to_date,$income_ag_id);
				$result_income_val = $result_income["0"]["TOTAL_INCOME"];
				$this->set('data_income', $result_income_val);
				
				$result_expense = $this->AccountLedgerDetail->GetABExpensesByParams($req_from_date,$req_to_date,$expense_ag_id);
				$result_expense_val = $result_expense["0"]["TOTAL_EXPENSES"];
				$this->set('data_expense', $result_expense_val);
				
				$account_budget_balance = ($result_income_val-$result_expense_val);
				$account_budget_balance_fmt=number_format($account_budget_balance,2,'.','');
				$this->set('account_budget_balance_fmt', $account_budget_balance_fmt);
				
				/*echo "<pre>";
				print_r($result);
				die;*/
				
				$this->set('req_from_date',$req_from_date);				
				$this->set('disp_req_from_date',$disp_req_from_date);
				
				$this->set('req_to_date',$req_to_date);
				$this->set('disp_req_to_date',$disp_req_to_date);
				
				if(isset($this->request->data["AccountLedgerDetail"]["FROM_DATE"]) && $this->request->data["AccountLedgerDetail"]["FROM_DATE"] != "")
				{	
					$disp_req_from_date = Date('d/m/Y',strtotime($this->General->datefordb($this->request->data["AccountLedgerDetail"]["FROM_DATE"])));
					$this->request->data["AccountLedgerDetail"]["FROM_DATE"] = $disp_req_from_date;
					$req_from_date = $this->request->data["AccountLedgerDetail"]["FROM_DATE"];
				}
				else
				{
					$disp_req_from_date = "";
					$this->request->data["AccountLedgerDetail"]["FROM_DATE"] = "";
					$req_from_date = "";
				}
				
				if(isset($this->request->data["AccountLedgerDetail"]["TO_DATE"]) && $this->request->data["AccountLedgerDetail"]["TO_DATE"] != "")
				{	
					$disp_req_to_date = Date('d/m/Y',strtotime($this->General->datefordb($this->request->data["AccountLedgerDetail"]["TO_DATE"])));
					$this->request->data["AccountLedgerDetail"]["TO_DATE"] = $disp_req_to_date;
					$req_to_date = $this->request->data["AccountLedgerDetail"]["TO_DATE"];
				}
				else
				{
					$disp_req_to_date = "";
					$this->request->data["AccountLedgerDetail"]["TO_DATE"] = "";
					$req_to_date = "";
				}
				
				/*if(empty($result))
				{
					$this->Session->setFlash('Account Ledger Detail Not Found!', 'message_bad');
				}*/
				
            } else {
                $this->Session->setFlash('Account Ledger Detail Not Found!', 'message_bad');
            }
        }
		
	}

	public function admin_ajax_getAccountNamesbyDept(){
		
		$id=$this->request->data['id'];
		
		$this->loadModel('AccountName');
		$result = $this->AccountName->GetAccountNameNoByDeptId($id);
		//$this->set('account_names', $result);

		App::uses('FormHelper', 'View/Helper');
		$this->Form = new FormHelper(new View());
		
		echo $this->Form->input('AccountLedgerDetail][ACCOUNT_NAME_ID]', array('options' => $result,
		'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control select2me' , 'onchange' => 'select()' ,'id'=>'role','onchange' => 'showOptions(this)'));
				  
	   exit();
	}

}	