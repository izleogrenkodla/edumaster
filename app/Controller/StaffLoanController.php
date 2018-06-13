<?php
class StaffLoanController extends AppController
{ 
    var $name = 'StaffLoan';

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
		 $this->layout = 'admin_form_layout';
		 $this->StaffLoan->recursive = 0;
	   	$this->paginate = array(
            'conditions' => '',
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'StaffLoan.LOAN_ID ASC'
        );

        $this->set('StaffLoan', $this->paginate('StaffLoan'));
	}
	
	public function admin_delete($id = null)
    {
		 $this->layout = 'admin_form_layout';
		 
		$Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		if($Session_data["ROLE_ID"]!=HR_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}
		 
		 $data = $this->StaffLoan->find('first', array(
            'contain' => array(),
            'conditions' => array('LOAN_ID' => $id)
        ));
		
		$loan_amt = $data['StaffLoan']['LOAN_AMOUNT'];
		$userid = $data['StaffLoan']['USER_ID'];
		
		 $this->Outstanding = ClassRegistry::init('Outstanding');
		 
		 $out = $this->Outstanding->find('first', array(
            'contain' => array(),
            'conditions' => array('USER_ID' => $userid)
        ));
		
		$outamount = $out['Outstanding']['OUTSTANDING_AMOUNT'] - $loan_amt;
		$ramount = $out['Outstanding']['REMAINING_AMOUNT'] - $loan_amt;
		$outid = $out['Outstanding']['OUT_ID'];
		
		
		$this->Outstanding->id = $outid;
        if (empty($this->Outstanding->id)) {
            $this->Session->setFlash('Invalid Outstanding !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }else{
			
			 if (($this->Outstanding->id = $outid)>0) {
          
               
					$this->Outstanding->saveField('OUTSTANDING_AMOUNT',$outamount);
					$this->Outstanding->saveField('REMAINING_AMOUNT',$ramount);
                 
           
        } else {
           
        }
			
		
		}
		
        if (!empty($id)) {
            try {
                if ($this->StaffLoan->delete($id)) {
                    $this->Session->setFlash('Staff Loan is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid Staff Loan.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

	}
	
	
	
}