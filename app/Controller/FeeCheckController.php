<?php
class FeeCheckController extends AppController
{
    var $name = 'FeeCheck';

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
            $conditions["FeeCheck.CLASS_ID"] = $this->params->query["CLS"];
            $this->request->data["FeeCheck"]["CLS"] = $this->params->query["CLS"];
        }

        $this->layout = 'admin_form_layout';
	
        $this->paginate = array(
            'conditions' => $conditions,
            'contain' => array('Name'),
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'FeeCheck.id DESC'
        );

        $this->set('FeeCheck', $this->paginate('FeeCheck')); 
		
		$classes = $this->FeeCheck->AcademicClass->GetAcademicClasses();
        $this->set('classes', $classes);
	}
	
	public function admin_view($id = null)
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        $this->FeeCheck->id = $id;
        if (empty($this->FeeCheck->id)) {
            $this->Session->setFlash('Invalid Fee Check !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
			$FeeCheck = $this->FeeCheck->find('first', array(
                'contain' => array('Name'),
                'conditions' => array('FeeCheck.id' => $id)
            ));
            if(empty($FeeCheck)) {
                $this->Session->setFlash('Invalid  Fee !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $FeeCheck;
    }
	
}
?>