<?php
class AdvanceFeeController extends AppController
{
    var $name = 'AdvanceFee';

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
            $conditions["AdvanceFee.CLASS_ID"] = $this->params->query["CLS"];
            $this->request->data["AdvanceFee"]["CLS"] = $this->params->query["CLS"];
        }

        $this->layout = 'admin_form_layout';
	
        $this->paginate = array(
            'conditions' => $conditions,
            'contain' => array('Name','AcademicClass','PaymentType'),
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'AdvanceFee.ADV_ID DESC'
        );

        $this->set('AdvanceFee', $this->paginate('AdvanceFee')); 
		
		/*$classes = $this->FeeCheck->AcademicClass->GetAcademicClasses();
        $this->set('classes', $classes);*/
	}
	
	  public function admin_view($id = null)
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        $this->AdvanceFee->id = $id;
        if (empty($this->AdvanceFee->id)) {
            $this->Session->setFlash('Invalid Vacancy !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
			$AdvanceFee = $this->AdvanceFee->find('first', array(
                'contain' => array('Name','AcademicClass','PaymentType'),
                'conditions' => array('AdvanceFee.ADV_ID' => $id)
            ));
            if(empty($AdvanceFee)) {
                $this->Session->setFlash('Invalid Advance Fee !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $AdvanceFee;
    }
	
}
?>
