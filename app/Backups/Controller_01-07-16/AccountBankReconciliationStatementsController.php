<?php
class AccountBankReconciliationStatementsController extends AppController
{ 
    var $name = 'AccountBankReconciliationStatements';

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
		$result = $this->AccountBankReconciliationStatement->find("all", array(
            'contain' => array('AccountDepartment','AccountName'),
			'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'AccountBankReconciliationStatement.SORT_ORDER asc'
        ));
		
        $this->set('data', $result);
		
		/*$this->loadModel('AccountBankReconciliationStatement');
		$result = $this->AccountBankReconciliationStatement->GetAccountBankReconciliationStatement();
		$this->set('account_balance_sheet_heads', $result);*/
		
		}

		public function admin_view($ID=null){		
		
		 $this->layout = 'admin_form_layout';
        //$this->AccountBankReconciliationStatement->recursive = 0;
        	$AccountBankReconciliationStatement = $this->AccountBankReconciliationStatement->find('first', array(
			'contain' => array('AccountDepartment','AccountName'),
            'conditions' => array('ACCOUNT_BANK_RECONCILIATION_STAT_ID' => $ID)
        ));
		
		$BANK_STATEMENT_DOCUMENT=$AccountBankReconciliationStatement['AccountBankReconciliationStatement']['BANK_STATEMENT_DOCUMENT'];
		$BANK_STATEMENT_DOCUMENT_DL="";
		if(isset($BANK_STATEMENT_DOCUMENT) && $BANK_STATEMENT_DOCUMENT != "")
		{
		$BANK_STATEMENT_DOCUMENT_DL=DOWNLOADURL.UPLOAD_BANK_STAT_DOC.$BANK_STATEMENT_DOCUMENT;
		}
		$this->set('BANK_STATEMENT_DOCUMENT', $BANK_STATEMENT_DOCUMENT);
		$this->set('BANK_STATEMENT_DOCUMENT_DL', $BANK_STATEMENT_DOCUMENT_DL);
		
		$A_DEPT_ID=$AccountBankReconciliationStatement['AccountBankReconciliationStatement']['ACCOUNT_DEPARTMENT_ID'];
		$this->loadModel('AccountName');
		$result = $this->AccountName->GetAccountNameNoByDeptId($A_DEPT_ID);
		$this->set('account_names', $result);
		
		$BANK_ADDITION_HEADS=$AccountBankReconciliationStatement['AccountBankReconciliationStatement']['BANK_ADDITION_HEADS'];
		$BANK_ADDITION_HEADS_ARR = array();
		if(isset($BANK_ADDITION_HEADS) && $BANK_ADDITION_HEADS != "")
		{			
			$BANK_ADDITION_HEADS_ARR = explode("||",$BANK_ADDITION_HEADS);			
		}
		$this->set('BANK_ADDITION_HEADS_ARR', $BANK_ADDITION_HEADS_ARR);
		$BANK_ADDITION_HEADS_CNT = count($BANK_ADDITION_HEADS_ARR);
		$this->set('BANK_ADDITION_HEADS_CNT', $BANK_ADDITION_HEADS_CNT);
		$this->set('BANK_ADDITION_HEADS_FV', $BANK_ADDITION_HEADS_ARR[0]);
		
		$BANK_ADDITION_AMOUNTS=$AccountBankReconciliationStatement['AccountBankReconciliationStatement']['BANK_ADDITION_AMOUNTS'];
		$BANK_ADDITION_AMOUNTS_ARR = array();
		if(isset($BANK_ADDITION_AMOUNTS) && $BANK_ADDITION_AMOUNTS != "")
		{
			$BANK_ADDITION_AMOUNTS_ARR = explode("||",$BANK_ADDITION_AMOUNTS);			
		}
		$this->set('BANK_ADDITION_AMOUNTS_ARR', $BANK_ADDITION_AMOUNTS_ARR);
		$BANK_ADDITION_AMOUNTS_CNT = count($BANK_ADDITION_AMOUNTS_ARR);
		$this->set('BANK_ADDITION_AMOUNTS_CNT', $BANK_ADDITION_AMOUNTS_CNT);
		$this->set('BANK_ADDITION_AMOUNTS_FV', $BANK_ADDITION_AMOUNTS_ARR[0]);
		
		$BANK_DEDUCTION_HEADS=$AccountBankReconciliationStatement['AccountBankReconciliationStatement']['BANK_DEDUCTION_HEADS'];
		$BANK_DEDUCTION_HEADS_ARR = array();
		if(isset($BANK_DEDUCTION_HEADS) && $BANK_DEDUCTION_HEADS != "")
		{
			$BANK_DEDUCTION_HEADS_ARR = explode("||",$BANK_DEDUCTION_HEADS);			
		}
		$this->set('BANK_DEDUCTION_HEADS_ARR', $BANK_DEDUCTION_HEADS_ARR);
		$BANK_DEDUCTION_HEADS_CNT = count($BANK_DEDUCTION_HEADS_ARR);
		$this->set('BANK_DEDUCTION_HEADS_CNT', $BANK_DEDUCTION_HEADS_CNT);
		$this->set('BANK_DEDUCTION_HEADS_FV', $BANK_DEDUCTION_HEADS_ARR[0]);
		
		$BANK_DEDUCTION_AMOUNTS=$AccountBankReconciliationStatement['AccountBankReconciliationStatement']['BANK_DEDUCTION_AMOUNTS'];
		$BANK_DEDUCTION_AMOUNTS_ARR = array();
		if(isset($BANK_DEDUCTION_AMOUNTS) && $BANK_DEDUCTION_AMOUNTS != "")
		{
			$BANK_DEDUCTION_AMOUNTS_ARR = explode("||",$BANK_DEDUCTION_AMOUNTS);			
		}
		$this->set('BANK_DEDUCTION_AMOUNTS_ARR', $BANK_DEDUCTION_AMOUNTS_ARR);
		$BANK_DEDUCTION_AMOUNTS_CNT = count($BANK_DEDUCTION_AMOUNTS_ARR);
		$this->set('BANK_DEDUCTION_AMOUNTS_CNT', $BANK_DEDUCTION_AMOUNTS_CNT);
		$this->set('BANK_DEDUCTION_AMOUNTS_FV', $BANK_DEDUCTION_AMOUNTS_ARR[0]);
		
		/***************************************************************/
		
		$BOOK_ADDITION_HEADS=$AccountBankReconciliationStatement['AccountBankReconciliationStatement']['BOOK_ADDITION_HEADS'];
		$BOOK_ADDITION_HEADS_ARR = array();
		if(isset($BOOK_ADDITION_HEADS) && $BOOK_ADDITION_HEADS != "")
		{
			$BOOK_ADDITION_HEADS_ARR = explode("||",$BOOK_ADDITION_HEADS);			
		}
		$this->set('BOOK_ADDITION_HEADS_ARR', $BOOK_ADDITION_HEADS_ARR);
		$BOOK_ADDITION_HEADS_CNT = count($BOOK_ADDITION_HEADS_ARR);
		$this->set('BOOK_ADDITION_HEADS_CNT', $BOOK_ADDITION_HEADS_CNT);
		$this->set('BOOK_ADDITION_HEADS_FV', $BOOK_ADDITION_HEADS_ARR[0]);
		
		$BOOK_ADDITION_AMOUNTS=$AccountBankReconciliationStatement['AccountBankReconciliationStatement']['BOOK_ADDITION_AMOUNTS'];
		$BOOK_ADDITION_AMOUNTS_ARR = array();
		if(isset($BOOK_ADDITION_AMOUNTS) && $BOOK_ADDITION_AMOUNTS != "")
		{
			$BOOK_ADDITION_AMOUNTS_ARR = explode("||",$BOOK_ADDITION_AMOUNTS);			
		}
		$this->set('BOOK_ADDITION_AMOUNTS_ARR', $BOOK_ADDITION_AMOUNTS_ARR);
		$BOOK_ADDITION_AMOUNTS_CNT = count($BOOK_ADDITION_AMOUNTS_ARR);
		$this->set('BOOK_ADDITION_AMOUNTS_CNT', $BOOK_ADDITION_AMOUNTS_CNT);
		$this->set('BOOK_ADDITION_AMOUNTS_FV', $BOOK_ADDITION_AMOUNTS_ARR[0]);
		
		$BOOK_DEDUCTION_HEADS=$AccountBankReconciliationStatement['AccountBankReconciliationStatement']['BOOK_DEDUCTION_HEADS'];
		$BOOK_DEDUCTION_HEADS_ARR = array();
		if(isset($BOOK_DEDUCTION_HEADS) && $BOOK_DEDUCTION_HEADS != "")
		{
			$BOOK_DEDUCTION_HEADS_ARR = explode("||",$BOOK_DEDUCTION_HEADS);			
		}
		$this->set('BOOK_DEDUCTION_HEADS_ARR', $BOOK_DEDUCTION_HEADS_ARR);
		$BOOK_DEDUCTION_HEADS_CNT = count($BOOK_DEDUCTION_HEADS_ARR);
		$this->set('BOOK_DEDUCTION_HEADS_CNT', $BOOK_DEDUCTION_HEADS_CNT);
		$this->set('BOOK_DEDUCTION_HEADS_FV', $BOOK_DEDUCTION_HEADS_ARR[0]);
		
		$BOOK_DEDUCTION_AMOUNTS=$AccountBankReconciliationStatement['AccountBankReconciliationStatement']['BOOK_DEDUCTION_AMOUNTS'];
		$BOOK_DEDUCTION_AMOUNTS_ARR = array();
		if(isset($BOOK_DEDUCTION_AMOUNTS) && $BOOK_DEDUCTION_AMOUNTS != "")
		{
			$BOOK_DEDUCTION_AMOUNTS_ARR = explode("||",$BOOK_DEDUCTION_AMOUNTS);			
		}
		$this->set('BOOK_DEDUCTION_AMOUNTS_ARR', $BOOK_DEDUCTION_AMOUNTS_ARR);
		$BOOK_DEDUCTION_AMOUNTS_CNT = count($BOOK_DEDUCTION_AMOUNTS_ARR);
		$this->set('BOOK_DEDUCTION_AMOUNTS_CNT', $BOOK_DEDUCTION_AMOUNTS_CNT);
		$this->set('BOOK_DEDUCTION_AMOUNTS_FV', $BOOK_DEDUCTION_AMOUNTS_ARR[0]);
		
		if(isset($AccountBankReconciliationStatement['AccountBankReconciliationStatement']['DATE']) && $AccountBankReconciliationStatement['AccountBankReconciliationStatement']['DATE']!="")
		{
			$AccountBankReconciliationStatement['AccountBankReconciliationStatement']['DATE'] = Date('d/m/Y',strtotime($AccountBankReconciliationStatement['AccountBankReconciliationStatement']['DATE']));
		}
		else
		{
			$AccountBankReconciliationStatement['AccountBankReconciliationStatement']['DATE'] = "";
		}
		
		$this->set('data', $AccountBankReconciliationStatement);
		
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
		
		
        if ($this->request->is('post')) {
						
			if(empty($this->request->data)){
			 $this->Session->setFlash('Please make sure your file is less than '.UPLOAD_ALLOWED_SIZE.' MB.', 'message_bad');
			 $this->redirect(array('action' => 'index'));
			}			
						
            $this->AccountBankReconciliationStatement->set($this->request->data);

			/*echo "<pre>";
			print_r($_POST);
			print_r($this->AccountBankReconciliationStatement);
			die;*/
			
            if ($this->AccountBankReconciliationStatement->Validation()) {
                $this->AccountBankReconciliationStatement->create();
							
				$req_bank_stat_doc = '';
				$req_empty_bank_stat_doc = '';
                if($this->request->data["AccountBankReconciliationStatement"]["BANK_STATEMENT_DOCUMENT"]["size"]>0) {
                    $req_bank_stat_doc = $this->request->data["AccountBankReconciliationStatement"]["BANK_STATEMENT_DOCUMENT"];
                    unset($this->request->data["AccountBankReconciliationStatement"]["BANK_STATEMENT_DOCUMENT"]);
                }		
				if(is_array($req_bank_stat_doc) && $req_bank_stat_doc["size"]>0) {
					//$lastid = $this->AccountBankReconciliationStatement->getLastInsertId();
					$unique_id = uniqid();
					$path = UPLOADURL.UPLOAD_BANK_STAT_DOC;
					$up_doc_ext_arr = explode(".",$req_bank_stat_doc['name']);
					$up_doc_ext = end($up_doc_ext_arr);
					if(isset($up_doc_ext) && $up_doc_ext != "")
					{	
					$fname = strtotime(date('Y-m-d H:i:s')).$unique_id.".".$up_doc_ext;
					}
					else
					{
					$fname = $req_bank_stat_doc['name'];
					}
					move_uploaded_file($req_bank_stat_doc["tmp_name"],$path.$fname);
					//$this->AccountBankReconciliationStatement->id = $lastid;
					$this->AccountBankReconciliationStatement->saveField("BANK_STATEMENT_DOCUMENT",$fname);
				}	
				else
				{
					$req_empty_bank_stat_doc = $this->request->data["AccountBankReconciliationStatement"]["BANK_STATEMENT_DOCUMENT"];
                    unset($this->request->data["AccountBankReconciliationStatement"]["BANK_STATEMENT_DOCUMENT"]);
				}
							
				if(isset($this->request->data["AccountBankReconciliationStatement"]["DATE"]) && $this->request->data["AccountBankReconciliationStatement"]["DATE"] != "")
				{					
					$this->request->data["AccountBankReconciliationStatement"]["DATE"] = $this->General->datefordb($this->request->data["AccountBankReconciliationStatement"]["DATE"]);
				}
				
				$REQ_BALANCE_BANK = 0;
				if(isset($this->request->data["AccountBankReconciliationStatement"]["BALANCE_BANK"]) && $this->request->data["AccountBankReconciliationStatement"]["BALANCE_BANK"] != "")
				{					
					$REQ_BALANCE_BANK = $this->request->data["AccountBankReconciliationStatement"]["BALANCE_BANK"];
				}
				$REQ_BALANCE_BOOK = 0;
				if(isset($this->request->data["AccountBankReconciliationStatement"]["BALANCE_BOOK"]) && $this->request->data["AccountBankReconciliationStatement"]["BALANCE_BOOK"] != "")
				{					
					$REQ_BALANCE_BOOK = $this->request->data["AccountBankReconciliationStatement"]["BALANCE_BOOK"];
				}
							
				$this->AccountBankReconciliationStatement->saveField("created_by",$Session_data['ID']);
				
				$ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
				$this->AccountBankReconciliationStatement->saveField("created_ip",$ip);
				
				$BNK_AH_STR = "";
				if(isset($this->request->data["BANK_ADDITION_HEADS"]) && $this->request->data["BANK_ADDITION_HEADS"] != "")
				{
					$REQ_BANK_ADDITION_HEADS = $this->request->data["BANK_ADDITION_HEADS"];					
					foreach($REQ_BANK_ADDITION_HEADS as $BNK_AH_KEY=>$BNK_AH_VAL)
					{
						if($BNK_AH_VAL=="")
						{
							$BNK_AH_VAL="N/A";
						}
							$BNK_AH_STR .= $BNK_AH_VAL."||";
					}
					$BNK_AH_STR = rtrim($BNK_AH_STR,"||");					
				}
				$this->AccountBankReconciliationStatement->saveField("BANK_ADDITION_HEADS",$BNK_AH_STR);
				
				$BNK_AA_STR = "";
				$BNK_AA_TA = 0;
				if(isset($this->request->data["BANK_ADDITION_AMOUNTS"]) && $this->request->data["BANK_ADDITION_AMOUNTS"] != "")
				{
					$REQ_BANK_ADDITION_AMOUNTS = $this->request->data["BANK_ADDITION_AMOUNTS"];					
					foreach($REQ_BANK_ADDITION_AMOUNTS as $BNK_AA_KEY=>$BNK_AA_VAL)
					{
						if($BNK_AA_VAL=="")
						{
							$BNK_AA_VAL="0";
						}
							$BNK_AA_TA += $BNK_AA_VAL;
							$BNK_AA_STR .= $BNK_AA_VAL."||";
					}
					$BNK_AA_STR = rtrim($BNK_AA_STR,"||");
				}
				$this->AccountBankReconciliationStatement->saveField("BANK_ADDITION_AMOUNTS",$BNK_AA_STR);
				
				$BNK_DH_STR = "";				
				if(isset($this->request->data["BANK_DEDUCTION_HEADS"]) && $this->request->data["BANK_DEDUCTION_HEADS"] != "")
				{
					$REQ_BANK_DEDUCTION_HEADS = $this->request->data["BANK_DEDUCTION_HEADS"];					
					foreach($REQ_BANK_DEDUCTION_HEADS as $BNK_DH_KEY=>$BNK_DH_VAL)
					{
						if($BNK_DH_VAL=="")
						{
							$BNK_DH_VAL="N/A";
						}
							$BNK_DH_STR .= $BNK_DH_VAL."||";
					}
					$BNK_DH_STR = rtrim($BNK_DH_STR,"||");
				}
				$this->AccountBankReconciliationStatement->saveField("BANK_DEDUCTION_HEADS",$BNK_DH_STR);
				
				$BNK_DA_STR = "";
				$BNK_DA_TA = 0;
				if(isset($this->request->data["BANK_DEDUCTION_AMOUNTS"]) && $this->request->data["BANK_DEDUCTION_AMOUNTS"] != "")
				{
					$REQ_BANK_DEDUCTION_AMOUNTS = $this->request->data["BANK_DEDUCTION_AMOUNTS"];					
					foreach($REQ_BANK_DEDUCTION_AMOUNTS as $BNK_DA_KEY=>$BNK_DA_VAL)
					{
						if($BNK_DA_VAL=="")
						{
							$BNK_DA_VAL="0";
						}
							$BNK_DA_TA += $BNK_DA_VAL;
							$BNK_DA_STR .= $BNK_DA_VAL."||";
					}
					$BNK_DA_STR = rtrim($BNK_DA_STR,"||");
				}
				$this->AccountBankReconciliationStatement->saveField("BANK_DEDUCTION_AMOUNTS",$BNK_DA_STR);
				
				$ADJUSTED_BALANCE_BANK = $REQ_BALANCE_BANK + ($BNK_AA_TA - $BNK_DA_TA);
				$this->AccountBankReconciliationStatement->saveField("ADJUSTED_BALANCE_BANK",$ADJUSTED_BALANCE_BANK);
								
				/************************************************************************/
				
				$BK_AH_STR = "";
				if(isset($this->request->data["BOOK_ADDITION_HEADS"]) && $this->request->data["BOOK_ADDITION_HEADS"] != "")
				{
					$REQ_BOOK_ADDITION_HEADS = $this->request->data["BOOK_ADDITION_HEADS"];					
					foreach($REQ_BOOK_ADDITION_HEADS as $BK_AH_KEY=>$BK_AH_VAL)
					{
						if($BK_AH_VAL=="")
						{
							$BK_AH_VAL="N/A";
						}
							$BK_AH_STR .= $BK_AH_VAL."||";
					}
					$BK_AH_STR = rtrim($BK_AH_STR,"||");					
				}
				$this->AccountBankReconciliationStatement->saveField("BOOK_ADDITION_HEADS",$BK_AH_STR);
				
				$BK_AA_STR = "";
				$BK_AA_TA = 0;
				if(isset($this->request->data["BOOK_ADDITION_AMOUNTS"]) && $this->request->data["BOOK_ADDITION_AMOUNTS"] != "")
				{
					$REQ_BOOK_ADDITION_AMOUNTS = $this->request->data["BOOK_ADDITION_AMOUNTS"];					
					foreach($REQ_BOOK_ADDITION_AMOUNTS as $BK_AA_KEY=>$BK_AA_VAL)
					{
						if($BK_AA_VAL=="")
						{
							$BK_AA_VAL="0";
						}
							$BK_AA_TA += $BK_AA_VAL;
							$BK_AA_STR .= $BK_AA_VAL."||";
					}
					$BK_AA_STR = rtrim($BK_AA_STR,"||");
				}
				$this->AccountBankReconciliationStatement->saveField("BOOK_ADDITION_AMOUNTS",$BK_AA_STR);
				
				$BK_DH_STR = "";
				if(isset($this->request->data["BOOK_DEDUCTION_HEADS"]) && $this->request->data["BOOK_DEDUCTION_HEADS"] != "")
				{
					$REQ_BOOK_DEDUCTION_HEADS = $this->request->data["BOOK_DEDUCTION_HEADS"];					
					foreach($REQ_BOOK_DEDUCTION_HEADS as $BK_DH_KEY=>$BK_DH_VAL)
					{
						if($BK_DH_VAL=="")
						{
							$BK_DH_VAL="N/A";
						}
							$BK_DH_STR .= $BK_DH_VAL."||";
					}
					$BK_DH_STR = rtrim($BK_DH_STR,"||");
				}
				$this->AccountBankReconciliationStatement->saveField("BOOK_DEDUCTION_HEADS",$BK_DH_STR);
				
				$BK_DA_STR = "";
				$BK_DA_TA = 0;
				if(isset($this->request->data["BOOK_DEDUCTION_AMOUNTS"]) && $this->request->data["BOOK_DEDUCTION_AMOUNTS"] != "")
				{
					$REQ_BOOK_DEDUCTION_AMOUNTS = $this->request->data["BOOK_DEDUCTION_AMOUNTS"];					
					foreach($REQ_BOOK_DEDUCTION_AMOUNTS as $BK_DA_KEY=>$BK_DA_VAL)
					{
						if($BK_DA_VAL=="")
						{
							$BK_DA_VAL="0";
						}
							$BK_DA_TA += $BK_DA_VAL;
							$BK_DA_STR .= $BK_DA_VAL."||";
					}
					$BK_DA_STR = rtrim($BK_DA_STR,"||");
				}
				$this->AccountBankReconciliationStatement->saveField("BOOK_DEDUCTION_AMOUNTS",$BK_DA_STR);
				
				$ADJUSTED_BALANCE_BOOK = $REQ_BALANCE_BOOK + ($BK_AA_TA - $BK_DA_TA);
				$this->AccountBankReconciliationStatement->saveField("ADJUSTED_BALANCE_BOOK",$ADJUSTED_BALANCE_BOOK);
								
				
                if ($this->AccountBankReconciliationStatement->save($this->request->data)) {
                   
                    $this->Session->setFlash('Bank Reconciliation Statement Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
            } else {
                $this->Session->setFlash('Bank Reconciliation Statement Not Added Please Try Again!', 'message_bad');
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

        $this->AccountBankReconciliationStatement->id = $id;
        if (empty($this->AccountBankReconciliationStatement->id)) {
            $this->Session->setFlash('Invalid Bank Reconciliation Statement!', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
	
		$this->loadModel('AccountDepartment');
		$result = $this->AccountDepartment->GetAccountDepartment();
		$this->set('account_departments', $result);
		
		$AccountBankReconciliationStatements_1 = $this->AccountBankReconciliationStatement->find('first', array(
                'contain' => array(),
                'conditions' => array('ACCOUNT_BANK_RECONCILIATION_STAT_ID' => $id)
            ));
			
		$BANK_STATEMENT_DOCUMENT=$AccountBankReconciliationStatements_1['AccountBankReconciliationStatement']['BANK_STATEMENT_DOCUMENT'];
		$BANK_STATEMENT_DOCUMENT_DL="";
		if(isset($BANK_STATEMENT_DOCUMENT) && $BANK_STATEMENT_DOCUMENT != "")
		{
		$BANK_STATEMENT_DOCUMENT_DL=DOWNLOADURL.UPLOAD_BANK_STAT_DOC.$BANK_STATEMENT_DOCUMENT;
		}
		$this->set('BANK_STATEMENT_DOCUMENT', $BANK_STATEMENT_DOCUMENT);
		$this->set('BANK_STATEMENT_DOCUMENT_DL', $BANK_STATEMENT_DOCUMENT_DL);
		
		$A_DEPT_ID=$AccountBankReconciliationStatements_1['AccountBankReconciliationStatement']['ACCOUNT_DEPARTMENT_ID'];
		$this->loadModel('AccountName');
		$result = $this->AccountName->GetAccountNameNoByDeptId($A_DEPT_ID);
		$this->set('account_names', $result);
		
		$BANK_ADDITION_HEADS=$AccountBankReconciliationStatements_1['AccountBankReconciliationStatement']['BANK_ADDITION_HEADS'];
		$BANK_ADDITION_HEADS_ARR = array();
		if(isset($BANK_ADDITION_HEADS) && $BANK_ADDITION_HEADS != "")
		{			
			$BANK_ADDITION_HEADS_ARR = explode("||",$BANK_ADDITION_HEADS);			
		}
		$this->set('BANK_ADDITION_HEADS_ARR', $BANK_ADDITION_HEADS_ARR);
		$BANK_ADDITION_HEADS_CNT = count($BANK_ADDITION_HEADS_ARR);
		$this->set('BANK_ADDITION_HEADS_CNT', $BANK_ADDITION_HEADS_CNT);
		$this->set('BANK_ADDITION_HEADS_FV', $BANK_ADDITION_HEADS_ARR[0]);
		
		$BANK_ADDITION_AMOUNTS=$AccountBankReconciliationStatements_1['AccountBankReconciliationStatement']['BANK_ADDITION_AMOUNTS'];
		$BANK_ADDITION_AMOUNTS_ARR = array();
		if(isset($BANK_ADDITION_AMOUNTS) && $BANK_ADDITION_AMOUNTS != "")
		{
			$BANK_ADDITION_AMOUNTS_ARR = explode("||",$BANK_ADDITION_AMOUNTS);			
		}
		$this->set('BANK_ADDITION_AMOUNTS_ARR', $BANK_ADDITION_AMOUNTS_ARR);
		$BANK_ADDITION_AMOUNTS_CNT = count($BANK_ADDITION_AMOUNTS_ARR);
		$this->set('BANK_ADDITION_AMOUNTS_CNT', $BANK_ADDITION_AMOUNTS_CNT);
		$this->set('BANK_ADDITION_AMOUNTS_FV', $BANK_ADDITION_AMOUNTS_ARR[0]);
		
		$BANK_DEDUCTION_HEADS=$AccountBankReconciliationStatements_1['AccountBankReconciliationStatement']['BANK_DEDUCTION_HEADS'];
		$BANK_DEDUCTION_HEADS_ARR = array();
		if(isset($BANK_DEDUCTION_HEADS) && $BANK_DEDUCTION_HEADS != "")
		{
			$BANK_DEDUCTION_HEADS_ARR = explode("||",$BANK_DEDUCTION_HEADS);			
		}
		$this->set('BANK_DEDUCTION_HEADS_ARR', $BANK_DEDUCTION_HEADS_ARR);
		$BANK_DEDUCTION_HEADS_CNT = count($BANK_DEDUCTION_HEADS_ARR);
		$this->set('BANK_DEDUCTION_HEADS_CNT', $BANK_DEDUCTION_HEADS_CNT);
		$this->set('BANK_DEDUCTION_HEADS_FV', $BANK_DEDUCTION_HEADS_ARR[0]);
		
		$BANK_DEDUCTION_AMOUNTS=$AccountBankReconciliationStatements_1['AccountBankReconciliationStatement']['BANK_DEDUCTION_AMOUNTS'];
		$BANK_DEDUCTION_AMOUNTS_ARR = array();
		if(isset($BANK_DEDUCTION_AMOUNTS) && $BANK_DEDUCTION_AMOUNTS != "")
		{
			$BANK_DEDUCTION_AMOUNTS_ARR = explode("||",$BANK_DEDUCTION_AMOUNTS);			
		}
		$this->set('BANK_DEDUCTION_AMOUNTS_ARR', $BANK_DEDUCTION_AMOUNTS_ARR);
		$BANK_DEDUCTION_AMOUNTS_CNT = count($BANK_DEDUCTION_AMOUNTS_ARR);
		$this->set('BANK_DEDUCTION_AMOUNTS_CNT', $BANK_DEDUCTION_AMOUNTS_CNT);
		$this->set('BANK_DEDUCTION_AMOUNTS_FV', $BANK_DEDUCTION_AMOUNTS_ARR[0]);
		
		/***************************************************************/
		
		$BOOK_ADDITION_HEADS=$AccountBankReconciliationStatements_1['AccountBankReconciliationStatement']['BOOK_ADDITION_HEADS'];
		$BOOK_ADDITION_HEADS_ARR = array();
		if(isset($BOOK_ADDITION_HEADS) && $BOOK_ADDITION_HEADS != "")
		{
			$BOOK_ADDITION_HEADS_ARR = explode("||",$BOOK_ADDITION_HEADS);			
		}
		$this->set('BOOK_ADDITION_HEADS_ARR', $BOOK_ADDITION_HEADS_ARR);
		$BOOK_ADDITION_HEADS_CNT = count($BOOK_ADDITION_HEADS_ARR);
		$this->set('BOOK_ADDITION_HEADS_CNT', $BOOK_ADDITION_HEADS_CNT);
		$this->set('BOOK_ADDITION_HEADS_FV', $BOOK_ADDITION_HEADS_ARR[0]);
		
		$BOOK_ADDITION_AMOUNTS=$AccountBankReconciliationStatements_1['AccountBankReconciliationStatement']['BOOK_ADDITION_AMOUNTS'];
		$BOOK_ADDITION_AMOUNTS_ARR = array();
		if(isset($BOOK_ADDITION_AMOUNTS) && $BOOK_ADDITION_AMOUNTS != "")
		{
			$BOOK_ADDITION_AMOUNTS_ARR = explode("||",$BOOK_ADDITION_AMOUNTS);			
		}
		$this->set('BOOK_ADDITION_AMOUNTS_ARR', $BOOK_ADDITION_AMOUNTS_ARR);
		$BOOK_ADDITION_AMOUNTS_CNT = count($BOOK_ADDITION_AMOUNTS_ARR);
		$this->set('BOOK_ADDITION_AMOUNTS_CNT', $BOOK_ADDITION_AMOUNTS_CNT);
		$this->set('BOOK_ADDITION_AMOUNTS_FV', $BOOK_ADDITION_AMOUNTS_ARR[0]);
		
		$BOOK_DEDUCTION_HEADS=$AccountBankReconciliationStatements_1['AccountBankReconciliationStatement']['BOOK_DEDUCTION_HEADS'];
		$BOOK_DEDUCTION_HEADS_ARR = array();
		if(isset($BOOK_DEDUCTION_HEADS) && $BOOK_DEDUCTION_HEADS != "")
		{
			$BOOK_DEDUCTION_HEADS_ARR = explode("||",$BOOK_DEDUCTION_HEADS);			
		}
		$this->set('BOOK_DEDUCTION_HEADS_ARR', $BOOK_DEDUCTION_HEADS_ARR);
		$BOOK_DEDUCTION_HEADS_CNT = count($BOOK_DEDUCTION_HEADS_ARR);
		$this->set('BOOK_DEDUCTION_HEADS_CNT', $BOOK_DEDUCTION_HEADS_CNT);
		$this->set('BOOK_DEDUCTION_HEADS_FV', $BOOK_DEDUCTION_HEADS_ARR[0]);
		
		$BOOK_DEDUCTION_AMOUNTS=$AccountBankReconciliationStatements_1['AccountBankReconciliationStatement']['BOOK_DEDUCTION_AMOUNTS'];
		$BOOK_DEDUCTION_AMOUNTS_ARR = array();
		if(isset($BOOK_DEDUCTION_AMOUNTS) && $BOOK_DEDUCTION_AMOUNTS != "")
		{
			$BOOK_DEDUCTION_AMOUNTS_ARR = explode("||",$BOOK_DEDUCTION_AMOUNTS);			
		}
		$this->set('BOOK_DEDUCTION_AMOUNTS_ARR', $BOOK_DEDUCTION_AMOUNTS_ARR);
		$BOOK_DEDUCTION_AMOUNTS_CNT = count($BOOK_DEDUCTION_AMOUNTS_ARR);
		$this->set('BOOK_DEDUCTION_AMOUNTS_CNT', $BOOK_DEDUCTION_AMOUNTS_CNT);
		$this->set('BOOK_DEDUCTION_AMOUNTS_FV', $BOOK_DEDUCTION_AMOUNTS_ARR[0]);
		

        if ($this->request->is('put') || $this->request->is('post')) {
						
			if(empty($this->request->data)){
			 $this->Session->setFlash('Please make sure your file is less than '.UPLOAD_ALLOWED_SIZE.' MB.', 'message_bad');
			 $this->redirect(array('action' => 'index'));
			}			
			
            if ($this->AccountBankReconciliationStatement->Validation()) {
				
				$req_bank_stat_doc = '';
				$req_empty_bank_stat_doc = '';
                if($this->request->data["AccountBankReconciliationStatement"]["BANK_STATEMENT_DOCUMENT"]["size"]>0) {
                    $req_bank_stat_doc = $this->request->data["AccountBankReconciliationStatement"]["BANK_STATEMENT_DOCUMENT"];
                    unset($this->request->data["AccountBankReconciliationStatement"]["BANK_STATEMENT_DOCUMENT"]);
                }
				
				if(is_array($req_bank_stat_doc) && $req_bank_stat_doc["size"]>0) {
					//$lastid = $this->AccountBankReconciliationStatement->getLastInsertId();
					$unique_id = uniqid();
					$path = UPLOADURL.UPLOAD_BANK_STAT_DOC;
					$up_doc_ext_arr = explode(".",$req_bank_stat_doc['name']);
					$up_doc_ext = end($up_doc_ext_arr);
					if(isset($up_doc_ext) && $up_doc_ext != "")
					{	
					$fname = strtotime(date('Y-m-d H:i:s')).$unique_id.".".$up_doc_ext;
					}
					else
					{
					$fname = $req_bank_stat_doc['name'];
					}
					move_uploaded_file($req_bank_stat_doc["tmp_name"],$path.$fname);
					//$this->AccountBankReconciliationStatement->id = $lastid;
					$this->AccountBankReconciliationStatement->saveField("BANK_STATEMENT_DOCUMENT",$fname);
					
					$path_dd = UPLOADURL.UPLOAD_BANK_STAT_DOC;
					$this->General->delete_file($path_dd.$BANK_STATEMENT_DOCUMENT);
					
				}
				else if(isset($BANK_STATEMENT_DOCUMENT) && $BANK_STATEMENT_DOCUMENT != "")
				{
					$this->request->data["AccountBankReconciliationStatement"]["BANK_STATEMENT_DOCUMENT"]=$BANK_STATEMENT_DOCUMENT;
					$this->AccountBankReconciliationStatement->saveField("BANK_STATEMENT_DOCUMENT",$BANK_STATEMENT_DOCUMENT);
				}
				else
				{
					$req_empty_bank_stat_doc = $this->request->data["AccountBankReconciliationStatement"]["BANK_STATEMENT_DOCUMENT"];
                    unset($this->request->data["AccountBankReconciliationStatement"]["BANK_STATEMENT_DOCUMENT"]);
				}
				
				if(isset($this->request->data["AccountBankReconciliationStatement"]["DATE"]) && $this->request->data["AccountBankReconciliationStatement"]["DATE"] != "")
				{					
					$this->request->data["AccountBankReconciliationStatement"]["DATE"] = $this->General->datefordb($this->request->data["AccountBankReconciliationStatement"]["DATE"]);
				}
				
				$REQ_BALANCE_BANK = 0;
				if(isset($this->request->data["AccountBankReconciliationStatement"]["BALANCE_BANK"]) && $this->request->data["AccountBankReconciliationStatement"]["BALANCE_BANK"] != "")
				{					
					$REQ_BALANCE_BANK = $this->request->data["AccountBankReconciliationStatement"]["BALANCE_BANK"];
				}
				$REQ_BALANCE_BOOK = 0;
				if(isset($this->request->data["AccountBankReconciliationStatement"]["BALANCE_BOOK"]) && $this->request->data["AccountBankReconciliationStatement"]["BALANCE_BOOK"] != "")
				{					
					$REQ_BALANCE_BOOK = $this->request->data["AccountBankReconciliationStatement"]["BALANCE_BOOK"];
				}
							
				$BNK_AH_STR = "";
				if(isset($this->request->data["BANK_ADDITION_HEADS"]) && $this->request->data["BANK_ADDITION_HEADS"] != "")
				{
					$REQ_BANK_ADDITION_HEADS = $this->request->data["BANK_ADDITION_HEADS"];					
					foreach($REQ_BANK_ADDITION_HEADS as $BNK_AH_KEY=>$BNK_AH_VAL)
					{
						if($BNK_AH_VAL=="")
						{
							$BNK_AH_VAL="N/A";
						}
							$BNK_AH_STR .= $BNK_AH_VAL."||";
					}
					$BNK_AH_STR = rtrim($BNK_AH_STR,"||");					
				}
				$this->AccountBankReconciliationStatement->saveField("BANK_ADDITION_HEADS",$BNK_AH_STR);
				
				$BNK_AA_STR = "";
				$BNK_AA_TA = 0;
				if(isset($this->request->data["BANK_ADDITION_AMOUNTS"]) && $this->request->data["BANK_ADDITION_AMOUNTS"] != "")
				{
					$REQ_BANK_ADDITION_AMOUNTS = $this->request->data["BANK_ADDITION_AMOUNTS"];					
					foreach($REQ_BANK_ADDITION_AMOUNTS as $BNK_AA_KEY=>$BNK_AA_VAL)
					{
						if($BNK_AA_VAL=="")
						{
							$BNK_AA_VAL="0";
						}
							$BNK_AA_TA += $BNK_AA_VAL;
							$BNK_AA_STR .= $BNK_AA_VAL."||";
					}
					$BNK_AA_STR = rtrim($BNK_AA_STR,"||");
				}
				$this->AccountBankReconciliationStatement->saveField("BANK_ADDITION_AMOUNTS",$BNK_AA_STR);
				
				$BNK_DH_STR = "";				
				if(isset($this->request->data["BANK_DEDUCTION_HEADS"]) && $this->request->data["BANK_DEDUCTION_HEADS"] != "")
				{
					$REQ_BANK_DEDUCTION_HEADS = $this->request->data["BANK_DEDUCTION_HEADS"];					
					foreach($REQ_BANK_DEDUCTION_HEADS as $BNK_DH_KEY=>$BNK_DH_VAL)
					{
						if($BNK_DH_VAL=="")
						{
							$BNK_DH_VAL="N/A";
						}
							$BNK_DH_STR .= $BNK_DH_VAL."||";
					}
					$BNK_DH_STR = rtrim($BNK_DH_STR,"||");
				}
				$this->AccountBankReconciliationStatement->saveField("BANK_DEDUCTION_HEADS",$BNK_DH_STR);
				
				$BNK_DA_STR = "";
				$BNK_DA_TA = 0;
				if(isset($this->request->data["BANK_DEDUCTION_AMOUNTS"]) && $this->request->data["BANK_DEDUCTION_AMOUNTS"] != "")
				{
					$REQ_BANK_DEDUCTION_AMOUNTS = $this->request->data["BANK_DEDUCTION_AMOUNTS"];					
					foreach($REQ_BANK_DEDUCTION_AMOUNTS as $BNK_DA_KEY=>$BNK_DA_VAL)
					{
						if($BNK_DA_VAL=="")
						{
							$BNK_DA_VAL="0";
						}
							$BNK_DA_TA += $BNK_DA_VAL;
							$BNK_DA_STR .= $BNK_DA_VAL."||";
					}
					$BNK_DA_STR = rtrim($BNK_DA_STR,"||");
				}
				$this->AccountBankReconciliationStatement->saveField("BANK_DEDUCTION_AMOUNTS",$BNK_DA_STR);
				
				$ADJUSTED_BALANCE_BANK = $REQ_BALANCE_BANK + ($BNK_AA_TA - $BNK_DA_TA);
				$this->AccountBankReconciliationStatement->saveField("ADJUSTED_BALANCE_BANK",$ADJUSTED_BALANCE_BANK);
								
				/************************************************************************/
				
				$BK_AH_STR = "";
				if(isset($this->request->data["BOOK_ADDITION_HEADS"]) && $this->request->data["BOOK_ADDITION_HEADS"] != "")
				{
					$REQ_BOOK_ADDITION_HEADS = $this->request->data["BOOK_ADDITION_HEADS"];					
					foreach($REQ_BOOK_ADDITION_HEADS as $BK_AH_KEY=>$BK_AH_VAL)
					{
						if($BK_AH_VAL=="")
						{
							$BK_AH_VAL="N/A";
						}
							$BK_AH_STR .= $BK_AH_VAL."||";
					}
					$BK_AH_STR = rtrim($BK_AH_STR,"||");					
				}
				$this->AccountBankReconciliationStatement->saveField("BOOK_ADDITION_HEADS",$BK_AH_STR);
				
				$BK_AA_STR = "";
				$BK_AA_TA = 0;
				if(isset($this->request->data["BOOK_ADDITION_AMOUNTS"]) && $this->request->data["BOOK_ADDITION_AMOUNTS"] != "")
				{
					$REQ_BOOK_ADDITION_AMOUNTS = $this->request->data["BOOK_ADDITION_AMOUNTS"];					
					foreach($REQ_BOOK_ADDITION_AMOUNTS as $BK_AA_KEY=>$BK_AA_VAL)
					{
						if($BK_AA_VAL=="")
						{
							$BK_AA_VAL="0";
						}
							$BK_AA_TA += $BK_AA_VAL;
							$BK_AA_STR .= $BK_AA_VAL."||";
					}
					$BK_AA_STR = rtrim($BK_AA_STR,"||");
				}
				$this->AccountBankReconciliationStatement->saveField("BOOK_ADDITION_AMOUNTS",$BK_AA_STR);
				
				$BK_DH_STR = "";
				if(isset($this->request->data["BOOK_DEDUCTION_HEADS"]) && $this->request->data["BOOK_DEDUCTION_HEADS"] != "")
				{
					$REQ_BOOK_DEDUCTION_HEADS = $this->request->data["BOOK_DEDUCTION_HEADS"];					
					foreach($REQ_BOOK_DEDUCTION_HEADS as $BK_DH_KEY=>$BK_DH_VAL)
					{
						if($BK_DH_VAL=="")
						{
							$BK_DH_VAL="N/A";
						}
							$BK_DH_STR .= $BK_DH_VAL."||";
					}
					$BK_DH_STR = rtrim($BK_DH_STR,"||");
				}
				$this->AccountBankReconciliationStatement->saveField("BOOK_DEDUCTION_HEADS",$BK_DH_STR);
				
				$BK_DA_STR = "";
				$BK_DA_TA = 0;
				if(isset($this->request->data["BOOK_DEDUCTION_AMOUNTS"]) && $this->request->data["BOOK_DEDUCTION_AMOUNTS"] != "")
				{
					$REQ_BOOK_DEDUCTION_AMOUNTS = $this->request->data["BOOK_DEDUCTION_AMOUNTS"];					
					foreach($REQ_BOOK_DEDUCTION_AMOUNTS as $BK_DA_KEY=>$BK_DA_VAL)
					{
						if($BK_DA_VAL=="")
						{
							$BK_DA_VAL="0";
						}
							$BK_DA_TA += $BK_DA_VAL;
							$BK_DA_STR .= $BK_DA_VAL."||";
					}
					$BK_DA_STR = rtrim($BK_DA_STR,"||");
				}
				$this->AccountBankReconciliationStatement->saveField("BOOK_DEDUCTION_AMOUNTS",$BK_DA_STR);
				
				$ADJUSTED_BALANCE_BOOK = $REQ_BALANCE_BOOK + ($BK_AA_TA - $BK_DA_TA);
				$this->AccountBankReconciliationStatement->saveField("ADJUSTED_BALANCE_BOOK",$ADJUSTED_BALANCE_BOOK);
				
                if ($this->AccountBankReconciliationStatement->save($this->request->data)) {
                    $this->Session->setFlash('Bank Reconciliation Statement Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Bank Reconciliation Statement Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Bank Reconciliation Statement Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $AccountBankReconciliationStatements = $this->AccountBankReconciliationStatement->find('first', array(
                'contain' => array(),
                'conditions' => array('ACCOUNT_BANK_RECONCILIATION_STAT_ID' => $id)
            ));
			
			
			//print_r($AccountBankReconciliationStatements);die;
            if(empty($AccountBankReconciliationStatements)) {
                $this->Session->setFlash('Invalid Bank Reconciliation Statement!', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
			
			if(isset($AccountBankReconciliationStatements['AccountBankReconciliationStatement']['DATE']) && $AccountBankReconciliationStatements['AccountBankReconciliationStatement']['DATE']!="")
			{
				$AccountBankReconciliationStatements['AccountBankReconciliationStatement']['DATE'] = Date('d/m/Y',strtotime($AccountBankReconciliationStatements['AccountBankReconciliationStatement']['DATE']));
			}
			else
			{
				$AccountBankReconciliationStatements['AccountBankReconciliationStatement']['DATE'] = "";
			}
			
            $this->request->data = $AccountBankReconciliationStatements;			
        }
	}
	
	
	 public function admin_delete($Id = null)
    {
        $this->layout = 'admin_form_layout';
        if (!empty($Id)) {
            try {
				
				$AccountBankReconciliationStatementData = $this->AccountBankReconciliationStatement->find('first', array(
					'contain' => array(),
					'conditions' => array('ACCOUNT_BANK_RECONCILIATION_STAT_ID' => $Id)
				));

				$fileName = $AccountBankReconciliationStatementData['AccountBankReconciliationStatement']['BANK_STATEMENT_DOCUMENT'];
				
                if ($this->AccountBankReconciliationStatement->delete($Id)) {
					
					$path = UPLOADURL.UPLOAD_BANK_STAT_DOC;
					$this->General->delete_file($path.$fileName);
					
                    $this->Session->setFlash('Bank Reconciliation Statement Deleted Successfully', 'message_good');
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
            $this->Session->setFlash('Invalid Bank Reconciliation Statement!', 'message_bad');
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
		
		$this->set('school',null);				
		$this->set('disp_req_date',null);
		$this->set('req_date',null);
		/*$this->set('req_acc_dept',null);
		$this->set('req_acc_name_no',null);*/
		
		if ($this->request->is('post')) {
						
            $this->AccountBankReconciliationStatement->set($this->request->data);

			/*echo "<pre>";
			print_r($_POST);
			print_r($this->AccountBankReconciliationStatement);
			die;*/
			
            if ($this->AccountBankReconciliationStatement->Validation()) {
                $this->AccountBankReconciliationStatement->create();
							
				if(isset($this->request->data["AccountBankReconciliationStatement"]["DATE"]) && $this->request->data["AccountBankReconciliationStatement"]["DATE"] != "")
				{	
					$disp_req_date = Date('F d, Y',strtotime($this->General->datefordb($this->request->data["AccountBankReconciliationStatement"]["DATE"])));
					$this->request->data["AccountBankReconciliationStatement"]["DATE"] = $this->General->datefordb($this->request->data["AccountBankReconciliationStatement"]["DATE"]);
					$req_date = $this->request->data["AccountBankReconciliationStatement"]["DATE"];					
				}
				else
				{
					$disp_req_date = "";
					$this->request->data["AccountBankReconciliationStatement"]["DATE"] = "";
					$req_date = "";					
				}
				
				$req_acc_dept = $this->request->data["AccountBankReconciliationStatement"]["ACCOUNT_DEPARTMENT_ID"];
				$req_acc_name_no = $this->request->data["AccountBankReconciliationStatement"]["ACCOUNT_NAME_ID"];
				
				$this->loadModel('School');
				$result_scl = $this->School->GetSchoolDetail();
				$this->set('school',$result_scl);
				
				$this->loadModel('AccountName');
				$result_ann = $this->AccountName->GetAccountNameNoByDeptId($req_acc_dept);
				$this->set('account_names', $result_ann);
				
				$result = $this->AccountBankReconciliationStatement->GetABRSByDateHeadSubHead($req_date,$req_acc_dept,$req_acc_name_no);				
				$this->set('data', $result);
				
				if(!empty($result))
				{
				$BANK_ADDITION_HEADS=$result['AccountBankReconciliationStatement']['BANK_ADDITION_HEADS'];
				$BANK_ADDITION_HEADS_ARR = array();
				if(isset($BANK_ADDITION_HEADS) && $BANK_ADDITION_HEADS != "")
				{			
					$BANK_ADDITION_HEADS_ARR = explode("||",$BANK_ADDITION_HEADS);			
				}
				$this->set('BANK_ADDITION_HEADS_ARR', $BANK_ADDITION_HEADS_ARR);
				$BANK_ADDITION_HEADS_CNT = count($BANK_ADDITION_HEADS_ARR);
				$this->set('BANK_ADDITION_HEADS_CNT', $BANK_ADDITION_HEADS_CNT);
				$this->set('BANK_ADDITION_HEADS_FV', $BANK_ADDITION_HEADS_ARR[0]);
				
				$BANK_ADDITION_AMOUNTS=$result['AccountBankReconciliationStatement']['BANK_ADDITION_AMOUNTS'];
				$BANK_ADDITION_AMOUNTS_ARR = array();
				if(isset($BANK_ADDITION_AMOUNTS) && $BANK_ADDITION_AMOUNTS != "")
				{
					$BANK_ADDITION_AMOUNTS_ARR = explode("||",$BANK_ADDITION_AMOUNTS);			
				}
				$this->set('BANK_ADDITION_AMOUNTS_ARR', $BANK_ADDITION_AMOUNTS_ARR);
				$BANK_ADDITION_AMOUNTS_CNT = count($BANK_ADDITION_AMOUNTS_ARR);
				$this->set('BANK_ADDITION_AMOUNTS_CNT', $BANK_ADDITION_AMOUNTS_CNT);
				$this->set('BANK_ADDITION_AMOUNTS_FV', $BANK_ADDITION_AMOUNTS_ARR[0]);
				
				$BANK_DEDUCTION_HEADS=$result['AccountBankReconciliationStatement']['BANK_DEDUCTION_HEADS'];
				$BANK_DEDUCTION_HEADS_ARR = array();
				if(isset($BANK_DEDUCTION_HEADS) && $BANK_DEDUCTION_HEADS != "")
				{
					$BANK_DEDUCTION_HEADS_ARR = explode("||",$BANK_DEDUCTION_HEADS);			
				}
				$this->set('BANK_DEDUCTION_HEADS_ARR', $BANK_DEDUCTION_HEADS_ARR);
				$BANK_DEDUCTION_HEADS_CNT = count($BANK_DEDUCTION_HEADS_ARR);
				$this->set('BANK_DEDUCTION_HEADS_CNT', $BANK_DEDUCTION_HEADS_CNT);
				$this->set('BANK_DEDUCTION_HEADS_FV', $BANK_DEDUCTION_HEADS_ARR[0]);
				
				$BANK_DEDUCTION_AMOUNTS=$result['AccountBankReconciliationStatement']['BANK_DEDUCTION_AMOUNTS'];
				$BANK_DEDUCTION_AMOUNTS_ARR = array();
				if(isset($BANK_DEDUCTION_AMOUNTS) && $BANK_DEDUCTION_AMOUNTS != "")
				{
					$BANK_DEDUCTION_AMOUNTS_ARR = explode("||",$BANK_DEDUCTION_AMOUNTS);			
				}
				$this->set('BANK_DEDUCTION_AMOUNTS_ARR', $BANK_DEDUCTION_AMOUNTS_ARR);
				$BANK_DEDUCTION_AMOUNTS_CNT = count($BANK_DEDUCTION_AMOUNTS_ARR);
				$this->set('BANK_DEDUCTION_AMOUNTS_CNT', $BANK_DEDUCTION_AMOUNTS_CNT);
				$this->set('BANK_DEDUCTION_AMOUNTS_FV', $BANK_DEDUCTION_AMOUNTS_ARR[0]);
				
				/***************************************************************/
				
				$BOOK_ADDITION_HEADS=$result['AccountBankReconciliationStatement']['BOOK_ADDITION_HEADS'];
				$BOOK_ADDITION_HEADS_ARR = array();
				if(isset($BOOK_ADDITION_HEADS) && $BOOK_ADDITION_HEADS != "")
				{
					$BOOK_ADDITION_HEADS_ARR = explode("||",$BOOK_ADDITION_HEADS);			
				}
				$this->set('BOOK_ADDITION_HEADS_ARR', $BOOK_ADDITION_HEADS_ARR);
				$BOOK_ADDITION_HEADS_CNT = count($BOOK_ADDITION_HEADS_ARR);
				$this->set('BOOK_ADDITION_HEADS_CNT', $BOOK_ADDITION_HEADS_CNT);
				$this->set('BOOK_ADDITION_HEADS_FV', $BOOK_ADDITION_HEADS_ARR[0]);
				
				$BOOK_ADDITION_AMOUNTS=$result['AccountBankReconciliationStatement']['BOOK_ADDITION_AMOUNTS'];
				$BOOK_ADDITION_AMOUNTS_ARR = array();
				if(isset($BOOK_ADDITION_AMOUNTS) && $BOOK_ADDITION_AMOUNTS != "")
				{
					$BOOK_ADDITION_AMOUNTS_ARR = explode("||",$BOOK_ADDITION_AMOUNTS);			
				}
				$this->set('BOOK_ADDITION_AMOUNTS_ARR', $BOOK_ADDITION_AMOUNTS_ARR);
				$BOOK_ADDITION_AMOUNTS_CNT = count($BOOK_ADDITION_AMOUNTS_ARR);
				$this->set('BOOK_ADDITION_AMOUNTS_CNT', $BOOK_ADDITION_AMOUNTS_CNT);
				$this->set('BOOK_ADDITION_AMOUNTS_FV', $BOOK_ADDITION_AMOUNTS_ARR[0]);
				
				$BOOK_DEDUCTION_HEADS=$result['AccountBankReconciliationStatement']['BOOK_DEDUCTION_HEADS'];
				$BOOK_DEDUCTION_HEADS_ARR = array();
				if(isset($BOOK_DEDUCTION_HEADS) && $BOOK_DEDUCTION_HEADS != "")
				{
					$BOOK_DEDUCTION_HEADS_ARR = explode("||",$BOOK_DEDUCTION_HEADS);			
				}
				$this->set('BOOK_DEDUCTION_HEADS_ARR', $BOOK_DEDUCTION_HEADS_ARR);
				$BOOK_DEDUCTION_HEADS_CNT = count($BOOK_DEDUCTION_HEADS_ARR);
				$this->set('BOOK_DEDUCTION_HEADS_CNT', $BOOK_DEDUCTION_HEADS_CNT);
				$this->set('BOOK_DEDUCTION_HEADS_FV', $BOOK_DEDUCTION_HEADS_ARR[0]);
				
				$BOOK_DEDUCTION_AMOUNTS=$result['AccountBankReconciliationStatement']['BOOK_DEDUCTION_AMOUNTS'];
				$BOOK_DEDUCTION_AMOUNTS_ARR = array();
				if(isset($BOOK_DEDUCTION_AMOUNTS) && $BOOK_DEDUCTION_AMOUNTS != "")
				{
					$BOOK_DEDUCTION_AMOUNTS_ARR = explode("||",$BOOK_DEDUCTION_AMOUNTS);			
				}
				$this->set('BOOK_DEDUCTION_AMOUNTS_ARR', $BOOK_DEDUCTION_AMOUNTS_ARR);
				$BOOK_DEDUCTION_AMOUNTS_CNT = count($BOOK_DEDUCTION_AMOUNTS_ARR);
				$this->set('BOOK_DEDUCTION_AMOUNTS_CNT', $BOOK_DEDUCTION_AMOUNTS_CNT);
				$this->set('BOOK_DEDUCTION_AMOUNTS_FV', $BOOK_DEDUCTION_AMOUNTS_ARR[0]);
				}
				
				$this->set('req_date',$req_date);
				
				$this->set('disp_req_date',$disp_req_date);
				
				if(isset($this->request->data["AccountBankReconciliationStatement"]["DATE"]) && $this->request->data["AccountBankReconciliationStatement"]["DATE"] != "")
				{	
					$disp_req_date = Date('d/m/Y',strtotime($this->General->datefordb($this->request->data["AccountBankReconciliationStatement"]["DATE"])));
					$this->request->data["AccountBankReconciliationStatement"]["DATE"] = $disp_req_date;
					$req_date = $this->request->data["AccountBankReconciliationStatement"]["DATE"];					
				}
				else
				{
					$disp_req_date = "";
					$this->request->data["AccountBankReconciliationStatement"]["DATE"] = "";
					$req_date = "";										
				}
				
				if(empty($result))
				{
					$this->Session->setFlash('Bank Reconciliation Statement Not Found!', 'message_bad');
				}				
				
            } else {
                $this->Session->setFlash('Bank Reconciliation Statement Not Found!', 'message_bad');
            }
        }
		
		/*$this->loadModel('AccountBalanceSheetHead');
		$result = $this->AccountBalanceSheetHead->GetAccountBalanceSheetHead();
		$this->set('account_balance_sheet_heads', $result);*/
		
	}
	

	public function admin_ajax_getAccountNamesbyDept(){
		
		$id=$this->request->data['id'];
		
		$this->loadModel('AccountName');
		$result = $this->AccountName->GetAccountNameNoByDeptId($id);
		//$this->set('account_names', $result);

		App::uses('FormHelper', 'View/Helper');
		$this->Form = new FormHelper(new View());
		
		echo $this->Form->input('AccountBankReconciliationStatement][ACCOUNT_NAME_ID]', array('options' => $result,
		'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control select2me' , 'onchange' => 'select()' ,'id'=>'role','onchange' => 'showOptions(this)'));
				  
	   exit();
	}

}	