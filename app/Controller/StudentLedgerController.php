<?php
class StudentLedgerController extends AppController
{
    var $name = 'StudentLedger';

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
		//$conditions = array('StudentLedger.Status'=>1);
		
			if(isset($this->params->query["CLS"]) && ($this->params->query["CLS"]>0)) {
            $conditions["StudentLedger.CLASS_ID"] = $this->params->query["CLS"];
            $this->request->data["StudentLedger"]["CLS"] = $this->params->query["CLS"];
        }

        $this->layout = 'admin_form_layout';
	
        $this->paginate = array(
            'conditions' => $conditions,
            'contain' => array('Name','PaymentType','AcademicClass'),
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'StudentLedger.LEDGER_ID DESC'
        );

        $this->set('StudentLedger', $this->paginate('StudentLedger')); 
		
		 $classes = $this->StudentLedger->AcademicClass->GetAcademicClasses();
        $this->set('classes', $classes);
	}
	
}
?>