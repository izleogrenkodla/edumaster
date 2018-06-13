<?php
class FeeDueController extends AppController
{
    var $name = 'FeeDue';

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
		$conditions = array('FeeDue.Status'=>1);

        $this->layout = 'admin_form_layout';
		
		if(isset($this->params->query["CLS"]) && ($this->params->query["CLS"]>0)) {
            $conditions["FeeDue.CLASS_ID"] = $this->params->query["CLS"];
            $this->request->data["FeeDue"]["CLS"] = $this->params->query["CLS"];
        }

        $this->paginate = array(
            'conditions' => $conditions,
            'contain' => array('AcademicClass','Name','MonthDistribution'),
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'FeeDue.id DESC',
			'Status' => 1,
        );

        $this->set('FeeDue', $this->paginate('FeeDue')); 
		
		 $classes = $this->FeeDue->AcademicClass->GetAcademicClasses();
        $this->set('classes', $classes);
    }
}
?>