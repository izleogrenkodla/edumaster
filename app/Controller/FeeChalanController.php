<?php
class FeeChalanController extends AppController
{
    var $name = 'FeeChalan';

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
            $conditions["FeeChalan.CLASS_ID"] = $this->params->query["CLS"];
            $this->request->data["FeeChalan"]["CLS"] = $this->params->query["CLS"];
        }

        $this->layout = 'admin_form_layout';
	
        $this->paginate = array(
            'conditions' => $conditions,
            'contain' => array('Name'),
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'FeeChalan.id DESC'
        );

        $this->set('FeeChalan', $this->paginate('FeeChalan')); 
		
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

        $this->FeeChalan->id = $id;
        if (empty($this->FeeChalan->id)) {
            $this->Session->setFlash('Invalid Fee Chalan !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
			$FeeChalan = $this->FeeChalan->find('first', array(
                'contain' => array('Name'),
                'conditions' => array('FeeChalan.id' => $id)
            ));
            if(empty($FeeChalan)) {
                $this->Session->setFlash('Invalid  Fee !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $FeeChalan;
    }
	
}
?>