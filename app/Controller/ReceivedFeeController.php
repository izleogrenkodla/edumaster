<?php
class ReceivedFeeController extends AppController
{
    var $name = 'ReceivedFee';

    public function beforeFilter()
    {
        parent::beforeFilter();

        $this->Auth->allow('App_TotalFees','App_TotalPaidFees','App_TotalRemainingFees');

        if(isset($this->Security) &&  ($this->RequestHandler->isAjax() || $this->RequestHandler->isPost())){
            $this->Security->validatePost = false;
            $this->Security->enabled = false;
            $this->Security->csrfCheck = false;
        }
    }
    
    public function admin_index()
    {
		$conditions = '';

   		$Session = $this->Session->read('Auth.Admin');
		$conditions = array('ReceivedFee.Status'=>1);

        $this->layout = 'admin_form_layout';
	
        $this->paginate = array(
            'conditions' => $conditions,
            'contain' => array('AcademicClass','Name'),
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'ReceivedFee.id DESC'
        );

        //$this->set('ReceivedFee', $this->paginate('ReceivedFee')); 
		$this->set('row', $this->paginate('ReceivedFee')); 
		
	}
	
	public function admin_add($id = null,$pkey = null)
    {
		 $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		if($Session_data["ROLE_ID"]!=SUPERVISOR_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}		
		
		if ($this->request->is('post')) 
		{
			$this->ReceivedFee->set($this->request->data);
			if ($this->ReceivedFee->Validation()) {

				$this->FeeDue = ClassRegistry::init('FeeDue');
				 $Fee = $this->FeeDue->find('first', array(
						'contain' => array('AcademicClass','Name','PaymentType'),
						'conditions' => array('FeeDue.USER_ID' => $id,'FeeDue.Status'=>1)
					));
				/*PR($Fee);
					//echo $Fee["FeeDue"]["Fees"];
					die;*/
				
						
				$this->FeeDue->id = $pkey;
				
				if($Fee["FeeDue"]["PaymentType"] == 1){
					$ptea = 'Monthly';
				}elseif($Fee["FeeDue"]["PaymentType"] == 2){
					$ptea = 'Quaterly';
				}elseif($Fee["FeeDue"]["PaymentType"] == 3){
					$ptea = 'Half Yearly';
				}elseif($Fee["FeeDue"]["PaymentType"] == 4){
					$ptea = 'Yearly';
				}
				
				
				if (empty($this->FeeDue->id)) {
					$this->Session->setFlash('Invalid Student !', 'message_bad');
					$this->redirect(array('action' => 'index'));
				}
				
				if ($this->request->is('put') || $this->request->is('post')) {
				  
						if ($this->FeeDue->set($this->request->data)) {
							$this->FeeDue->saveField('Status',0);
							//$this->FeeDue->saveField('Remaining',$rfee);
						} 
						
				} 
				
				$ReceivedFee['ReceivedFee'] = array(
							
							'RECEIVE_TYPE' => $this->request->data['ReceivedFee']['REC_TYPE'],
							'CLASS_ID' => $Fee["FeeDue"]["CLASS_ID"],
							'USER_ID' => $id,
							'TEARMS' => $Fee["FeeDue"]["PaymentType"],
							'FEES_AMT' => $Fee["FeeDue"]["Fees"],
							'FEE_MONTH' => $Fee["FeeDue"]["Month"],
							'LATE_FEES' => $this->request->data['ReceivedFee']['LATE_FEE'],
							'DISCOUNT' => $this->request->data["ReceivedFee"]["DISCOUNT"],
							'NET_AMT' => $this->request->data['TOTAL_FEE'],
							'ENTRY_DATE' => $this->General->datefordb($this->request->data['ReceivedFee']['FEE_DATE']),
							'OTHER_AMT'=> $this->request->data['ReceivedFee']['OTHER_AMOUNT'],
							'PAY_TYPE' => $this->request->data['ReceivedFee']['PAY_TYPE'],
							'STATUS' => 1,
							'PTEARMS' => $ptea,
							
						);
						

					$this->ReceivedFee->create();
					$this->ReceivedFee->save($ReceivedFee);
					
				$lastid = $this->ReceivedFee->getLastInsertId();	
		
				if($this->request->data['ReceivedFee']['PAY_TYPE'] == 1){
					
				}elseif($this->request->data['ReceivedFee']['PAY_TYPE'] == 2){
					$this->FeeCheck = ClassRegistry::init('FeeCheck');
					
					$FeeCheck['FeeCheck'] = array(
							'USER_ID' => $id,
							'REF_ID' => $lastid,
							'Bank_Name' => $this->request->data['Bank_Name'],
							'Ac_Name' => $this->request->data['Ac_Name'],
							'Ac_No' => $this->request->data['Ac_No'],
							'Branch' => $this->request->data['Branch'],
							'Cheque_No' => $this->request->data['Cheque_No'],
							'Cheque_Date' => $this->request->data["Cheque_Date"],
							'Amount' => $this->request->data['ReceivedFee']["AMOUNT"],
							'Entry_Date' => $this->General->datefordb($this->request->data["ReceivedFee"]["FEE_DATE"]),
							'Status' => 1,
						);
						

					$this->FeeCheck->create();
					$this->FeeCheck->save($FeeCheck);
					
				}elseif($this->request->data['ReceivedFee']['PAY_TYPE'] == 3){
					$this->FeeChalan = ClassRegistry::init('FeeChalan');
					
					$FeeChalan['FeeChalan'] = array(
						'REF_ID' => $lastid,
						'USER_ID' => $id,
						'TRANS_ID' => $this->request->data['TRANS_ID'],
						'CON_NO' => $this->request->data['CON_NO'],
						'TRANS_DATE' => $this->General->datefordb($this->request->data["TRANS_DATE"]),
						'AMOUNT' => $this->request->data['ReceivedFee']["AMOUNT"],
					);
					
					$this->FeeChalan->create();
					$this->FeeChalan->save($FeeChalan);
					
				}elseif($this->request->data['ReceivedFee']['PAY_TYPE'] == 4){
					$this->FeeDemandDraft = ClassRegistry::init('FeeDemandDraft');
					
						$FeeDemandDraft['FeeDemandDraft'] = array(
							'USER_ID' => $id,
							'REF_ID' => $lastid,
							'Bank_Name' => $this->request->data['Bank_Name'],
							'DD_No' => $this->request->data['DD_No'],
							'Branch' => $this->request->data['Branch'],
							'DD_Date' => $this->request->data["DD_Date"],
							'Entry_Date' => $this->General->datefordb($this->request->data["ReceivedFee"]["FEE_DATE"]),
							'Amount' => $this->request->data['ReceivedFee']["AMOUNT"],
						);
					
					$this->FeeDemandDraft->create();
					$this->FeeDemandDraft->save($FeeDemandDraft);
				}
					
				if($this->request->data['ReceivedFee']['REC_TYPE'] == 2)
				{
					$this->AdvanceFee = ClassRegistry::init('AdvanceFee');
					
					$AdvanceFee['AdvanceFee'] = array(
					
							'USER_ID' => $id,
							'CLASS_ID' => $Fee["FeeDue"]["CLASS_ID"],
							'TEARMS' => $Fee["FeeDue"]["PaymentType"],
							'FEES_AMT' => $Fee["FeeDue"]["Fees"],
							'LATE_FEES' => $this->request->data['ReceivedFee']['LATE_FEE'],
							'DISCOUNT' => $this->request->data["ReceivedFee"]["DISCOUNT"],
							'NET_AMT' => $this->request->data['TOTAL_FEE'],
							'ENTRY_DATE' => $this->General->datefordb($this->request->data['ReceivedFee']['FEE_DATE']),
							'OTHER_AMT'=> $this->request->data['ReceivedFee']['OTHER_AMOUNT'],
							'PAY_TYPE' => $this->request->data['ReceivedFee']['PAY_TYPE'],
							'STATUS' => 1,
							'PTEARMS'=> $ptea,
							
							/*'RECEIVE_TYPE' => $this->request->data['ReceivedFee']['REC_TYPE'],
							'FEE_MONTH' => $Fee["FeeDue"]["Month"],*/

						);
						

					$this->AdvanceFee->create();
					$this->AdvanceFee->save($AdvanceFee);
					
				}
				
				
				$this->StudentLedger = ClassRegistry::init('StudentLedger');
				
				$rec = $this->StudentLedger->find('first', array(
						'contain' => array(),
						'conditions' => array('StudentLedger.USER_ID' => $id)
					));
					
				$pkey = $rec['StudentLedger']['LEDGER_ID'];	
				
				$this->StudentLedger->id = $pkey;
				
				if (empty($this->StudentLedger->id)) {
					$this->Session->setFlash('Invalid Student !', 'message_bad');
					$this->redirect(array('action' => 'index'));
				}
				
				 $rec = $this->StudentLedger->find('first', array(
						'contain' => array(),
						'conditions' => array('StudentLedger.USER_ID' => $id)
					));
					
					$pfee = $rec['StudentLedger']['Paid_Fees'];
					$rfee = $rec['StudentLedger']['Remaining'];
					
					$paid = $pfee +  $this->request->data['ReceivedFee']["AMOUNT"];
					$rem = $rfee -  $this->request->data['ReceivedFee']["AMOUNT"];
					
				if ($this->request->is('put') || $this->request->is('post')) {
				  
						if ($this->StudentLedger->set($this->request->data)) {
							$this->StudentLedger->saveField('Paid_Fees',$paid);
							$this->StudentLedger->saveField('Remaining',$rem);
						} 	
				} 
				
				$this->Session->setFlash('Fee Received Successfully!', 'message_good');
				$this->redirect(array('controller' => 'ReceivedFee', 'action' => 'list'));

			} else {
                $this->Session->setFlash('Fee Not Added Please Try Again!', 'message_bad');
            }
			
		
		}
			
			$this->FeeDue = ClassRegistry::init('FeeDue');
			 $Fee = $this->FeeDue->find('first', array(
					'contain' => array('AcademicClass','Name','PaymentType'),
					'conditions' => array('FeeDue.USER_ID' => $id,'FeeDue.Status'=>1)
				));
				
			$this->set('ro', $Fee);
	}
	public function admin_getfee(){
		$amt = $this->request->data["amt"];
		$late = $this->request->data["late_fee"];
		$discount = $this->request->data["discount"];
		$other = $this->request->data["other"];
		
		$totalfee = $amt+$late-$discount+$other;
		
		echo  "
			<div class='col-md-6'>
						<div class='form-group' >
						<label class='control-label col-md-3'>Net Fee<span class=required>
											* </span></label><div class='col-md-9'>
						<input type='text' name='TOTAL_FEE' value='$totalfee' class='form-control' readonly/>
						</div></div></div>";
		die;
	}
	
	
	public function admin_getfill(){
		
		$by = $this->request->data["id"];
		
		if($by == 1){
			
		}elseif($by == 2){
			
			echo  "
			<div class='col-md-6'>
						<div class='form-group' >
						<label class='control-label col-md-3'>Bank Name<span class=required>
											* </span></label><div class='col-md-9'>
						<input type='text' name='Bank_Name' class='form-control'/>
						</div></div></div>
						
			<div class='col-md-6'>
						<div class='form-group' >
						<label class='control-label col-md-3'>Account Number<span class=required>
											* </span></label><div class='col-md-9'>
						<input type='text' name='Ac_Name' class='form-control'/>
						</div></div></div>

			<div class='col-md-6'>
						<div class='form-group' >
						<label class='control-label col-md-3'>Account Name<span class=required>
											* </span></label><div class='col-md-9'>
						<input type='text' name='Ac_No' class='form-control'/>
						</div></div></div>
						
			<div class='col-md-6'>
						<div class='form-group' >
						<label class='control-label col-md-3'>Branch<span class=required>
											* </span></label><div class='col-md-9'>
						<input type='text' name='Branch' class='form-control'/>
						</div></div></div>
						
			<div class='col-md-6'>
						<div class='form-group' >
						<label class='control-label col-md-3'>Cheque NO<span class=required>
											* </span></label><div class='col-md-9'>
						<input type='text' name='Cheque_No' class='form-control'/>
						</div></div></div>	
						
			<div class='col-md-6'>
						<div class='form-group' >
						<label class='control-label col-md-3'>Cheque Date<span class=required>
											* </span></label><div class='col-md-9'>
						<input type='date' name='Cheque_Date' class='form-control'/>
						</div></div></div>
						
					";
			
			
		}elseif($by == 3){
			echo  "
			<div class='col-md-6'>
						<div class='form-group' >
						<label class='control-label col-md-3'>Transaction Number<span class=required>
											* </span></label><div class='col-md-9'>
						<input type='text' name='TRANS_ID' class='form-control'/>
						</div></div></div>
						
			<div class='col-md-6'>
						<div class='form-group' >
						<label class='control-label col-md-3'>Contact Number<span class=required>
											* </span></label><div class='col-md-9'>
						<input type='text' name='CON_NO' class='form-control'/>
						</div></div></div>
			
			<div class='col-md-6'>
						<div class='form-group' >
						<label class='control-label col-md-3'>Transaction Date<span class=required>
											* </span></label><div class='col-md-9'>
						<input type='date' name='TRANS_DATE' class='form-control'/>
						</div></div></div>";
		}elseif($by == 4){
			echo  "
			<div class='col-md-6'>
						<div class='form-group' >
						<label class='control-label col-md-3'>Bank Name<span class=required>
											* </span></label><div class='col-md-9'>
						<input type='text' name='Bank_Name' class='form-control'/>
						</div></div></div>
						
			<div class='col-md-6'>
						<div class='form-group' >
						<label class='control-label col-md-3'>DD Number<span class=required>
											* </span></label><div class='col-md-9'>
						<input type='text' name='DD_No' class='form-control'/>
						</div></div></div>
						
						
			<div class='col-md-6'>
						<div class='form-group' >
						<label class='control-label col-md-3'>Branch<span class=required>
											* </span></label><div class='col-md-9'>
						<input type='text' name='Branch' class='form-control'/>
						</div></div></div>
						
			<div class='col-md-6'>
						<div class='form-group' >
						<label class='control-label col-md-3'>DD Date<span class=required>
											* </span></label><div class='col-md-9'>
						<input type='date' name='DD_Date' class='form-control'/>
						</div></div></div>
						
					";
		}
		
		die;
		
	}
	
	public function admin_list(){
		
		 $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		/*if((isset($id)) && ($id)>0)
			{
				$conditions['ReceivedFee.USER_ID'] = $id;
				//$conditions['ReceivedFee.OLD_ROLE_ID'] = $rdata['User']['ROLE_ID'];
			}*/
		
		$Fee = $this->ReceivedFee->find('all', array(
					'contain' => array('AcademicClass','Name'),
					//'conditions' => $conditions,
				));
				
			$this->set('row', $Fee);
	}
	
	public function admin_view($id = null){
		$this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		$conditions['ReceivedFee.id'] = $id;
		
		$Fee = $this->ReceivedFee->find('first', array(
					'contain' => array('AcademicClass','Name','MonthDistribution'),
					'conditions' => $conditions,
				));
		if($Fee['ReceivedFee']['PAY_TYPE'] == 1){
		$by = array();
		}elseif($Fee['ReceivedFee']['PAY_TYPE'] == 2){
		$this->FeeCheck = ClassRegistry::init('FeeCheck');
		$by = $this->FeeCheck->find('first', array(
		'contain' => array(),
		'conditions' => array('REF_ID',$id)
		));
		}elseif($Fee['ReceivedFee']['PAY_TYPE'] == 3){
		$this->FeeChalan = ClassRegistry::init('FeeChalan');
		$by = $this->FeeChalan->find('first', array(
		'contain' => array(),
		'conditions' => array('REF_ID',$id)
		));
		}elseif($Fee['ReceivedFee']['PAY_TYPE'] == 4){
		$this->FeeDemandDraft = ClassRegistry::init('FeeDemandDraft');
		$by = $this->FeeDemandDraft->find('first', array(
		'contain' => array(),
		'conditions' => array('REF_ID',$id)
		));
		}

		$this->set('by', $by);
	
		$this->set('Fee', $Fee);
		
	}
}
?>