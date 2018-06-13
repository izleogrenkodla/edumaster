<?php
class AllowanceController extends AppController
{ 
    var $name = 'Allowance';

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
	
	
	public function admin_index(){
		
		if(isset($this->params->query["CLS"])) {
            $conditions["Allowance.ALLOWANCE_TYPE"] = $this->params->query["CLS"];
            $this->request->data["Allowance"]["CLS"] = $this->params->query["CLS"];
        }
		
		  $this->layout = 'admin_form_layout';
          $this->Allowance->recursive = 0;
          $this->paginate = array(
            'conditions' =>  $conditions,
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'Allowance.ALLOWANCE_ID ASC'
        );

        $this->set('Allowance', $this->paginate('Allowance'));	
		}
		
	public function admin_add(){
	 $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('post')) {
            $this->Allowance->set($this->request->data);
            if ($this->Allowance->Validation()) {
                $this->Allowance->create();
				/*PR($this->request->data);
				die;*/
                if ($this->Allowance->save($this->request->data)) {
					
					if($this->request->data['AMOUNT'])
					{
						$this->Allowance->saveField("AMOUNT",$this->request->data['AMOUNT']);
					}else{
						$this->Allowance->saveField("PERCENTAGE",$this->request->data['PERCENTAGE']);
					}
					$this->request->data['Allowance']['USER_ID'] = $Session_data['ID'];
					$this->Allowance->saveField("created_by",$Session_data['ID']);
					
					$ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
					$this->Allowance->saveField("created_ip",$ip);
					
					
					
                    $this->Session->setFlash('Allowance Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
                } else {
                $this->Session->setFlash('Allowance Not Added Please Try Again!', 'message_bad');
                }
        }
		
		
		$by = array('0'=>'Select By','1'=>'Percentage','2'=>'Amount');
		$this->set('by',$by);
	}
	
	public function admin_GetBox(){

       $by = $this->request->data["id"];
		
   		if($by == 1)
		{
			echo  "<div class='col-md-6' id='PERCENTAGE'>
						<div class='form-group' >
						<label class='control-label col-md-3'>PERCENTAGE</label><div class='col-md-9'><input type='text' name='PERCENTAGE' class='form-control' />
						</div></div></div>";	
		}else{
			echo  "<div class='col-md-6' id='AMOUNT'>
						<div class='form-group' >
						<label class='control-label col-md-3'>AMOUNT</label><div class='col-md-9'><input type='text' name='AMOUNT' class='form-control' />
						</div></div></div>";	
		}
		//return($box);
   die;
	}
	
	 public function admin_delete($Id = null)
    {
      
        $this->layout = 'admin_form_layout';
        if (!empty($Id)) {
				$this->Allowance->id = $Id;
            try {
                 if ($this->Allowance->delete($Id)) {
                    $this->Session->setFlash('Allowance is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid Allowance.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
    }
	 public function admin_edit($Id = null)
    {
		
	
		$this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        $this->Allowance->id = $Id;
        if (empty($this->Allowance->id)) {
            $this->Session->setFlash('Invalid Allowance !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->Allowance->Validation()) {
				
				
                if ($this->Allowance->save($this->request->data)) {
					
					if($this->request->data['AMOUNT'])
					{
						$this->Allowance->saveField("AMOUNT",$this->request->data['Allowance']['AMOUNT']);
					}else{
						
						$this->Allowance->saveField("PERCENTAGE",$this->request->data['Allowance']['PERCENTAGE']);
					}
					
                    $this->Session->setFlash('Allowance Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Allowance Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Allowance Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $Allowance = $this->Allowance->find('first', array(
                'contain' => array(),
                'conditions' => array('ALLOWANCE_ID' => $Id) 
            ));
			
			
            if(empty($Allowance)) {
                $this->Session->setFlash('Invalid Allowance !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $Allowance;
        }
		if($Allowance['Allowance']['AMOUNT']>0){
			$am = $Allowance['Allowance']['AMOUNT'];
			$lb = 'AMOUNT';
			//echo $amount;
		}else{
			$am = $Allowance['Allowance']['PERCENTAGE'];
			$lb = 'PERCENTAGE';
			//echo $per;
		}
		
		$this->set('am',$am);
		$this->set('lb',$lb);
		
		$by = array('0'=>'Select By','1'=>'Percentage','2'=>'Amount');
		$this->set('by',$by);
	}
	
	
	
}
?>