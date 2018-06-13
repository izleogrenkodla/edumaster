<?php
class MonthDistributionController extends AppController
{
    var $name = 'MonthDistribution';

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

   		$Session = $this->Session->read('Auth.Admin');
		$conditions = array('MonthDistribution.Status'=>1);

        $this->layout = 'admin_form_layout';
	
        $this->paginate = array(
            'conditions' => $conditions,
            'contain' => array('PaymentType'),
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'MonthDistribution.created DESC'
        );

        $this->set('MonthDistribution', $this->paginate('MonthDistribution')); 
		
	}
	
	public function admin_add()
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
		
		if ($this->request->is('post')) {
            $this->MonthDistribution->set($this->request->data);
		
             if ($this->request->is('post')) {
				$this->MonthDistribution->set($this->request->data);
				if ($this->MonthDistribution->Validation()) {
					$this->MonthDistribution->create();
					if ($this->MonthDistribution->save($this->request->data)) {
						
						$list = $this->request->data['TT_DATE'];
					
						$mon = implode(",",$list);
						
						$this->MonthDistribution->saveField("payment_type",$this->request->data['MonthDistribution']['PAYMENT_TERM']);
						$this->MonthDistribution->saveField("Status",$this->request->data['MonthDistribution']['Status']);
						$this->MonthDistribution->saveField("title",$this->request->data['MonthDistribution']['TITLE']);
						$this->MonthDistribution->saveField("month",$mon);
						
						
						$this->Session->setFlash('Month Distribution Added Successfully!', 'message_good');
						$this->redirect(array('action' => 'index'));
					}
				} else {
					$this->Session->setFlash('Month Distribution Not Added Please Try Again!', 'message_bad');
				}
			}
		}

		$this->PaymentType = ClassRegistry::init('PaymentType');
		$payment_terms = $this->PaymentType->getPaymentTerms();
        $this->set('payment_terms', $payment_terms);
	}
	
	public function admin_delete($Id = null)
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
		
        if (!empty($Id)) {
            try {
                if ($this->MonthDistribution->delete($Id)) {
                    $this->Session->setFlash('Month Distribution is successfully deleted', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->redirect(array('action' => 'index'));
                    $this->Session->setFlash('Month Distribution was not deleted. Unknown error.', 'message_bad');
                }
            } catch (Exception $e) {
                $this->Session->setFlash("Delete failed. {$e->getMessage()}", 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->redirect(array('action' => 'index'));
        } else {
            $this->Session->setFlash('Invalid Group.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
    }
}
?>