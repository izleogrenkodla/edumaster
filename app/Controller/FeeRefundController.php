<?php
class FeeRefundController extends AppController
{
    var $name = 'FeeRefund';

    public function beforeFilter()
    {
        parent::beforeFilter();

        $this->Auth->allow('');

        if(isset($this->Security) &&  ($this->RequestHandler->isAjax() || $this->RequestHandler->isPost())){
            $this->Security->validatePost = false;
            $this->Security->enabled = false;
            $this->Security->csrfCheck = false;
        }
    }
    
    public function admin_index()
    {
		$conditions = '';
		
		$this->Users = ClassRegistry::init('Users');
		
   		$Session = $this->Session->read('Auth.Admin');
		//$conditions = array('StudentLedger.Status'=>1);
		
			if(isset($this->params->query["CLS"]) && ($this->params->query["CLS"]>0)) {
            $conditions["FeeChalan.CLASS_ID"] = $this->params->query["CLS"];
            $this->request->data["FeeRefund"]["CLS"] = $this->params->query["CLS"];
        }
		
		$conditions["User.ROLE_ID"] = 5;
		$conditions["User.STATUS"] = 1;
		
        $this->layout = 'admin_form_layout';
	
        $Content = $this->User->find('all', array(
               'contain' => array('AcademicClass','Medium'),
               'conditions' => $conditions,
			   'fields' => array('ID','FIRST_NAME','MIDDLE_NAME','LAST_NAME','GR_NO','USERNAME','MEDIUM_ID','CLASS_ID'),
            ));

        $this->set('Users', $Content); 
		
		/*$classes = $this->FeeCheck->AcademicClass->GetAcademicClasses();
        $this->set('classes', $classes);*/
	}
	
	public function admin_add($id = null){
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
			
			$this->Users = ClassRegistry::init('Users');
			 $Fee = $this->Users->find('first', array(
					'contain' => array(),
					'conditions' => array('Users.ID' => $id)
				));
				
			$this->set('ro', $Fee);
			

			$this->ReceivedFee = ClassRegistry::init('ReceivedFee');
			$abc = $this->ReceivedFee->find('all', array(
					'contain' => array(),
					'conditions' => array('ReceivedFee.USER_ID' => $id)
				));
				
				
			foreach($abc  as $key=>$value){				
				$te[$key] = $value['ReceivedFee']['PTEARMS'];

			}
			
			
			
			$this->set('te', $te);
			
			 $totfee = $this->ReceivedFee->find('all', array(
					'contain' => array(),
					'conditions' => array('ReceivedFee.USER_ID' => $id)
				));
				
				
				
				
				
			$tfee = 0;	
			foreach($totfee as $key=>$value){
				
				$tfee = $value['ReceivedFee']['FEES_AMT'] + $tfee; 
			}

			
			$this->set('rec_fee', $tfee);
			
			foreach($totfee as $key=>$value){
				
				$tifee[$key] = $value['ReceivedFee']['id'];
				
			}
	
			$this->set('ti_fee', $tifee);
			
			
			if ($this->request->is('post')) 
			{
			
				$this->FeeRefund->set($this->request->data);
				if ($this->FeeRefund->Validation()) {
				
					$FeeRefund['FeeRefund'] = array(
							'USER_ID' => $id,
							'CLASS_ID' => $Fee["Users"]["CLASS_ID"],
							'TOTAL_REC_FEE' => $tfee,
							'REFUND_FEE' => $this->request->data['REFUND_FEE'],
							'REMARK' => $this->request->data['FeeRefund']['REMARK'],
							'REFUND_DATE' => $this->General->datefordb($this->request->data['FeeRefund']['REF_DATE']),
							'STATUS' => 1,
						);
						

					$this->FeeRefund->create();
					$this->FeeRefund->save($FeeRefund);
				
				}
				
				$this->Session->setFlash('Fee Refund Successfully!', 'message_good');
				$this->redirect(array('controller' => 'FeeRefund', 'action' => 'list'));
			}	
			
			
			
			
			 /*$classes = $this->FeeRefund->AcademicClass->GetAcademicClasses();
			 $this->set('classes', $classes);*/
			
	}
	
	
	public function admin_Getfee(){
			$pk =  $this->request->data["id"];
			$rfee = $this->request->data["r_fee"];
	
			$this->ReceivedFee = ClassRegistry::init('ReceivedFee');
			$amount = $this->ReceivedFee->find('first', array(
						'contain' => array(),
						'conditions' => array('ReceivedFee.id' => $pk)
					));
					
			$tot_fee = $amount['ReceivedFee']['FEES_AMT'] + $rfee;
			
				echo  "
				<div class='col-md-6'>
							<div class='form-group' >
							<label class='control-label col-md-3'>REFUND AMOUNT<span class=required>
												* </span></label><div class='col-md-9'>
							<input type='text' name='REFUND_FEE' value='$tot_fee' class='form-control' id='FeeRefundREFUNDFEE' readonly/>
							</div></div></div>";
	
			die;
		}	 
	
		public function admin_Getfeeuncheck(){
			$pk =  $this->request->data["id"];
			$rfee = $this->request->data["r_fee"];
		
			$this->ReceivedFee = ClassRegistry::init('ReceivedFee');
			$amount = $this->ReceivedFee->find('first', array(
						'contain' => array(),
						'conditions' => array('ReceivedFee.id' => $pk)
					));
					
			$tot_fee = $rfee -$amount['ReceivedFee']['FEES_AMT'];
			
				echo  "
				<div class='col-md-6'>
							<div class='form-group' >
							<label class='control-label col-md-3'>REFUND AMOUNT<span class=required>
												* </span></label><div class='col-md-9'>
							<input type='text' name='REFUND_FEE' value='$tot_fee' class='form-control' id='FeeRefundREFUNDFEE' readonly/>
							</div></div></div>";
	
			die;
		} 
	
	
	public function admin_list()
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

		
			$FeeRefund = $this->FeeRefund->find('all', array(
                'contain' => array('AcademicClass','Name'),
                //'conditions' => array('FeeRefund.id' => $id)
            ));
           
            $this->set('FeeRefund',$FeeRefund);
    }
	
}
?>